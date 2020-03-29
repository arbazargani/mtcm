<div class="uk-background-muted uk-padding-small" uk-sticky="animation: uk-animation-slide-top">
    
    <a class="uk-icon-button" uk-icon="menu" uk-toggle="target: #offcanvas-nav"></a>
    <div class="uk-float-left" style="direction: ltr;">
    <a class="uk-link-reset" href="{{ route('Home') }}" target="_blank"><span class="uk-icon-button" uk-icon="icon: home"></span></a>
    <a class="uk-link-reset" href="{{ route('Profile') }}" target="_self"><span class="uk-icon-button" uk-icon="icon: user"></span> <span class="uk-text-meta">{{ Auth::user()->username }}</span></a>
    <a class="uk-link-reset" onClick='document.getElementById("logout").submit();'><span class="uk-icon-button" uk-icon="icon: sign-out"></span>
    <form action="{{ route('logout') }}" method="post" class="uk-hidden" id="logout">
        @csrf
        <button type="submit"></button>
    </form>
    </div>
</div>

<div id="offcanvas-nav" uk-offcanvas="overlay: true; mode: reval">
    <div class="uk-offcanvas-bar" style="width: 250px">

        <button class="uk-offcanvas-close" type="button" uk-close></button>

        <ul class="uk-nav uk-nav-default tm-nav">
                <h5><a class="uk-link-reset" href="{{ route('Admin') }}"><span class="uk-icon-button" uk-icon="icon: home"></span> داشبورد</a></h5>
                <ul class="uk-nav-sub uk-margin-right">
                    <!-- // -->
                </ul>
        </ul>

        <ul class="uk-nav uk-nav-default tm-nav">
                <h5><span class="uk-icon-button" uk-icon="file-edit"></span> محتوا</h5>
                <ul class="uk-nav-sub uk-margin-right">
                    <li class=""><a href="{{ route('Article > Manage') }}">مقالات</a></li>
                    <li class=""><a href="{{ route('Page > Manage') }}">صفحات</a></li>
                    <li class=""><a href="{{ route('Category > Manage') }}">دسته‌ها</a></li>
                    <li class=""><a href="{{ route('Tag > Manage') }}">برچسب‌ها</a></li>
                    <li class=""><a href="{{ route('Comment > Manage') }}">دیدگاه‌ها</a></li>
                </ul>
            <li>
        </ul>
        <hr>

        <ul class="uk-nav uk-nav-default tm-nav">
            <h5><span class="uk-icon-button"  uk-icon="users"></span> کاربران</h5>
            <ul class="uk-nav-sub uk-margin-right">
                <li class=""><a href="{{ route('Profile') }}">پروفایل شما</a></li>
                <li class=""><a href="{{ route('Users > Manage') }}">سایر کاربران</a></li>
            </ul>
        </ul>
        <hr>

        <ul class="uk-nav uk-nav-default tm-nav">
            <h5><span class="uk-icon-button"  uk-icon="settings"></span> تنظیمات</h5>
            <ul class="uk-nav-sub uk-margin-right">
                <li class=""><a href="{{ route('Setting') }}">تنظیمات سیستم</a></li>
            </ul>
        </ul>

    </div>
</div>
