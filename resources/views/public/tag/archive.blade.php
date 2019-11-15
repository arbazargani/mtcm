@extends('public.template')

@section('meta')
    <title>{{ $tag[0]->name }}</title>
@endsection

@section('content')
    @foreach ($tag[0]->article as $article)
        <p>{{ $article->title }}</p>
    @endforeach
@endsection
