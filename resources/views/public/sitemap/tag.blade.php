@extends('public.sitemap')

@section('content')

@foreach($tags as $tag)
<url>

    <loc>{{ urldecode(route('Tag > Archive', $tag->slug)) }}</loc>

    <lastmod>{{ $tag->updated_at }}</lastmod>

    <changefreq>hourly</changefreq>
    
    <priority>0.7</priority>
    
</url>
@endforeach

@endsection
