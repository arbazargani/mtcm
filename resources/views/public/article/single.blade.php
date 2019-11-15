@extends('public.template')

@section('meta')
<title>{{ $article[0]->title }}</title>
@endsection

@section('content')
<div class="uk-padding-small" uk-grid>
    <div class="uk-article uk-width-3-4@m">
      <article class="article uk-padding">
{{--        <img class="uk-align-center" src="https://picsum.photos/800/300?grayscale" alt="cover">--}}
            <img class="uk-align-center" src="/storage/uploads/articles/images/{{ $article[0]->cover }}" alt="cover" style="max-width: 800px; max-height: 300px">
        <h1 class="uk-article-title">{{ $article[0]->title }}</h1>
        <p class="uk-article-meta">
          <span>
            <span uk-icon="icon: folder"></span> <span class="uk-text-primary">دسته‌بندی: </span>
            @if(count($article[0]->category->all()))
              @foreach($article[0]->category->all() as $category)
                  <a href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a>
                  @if(!$loop->last)
                  ،
                  @endif
              @endforeach
            @else
              <a>بدون دسته‌بندی</a>
            @endif
          </span>
          |
          <span>
            <span uk-icon="icon: tag"></span> <span class="uk-text-primary">برچسب‌ها: </span>
            @if(count($article[0]->category->all()))
              @foreach($article[0]->tag->all() as $tag)
                  <a href="{{ route('Tag > Archive', $tag->slug) }}">{{ $tag->name }}</a>
                  @if(!$loop->last)
                  ،
                  @endif
              @endforeach
            @else
              <a>بدون تگ</a>
            @endif
          </span>
          |
          <span>
            <span uk-icon="icon: clock"></span> <span class="uk-text-primary">تاریخ انتشار: </span>
            <a>{{ $article[0]->created_at }}</a>
          </span>
          |
          <span>
            <span class="uk-text-primary">بازدید: </span>
            <a>{{ $article[0]->views }}</a>
          </span>
        </p>
        <content class="uk-margin-auto uk-text-justify">
            {!! $article[0]->content !!}
        </content>
      </article>
    </div>
    <div class="sidebar uk-card uk-card-default uk-card-body uk-width-1-4@m uk-border-right uk-border-top-1">
      <img class="uk-align-center" src="https://picsum.photos/400/400" alt="cover">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
      <img class="uk-align-center" src="https://picsum.photos/400/400" alt="cover">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
      <img class="uk-align-center" src="https://picsum.photos/400/400" alt="cover">
    </div>

</div>

</div>
@endsection
