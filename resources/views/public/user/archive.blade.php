@extends('public.template')

@section('meta')
	<title>آرشیو نوشته‌های {{ $user[0]->name . ' ' . $user[0]->family }}</title>
@endsection

@section('content')

    <div class="uk-section-small uk-flex uk-flex-middle uk-flex-center tm-container uk-grid-small 
    uk-padding-small uk-grid" uk-height-viewport="expand: true" uk-grid="" style="box-sizing: border-box; max-width: 1120px; margin-left: auto; margin-right: auto;">
    <article class="uk-comment">
    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
        <div class="uk-width-auto">
            <img class="uk-comment-avatar" src="images/avatar.jpg" width="80" height="80" alt="">
        </div>
        <div class="uk-width-expand">
            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">{{ $user[0]->name }}</a></h4>
            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                <li><a href="#">تعداد نوشته‌ها:‌ {{ count($user[0]->article) }}</a></li>
                <li><a href="#">عضو از تاریخ:‌ {{ $user[0]->created_at }}</a></li>
            </ul>
        </div>
    </header>
    <div class="uk-comment-body">
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
    </div>
</article>
    	@foreach($articles as $article)
        	<a href="{{ route('Article > Single', $article->slug) }}">{{ $article->title }}</a>
        @endforeach
    </div>
@endsection
