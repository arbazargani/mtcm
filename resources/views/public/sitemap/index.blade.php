@extends('public.sitemap')

@section('content')
    
<url>

    <loc>{{ route('Home') }}</loc>

    <lastmod>2005-01-01</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

<url>

    <loc>{{ route('Sitemap > Articles') }}</loc>

    <lastmod>2005-01-01</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

<url>

    <loc>{{ route('Sitemap > Pages') }}</loc>

    <lastmod>2005-01-01</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

<url>

    <loc>{{ route('Sitemap > Categories') }}</loc>

    <lastmod>2005-01-01</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

<url>

    <loc>{{ route('Sitemap > Tags') }}</loc>

    <lastmod>2005-01-01</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

@endsection
