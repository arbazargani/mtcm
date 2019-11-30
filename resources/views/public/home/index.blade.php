@extends('public.template')

@section('meta')
	<title>{{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <div class="uk-section-small uk-flex uk-flex-middle uk-flex-center tm-container uk-grid-small uk-padding-small uk-grid" uk-height-viewport="expand: true" uk-grid="" style="box-sizing: border-box; max-width: 1120px; margin-left: auto; margin-right: auto;">
        <div class="uk-width-1-3@m uk-width-1-2@s uk-padding-remove uk-first-column">
            <div class="uk-card uk-card-default uk-box-shadow-small">
                <div class="uk-card-header" style="padding: 15px 30px 17px;">
                    <h2 class="uk-margin-remove uk-visible@s" style="font-size: 22px;">آخرین نوشته‌ها</h2>
                    <h3 class="uk-margin-remove uk-hidden@s">آخرین نوشته‌ها</h3>
                </div>
                <div class="uk-card-body uk-padding-xsmall">
                    @if (count($LatestArticles))
                        <ul>
                            @foreach($LatestArticles as $article)
                                <li><a href="{{ route('Article > Single', $article->slug) }}">{{ $article->title }}</a></li>
                            @endforeach
                        </ul>
                    {{ $LatestArticles->links() }}
                    @else
                        <div class="uk-alert-warning uk-padding-small">
                            <p>محتوایی در سیستم ثبت نشده است.</p>
                            <a class="uk-button uk-button-link" href="{{ route('Article > New') }}">+‌ ایجاد</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="uk-width-2-3@m uk-visible@m">
{{--            slider starts--}}
            <img class="uk-border-rounded" src="https://picsum.photos/seed/picsum/710/450" alt="">
{{--            slider ends--}}
        </div>
    </div>

    </div>
@endsection
