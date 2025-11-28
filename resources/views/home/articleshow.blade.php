@extends('layout.main')

@push('header')
@endpush

@section('main')
    <section class="space blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="vs-blog blog-single">

                        {{-- HERO IMAGE (opsional) --}}
                        @if ($article->thumbnail)
                            <div class="blog-img">
                                <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-100">
                            </div>
                        @endif

                        <div class="blog-inner">

                            <div class="blog-content">

                                {{-- TITLE --}}
                                <h2 class="blog-title h3">{{ $article->title }}</h2>

                                {{-- META --}}
                                <div class="blog-meta mb-3">
                                    <a href="" class="blog-date"><i
                                            class="fa fa-calendar-alt"></i>{{ $date }}</a>
                                    <a href=""><i class="fa fa-user"></i> Admin</a>
                                </div>

                                {{-- FULL ARTICLE BODY --}}
                                <div class="article-body">
                                    {!! $article->body !!}
                                </div>

                            </div>

                            {{-- TAGS & SOCIAL SHARE (optional static dulu) --}}
                            <div class="share-links mt-4">
                                <div class="row justify-content-between align-items-center">

                                    <div class="col-md-auto">
                                        <span class="share-links-title">Category:</span>
                                        <div class="tagcloud style1">
                                            <a href="blog.html">{{ $article->category->name ?? 'Uncategorized' }}</a>
                                        </div>
                                    </div>

                                    <div class="col-md-auto text-xl-end">
                                        <span class="share-links-title">Share:</span>
                                        <ul class="social-links">
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                            </li>
                                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            {{-- PREVIOUS / NEXT PAGINATION --}}
                            <div class="post-pagination mt-5">
                                <div class="row justify-content-between align-items-center">

                                    {{-- PREVIOUS --}}
                                    <div class="col">
                                        @if ($prev)
                                            <div class="post-pagi-box prev">
                                                <a href="{{ route('article_show', $prev->slug) }}">
                                                    <img src="{{ asset($prev->thumbnail) }}" alt="{{ $prev->title }}"
                                                        class="pagi-thumb">
                                                </a>
                                                <a href="{{ route('article_show', $prev->slug) }}"
                                                    class="pagi-title">Previous Post</a>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- ICON TO ARTICLE LIST --}}
                                    <div class="col-auto d-none d-sm-block">
                                        <a href="{{ route('article') }}" class="pagi-icon">
                                            <i class="fa fa-th"></i>
                                        </a>
                                    </div>

                                    {{-- NEXT --}}
                                    <div class="col">
                                        @if ($next)
                                            <div class="post-pagi-box next">
                                                <a href="{{ route('article_show', $next->slug) }}">
                                                    <img src="{{ asset($next->thumbnail) }}" alt="{{ $next->title }}"
                                                        class="pagi-thumb">
                                                </a>
                                                <a href="{{ route('article_show', $next->slug) }}" class="pagi-title">Next
                                                    Post</a>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area">
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Categories</h3>
                            <ul>
                                @foreach ($categories as $cat)
                                    <li>
                                        <a href="{{ route('article', ['category' => $cat->slug]) }}">
                                            {{ $cat->name }}
                                        </a>
                                        <span>({{ $cat->articles_count }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget-postes">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">

                                @foreach ($recentPosts as $post)
                                    <div class="recent-post">
                                        <div class="media-img">
                                            <a href="{{ route('article_show', $post->slug) }}">
                                                <img src="{{ $post->thumbnail ? asset($post->thumbnail) : asset('assets/img/blog/default-thumb.jpg') }}"
                                                    alt="{{ $post->title }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="post-title">
                                                <a class="text-inherit" href="{{ route('article_show', $post->slug) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h4>
                                            <div class="recent-post-meta">
                                                <a href="{{ route('article_show', $post->slug) }}">
                                                    <i class="fa fa-calendar-alt"></i>
                                                    {{ $post->created_at->format('F d, Y') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer')
@endpush
