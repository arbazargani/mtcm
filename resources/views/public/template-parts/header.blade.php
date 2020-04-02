<nav class="uk-navbar-container uk-margin uk-box-shadow-small" id="navbar" uk-navbar>
{{--    <a class="uk-navbar-item uk-logo" href="#">{{ $settings['website_name']->value }}</a>--}}
    <a class="uk-navbar-item uk-logo uk-visible@m" href="#">
        <img src="{{ asset('assets/image/mamooth-cms.png') }}" style="width: 70%; background: white; padding: 3px; margin: 10px 0px 10px 0px; border-radius: 3px; vertical-align: middle;" alt="MAMOOT CMS">
    </a>
    <a class="uk-navbar-item uk-logo uk-hidden@m" href="#">
        <img src="{{ asset('assets/image/mamooth-cms.png') }}" style="width: 70%; margin: 3px 0px 3px 0px; vertical-align: middle;" alt="MAMOOT CMS">
    </a>
    <div class="uk-navbar-right uk-margin-small-right uk-visible@m">
        <ul class="uk-navbar-nav">
            <li><a href="{{ route('Home') }}">خانه</a></li>
            <li>
                <a href="#">بلاگ</a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-2">
                    <div class="uk-navbar-dropdown-grid uk-child-width-1-2" uk-grid>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">دسته‌بندی مطالب</li>
                                @foreach($categories as $category)
                                @php $half = (INT) round($loop->count/2) @endphp
                                @if($loop->iteration <= $half)
                                @if($category->id != 1)
                                <li class="uk-margin-right"><a href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a></li>
                                @endif
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header uk-invisible">دسته‌بندی مطالب</li>
                                @foreach($categories as $category)
                                @if($loop->iteration > $half)
                                @if($category->id != 1)
                                <li class="uk-margin-right"><a href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a></li>
                                @endif
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="uk-navbar-left uk-margin-small-left">
        <ul class="uk-navbar-nav">
            <li class="uk-active uk-hidden@m"><a href="" uk-icon="menu" uk-toggle="target: #responsive-menu"></a></li>
            @if(Auth::check())
            <div class="uk-navbar-item uk-visible@m">
                <a class="uk-button uk-button-primary" href="{{ route('Admin') }}" >پنل مدیریت</a>
            </div>
            <div class="uk-navbar-item uk-visible@m">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="uk-button uk-button-text uk-text-muted" type="submit">خروج</button>
            </form>
            </div>
            @endif
        </ul>
    </div>
</nav>
<!-- Responsive off-canvas menu -->
<div id="responsive-menu" uk-offcanvas="overlay: true; mode: push">
    <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" uk-close></button>
        <br>
        <ul class="uk-nav uk-nav-default">
            <li class="uk-active uk-navbar-header uk-margin-bottom"><a href="{{ route('Home') }}"><span class="uk-icon-button" uk-icon="home"></span> خانه</a></li>
            <li class="uk-active uk-navbar-header"><a href="{{ route('Blog') }}"><span class="uk-icon-button" uk-icon="file-text"></span> بلاگ</a></li>
            <li class="uk-parent uk-margin-bottom">
                <ul class="uk-nav-sub">
                @foreach($categories as $category)
                @if($category->id != 1)
                <li class="uk-margin-right"><a href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a></li>
                @endif
                @endforeach
                </ul>
            </li>
            <li class="uk-active uk-navbar-header uk-margin-bottom"><a href="{{ route('Blog') }}"><span class="uk-icon-button" uk-icon="microphone"></span> پادکست‌ها</a></li>
            <li class="uk-active uk-navbar-header uk-margin-bottom"><a href="{{ route('Blog') }}"><span class="uk-icon-button" uk-icon="receiver"></span> ارتباط</a></li>
            @if(Auth::check())
            <li class="uk-active uk-navbar-header"><a href="{{ route('Admin') }}"><span class="uk-icon-button" uk-icon="user"></span> پنل مدیریت</a></li>
            <li class="uk-parent uk-margin-bottom">
                <ul class="uk-nav-sub">
                    <li class="uk-margin-right">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="uk-button uk-button-text uk-text-muted" type="submit">خروج</button>
                        </form>
                    </li>
                </ul>
            </li>
            @endif

            <hr>
            <div class="uk-container">
                <p>
                <a href="#" class="uk-icon-button" uk-icon="instagram"></a>
                <a href="#" class="uk-icon-button" uk-icon="github"></a>
                <a href="#" class="uk-icon-button" uk-icon="whatsapp"></a>
                <a href="#" class="uk-icon-button" uk-icon="mail"></a>
                </p>
            </div>
        </ul>

    </div>
</div>
