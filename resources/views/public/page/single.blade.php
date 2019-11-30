@extends('public.template')

@section('meta')
<title>{{ $page[0]->title }}</title>
@endsection

@section('content')
<div class="uk-padding-small uk-margin-auto uk-align-right" uk-grid>
    <page>
        <img class="uk-align-center" src="https://picsum.photos/800/300" alt="cover">

        <h1>{{ $page[0]->title }}</h1>
        <p class="uk-margin-auto">
            {!! $page[0]->content !!}
        </p>
    </page>
</div>
@endsection
