@extends('public.template')

@section('meta')
<title>{{ $category[0]->name }}</title>
@endsection

@section('content')
    {{--@dd($category[0]->article)--}}
    <p style="direction: ltr; text-align: left; margin: 10px">count of returned articles: {{ count($category[0]->article) }}</p>
    @foreach ($category[0]->article as $article)
        <p>{{ $article->title }}</p>
    @endforeach
@endsection
