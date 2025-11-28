@extends('layout.main')

@push('header')
@endpush

@section('main')
    <!--==============================
                    Breadcumb
                    ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('home/img/banner/banner-article.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Article</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Article</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
                 BLog Area
                 ==============================-->
    <section class="space">
        <div class="container">
            <div class="row g-4">
                @foreach ($articles as $article)
                    @php
                        // created_at selalu Carbon, jadi aman dipakai format()
                        $date = $article->created_at;

                       // Ambil body, buang semua tag HTML
    $raw = strip_tags($article->body);

    // Ganti &nbsp; jadi spasi biasa
    $raw = str_replace('&nbsp;', ' ', $raw);

    // Rapikan spasi berulang (tab, newline, dll)
    $raw = preg_replace('/\s+/', ' ', $raw);

    // Batasi panjang kira-kira setara 1–2 paragraf
    $excerpt = Str::limit(trim($raw), 100);
                    @endphp

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="blog-style2">
                            <div class="blog-img">
                                <img class="w-100"
                                    src="{{ $article->thumbnail ? Storage::url($article->thumbnail) : asset('home/img/blog/blog-1-1.jpg') }}"
                                    alt="{{ $article->title }}">
                                <div class="blog-meta2">
                                    <span class="day">{{ $date->format('d') }}</span>
                                    <span class="month">{{ $date->format('F') }}</span>
                                </div>
                            </div>
                            <div class="blog-content">
                                <h4 class="blog-title text-title">
                                    <a href="{{ route('article_show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h4>
                                    <p class="blog-text">{{ $excerpt }}</p>

                                <div class="blog-bottom">
                                    <div class="blog-author">
                                        <a href="#"><i
                                                class="fas fa-user"></i>{{ $article->author_name ?? 'Admin' }}</a>
                                    </div>
                                    <a href="{{ route('article_show', $article->slug) }}" class="vs-btn style3">
                                        Read More <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($articles->hasPages())
                <div class="vs-pagination mt-40">
                    <ul>
                        {{-- Previous --}}
                        <li class="{{ $articles->onFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ $articles->previousPageUrl() ?? '#' }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>

                        {{-- Nomor halaman --}}
                        @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}"
                                    class="{{ $page == $articles->currentPage() ? 'active' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach

                        {{-- Next --}}
                        <li class="{{ $articles->hasMorePages() ? '' : 'disabled' }}">
                            <a href="{{ $articles->nextPageUrl() ?? '#' }}">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('footer')
@endpush
