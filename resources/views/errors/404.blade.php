@extends('public.template')

@section('meta')
    <title>{{ 'یافت نشد!' . ' ' . $settings['title_delimiter']->value . ' ' . $settings['website_name']->value }}</title>
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <ul class="uk-breadcrumb uk-margin-medium-right">
        <li><a href="{{ route('Home') }}">خانه</a></li>
        <li><a href="">خطای ۴۰۴</a></li>
    </ul>

    <article class="article uk-background-default uk-border-rounded">
        <!-- article cover and meta box for small-screens -->
        <img class="uk-align-center uk-border-rounded"
             src="{{ asset("assets/image/404.png") }}"
             alt="not found."
             uk-img>

        <content class="uk-text-justify">
            <div class="uk-margin-medium-top uk-text-center" uk->
                <h1>404 | یافت نشد.</h1>
                <hr>
                <a href="{{ route('Home') }}" class="uk-button-text uk-link-reset"><span uk-icon="arrow-left"></span> بازگشت</a>
            </div>
        </content>

    </article>
@endsection
