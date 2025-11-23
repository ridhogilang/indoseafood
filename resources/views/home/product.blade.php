@extends('layout.main')

@push('header')
@endpush

@section('main')
    <!--==============================
                                        Breadcumb
                                        ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="home/img/banner/banner-produk.png">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">All Products</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Products</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
                                     Shop Area
                                     ==============================-->
    <section class="space">
        <div class="container">
            <div class="vs-sort-bar mb-40">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-auto">
                        <p class="shop-result-count"> Showing {{ $produk->firstItem() }}–{{ $produk->lastItem() }} of
                            {{ $produk->total() }} results
                        </p>
                    </div>
                    <div class="col-md-auto">
                        <form class="shop-ordering" method="get">
                            <select name="category" class="orderby" aria-label="Filter by category"
                                onchange="this.form.submit()">

                                <option value="">All Categories</option>

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->slug }}"
                                        {{ $selectedCategory === $cat->slug ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row gy-30">

                @if ($produk->count() === 0)
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No products available in this category.</h4>
                    </div>
                @endif

                @foreach ($produk as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="product-style1">

                            <div class="product-img">
                                <div class="clipped">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}">
                                </div>
                            </div>

                            <div class="product-body">
                                <h3 class="product-title">{{ $item->name }}</h3>

                                <p class="text-muted" style="font-size: 14px;">
                                    <i>{{ $item->latin_name }}</i>
                                </p>

                                <p class="mb-0" style="font-size: 14px;">
                                    <strong>Processing:</strong><br>
                                    {{ $item->processings->pluck('name')->join(', ') }}
                                </p>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            @if ($produk->hasPages())
                <div class="vs-pagination">
                    <ul>
                        {{-- Prev --}}
                        @if ($produk->onFirstPage())
                            <li class="disabled"><span><i class="fas fa-chevron-left"></i></span></li>
                        @else
                            <li><a href="{{ $produk->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a></li>
                        @endif

                        {{-- Numbered pages --}}
                        @foreach ($produk->getUrlRange(1, $produk->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}"
                                    class="{{ $page == $produk->currentPage() ? 'active' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach

                        {{-- Next --}}
                        @if ($produk->hasMorePages())
                            <li><a href="{{ $produk->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a></li>
                        @else
                            <li class="disabled"><span><i class="fas fa-chevron-right"></i></span></li>
                        @endif
                    </ul>
                </div>
            @endif

        </div>
    </section>
@endsection

@push('footer')
@endpush
