@extends('public.template')

@section('meta')
<title>{{ $article[0]->title }}</title>
@endsection

@section('content')
<div class="uk-padding-small" uk-grid>
    <div class="uk-article uk-width-1-1@m">
      <article class="article uk-padding">
{{--        <img class="uk-align-center" src="https://picsum.photos/800/300?grayscale" alt="cover">--}}
            @if($article[0]->cover)
              <img class="uk-align-center" src="/storage/uploads/articles/images/{{ $article[0]->cover }}" alt="cover" style="max-width: 900px; max-height: 400px">
            @endif
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
          <hr class="uk-divider-icon">
        <comments>
          @include('public.article.comments')
        </comments>
      </article>
    </div>

</div>
</div>
@endsection
