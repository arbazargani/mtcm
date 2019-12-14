@extends('public.template')

@section('meta')
<title>{{ $page[0]->title }}</title>
@endsection

@section('content')
<div class="uk-padding-small" uk-grid>
    <div class="uk-article uk-width-1-1@m">
      <div class="article uk-padding">
            @if($page[0]->cover)
              <img class="uk-align-center" src="/storage/uploads/pages/images/{{ $page[0]->cover }}" alt="cover" style="max-width: 900px; max-height: 400px">
            @endif
      	<h1 class="uk-article-title">{{ $page[0]->title }}</h1>
        <p class="uk-article-meta">
          <span>
            <span uk-icon="icon: clock"></span> <span class="uk-text-primary">تاریخ انتشار: </span>
            {{ $page[0]->created_at }}
          </span>
           | 
          <span>
            <span uk-icon="icon: bell"></span> <span class="uk-text-primary">آخرین بروزرسانی: </span>
            {{ $page[0]->updated_at }}
          </span>
        <content class="uk-margin-auto uk-text-justify">
        	{!! $page[0]->content !!}
        </content>
      </div>
  </div>
</div>
@endsection
