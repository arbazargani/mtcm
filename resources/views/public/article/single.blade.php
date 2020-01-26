@extends('public.template')

@section('meta')
<title>{{ $article[0]->title }}</title>
@if(!is_null($article[0]->meta_description))
    <meta name="description" content="{{ $article[0]->meta_description }}">
@endif
@if(!is_null($article[0]->meta_robots))
    <meta name="robots" content="{{ $article[0]->meta_robots }}">
@endif
@endsection

@section('content')
<div class="uk-padding-small" uk-grid>
    <div class="uk-article uk-width-1-1@m">
      <article class="article uk-padding">
{{--        <img class="uk-align-center" src="https://picsum.photos/800/300?grayscale" alt="cover">--}}
            @if($article[0]->cover)
              <img class="uk-align-center" src="/storage/uploads/articles/images/{{ $article[0]->cover }}" alt="cover" style="max-width: 900px; width: 100%; max-height: 400px">
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
            <?php
              $jalaliDate = new Verta($article[0]->created_at);
              $jalaliDate->timezone('Asia/Tehran');
              Verta::setStringformat('Y/n/j H:i:s');
              $jalaliDate = Verta::instance($article[0]->created_at);
              $jalaliDate = Facades\Verta::instance($article[0]->created_at);
            ?>
            <a>{{ $jalaliDate }}</a>
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
