@extends('public.template')

@section('meta')
	<title>{{ "{$homeTitle->value} {$settings['title_delimiter']->value} {$settings['website_name']->value}" }}</title>
    <meta name="description" content="{{ $homeDescription->value }}">
    <meta name="robots" content="index, follow">
@endsection

@section('content')
    <div class="uk-article">
        <div class="article uk-background-default uk-border-rounded">
            <h1 class="uk-hidden">صفحه اصلی</h1>
            <!-- slider -->
            <div id="slider">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="ratio: 16:9; animation: push; autoplay: true;">
                    <h2 class="uk-hidden">مقالات اخیر</h2>
                    <ul class="uk-slideshow-items uk-border-rounded">
                        @foreach($sliderArticles as $article)
                        <li>
                            <img src="/storage/uploads/articles/images/{{ $article->cover }}" alt="{{ $article->title }}" uk-cover>
                            <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-right uk-transition-slide-bottom">
                                <h3 uk-slideshow-parallax="x: 100,-100" class="uk-margin-remove uk-visible@m"><a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}"><span class="uk-icon-button" uk-icon="arrow-right"></span> {{ $article->title }}</a></h3>
                                <hr class="uk-divider-small">
                                @if(count($article->category->all()))
                                <p uk-slideshow-parallax="x: 200,-200" class="uk-margin-remove uk-text-meta">
                                در دسته <a href="{{ route('Category > Archive', $article->category->first()->slug) }}">{{ $article->category->first()->name }}</a>
                                </p>
                                @endif
                                <h3 style="font-size: 13px !important;" uk-slideshow-parallax="x: 100,-100" class="uk-margin-remove uk-align-right uk-hidden@m"><a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}"><span class="uk-icon-button" uk-icon="arrow-right"></span> {{ $article->title }}</a></h3>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="next"></a>

                </div>
            </div>
            <!-- slider -->

            <hr>

            <!-- most popular -->
                <div class="container">
                    <h2 class="uk-text-lead">محبوب‌ترین مقالات</h2>
                    @foreach($popularArticles as $article)
                    <div class="uk-card uk-card-small uk-background-muted uk-grid-collapse uk-margin uk-border-rounded">
                        <div>
                            <div class="uk-card-body" uk-grid>
                                <div class="uk-width-1-3@m">
                                    <a href="{{ route('Article > Single', $article->slug) }}"><img src="/storage/uploads/articles/images/{{ $article->cover }}" alt="{{ $article->title }}" class="uk-border-rounded" uk-img></a>
                                </div>
                                <div class="uk-width-2-3@m">
                                <div class="uk-card-badge uk-label uk-background-default uk-text-meta">بازدید:‌ {{ $article->views }}</div>
                                    <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}"><h3 class="uk-h5">{{ $article->title }}</h3></a>
                                    @if(count($article->category->all()))
                                        <p class="uk-text-meta">در دسته:
                                        @foreach($article->category->all() as $category)

                                            <a class="uk-link-reset" href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a>
                                            @if(!$loop->last)
                                            ،
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="uk-text-meta">بدون دسته‌بندی</span>
                                    @endif
                                        </p>
                                        <p class="uk-text-truncate">
                                            <a href="{{ route('Article > Single', $article->slug) }}" class="uk-badge uk-background-default uk-text-muted uk-float-left"><span uk-icon="arrow-right"></span></a>
                                            {{ $article->meta_description }}
                                        </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            <!-- most popular -->

        </div>
    </div>
@endsection
