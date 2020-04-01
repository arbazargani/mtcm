@extends('public.sitemap')

@section('content')

@foreach($articles as $article)
<url>

    <loc>{{ urldecode(route('Article > Single', $article->slug)) }}</loc>

    <lastmod>{{ $article->updated_at }}</lastmod>

    <changefreq>hourly</changefreq>
    
    <priority>0.9</priority>

    <image:image>
        <image:loc>
            {{ asset('/storage/uploads/articles/images/' . $article->cover) }}
        </image:loc>
        <image:caption>{{ $article->title }}</image:caption>
        <image:title>{{ $article->title }}</image:title>
    </image:image>

</url>
@endforeach

@endsection
