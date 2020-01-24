@extends('public.template')

@section('meta')
<title>{{ 'آرشیو برچسب ' . $tag[0]->name }}</title>
@endsection

@section('content')
    @php
        $c = 0;
    @endphp
<div class="uk-padding-small" uk-grid>
    <div class="uk-article uk-width-1-1@m">
        <article class="article uk-padding">
            <h1>{{ 'آرشیو برچسب: ' . $tag[0]->name }}</h1>
            <hr>
            @if(count($PaginatedCategories))
                <div class="uk-child-width-1-3@m" uk-grid="masonry: true" uk-grid>
                    @foreach ($PaginatedCategories as $article)
                        @if($article->state == 1)
                            @php
                                $c += 1;
                            @endphp
                            <div>
                                <div class="uk-card uk-card-default uk-card-hover uk-border-rounded">
                                    <div class="uk-card-media-top">
                                        <a href="{{ route('Article > Single', $article->slug) }}"><img src="/storage/uploads/articles/images/{{ $article->cover }}" alt="" class="uk-border-rounded" style="width: 100%; height: 180px;"></a>
                                    </div>
                                    <div class="uk-card-body">
                                        <div class="uk-card-badge uk-label">{{ $article->views }} بازدید</div>
                                        <h2 class="uk-card-title uk-text-lead"><a href="{{ route('Article > Single', $article->slug) }}" class="uk-link-heading">{{ $article->title }}</a></h2>
                                        <p class="uk-text-meta uk-margin-remove-top"><time datetime="{{ $article->created_at }}">{{ $article->created_at }}</time></p>
                                        <p>{{ substr($article->content, 0, 100) . '...' }}</p>
                                    </div>
                                    <a class="uk-button uk-button-primary" style="width: 100%; border-radius: 0px 0px 5px 5px;" href="{{ route('Article > Single', $article->slug) }}">بازدید</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
            {{ $PaginatedCategories->links("pagination::uikit") }}
            @if(!$c)
            <div class="uk-alert-warning" uk-alert>
            <p>نوشته‌ای با این برچسب وجود ندارد.</p>
            </div>
            @endif
        </article>
    </div>
</div>
@endsection
