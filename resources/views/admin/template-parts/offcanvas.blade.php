<div class="uk-background-muted uk-padding-small" uk-sticky="animation: uk-animation-slide-top">
    <!-- <button class="uk-button uk-button-primary" type="button" uk-toggle="target: #offcanvas-nav"><span uk-icon="menu"></span></button> -->
    <a uk-icon="menu" uk-toggle="target: #offcanvas-nav"></a>
    <div class="uk-float-left">
    <a href="{{ route('Profile') }}">{{ Auth::User()->username }} <span uk-icon="user"></span></a>
    </div>
</div>

<div id="offcanvas-nav" uk-offcanvas="overlay: true; mode: reval">
    <div class="uk-offcanvas-bar" style="width: 250px">

        <button class="uk-offcanvas-close" type="button" uk-close></button>

        <ul class="uk-nav uk-nav-default tm-nav">
                <h5><span uk-icon="file-edit"></span> محتوا</h5>
                <ul class="uk-nav-sub">
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
            <h5><span uk-icon="users"></span> کاربران</h5>
            <ul class="uk-nav-sub">
                <li class=""><a href="{{ route('Profile') }}">پروفایل شما</a></li>
                <li class=""><a href="{{ route('Users > Manage') }}">سایر کاربران</a></li>
            </ul>
        </ul>
        <hr>

        <ul class="uk-nav uk-nav-default tm-nav">
            <h5><span uk-icon="settings"></span> تنظیمات</h5>
            <ul class="uk-nav-sub">
                <li class=""><a href="{{ route('Setting') }}">تنظیمات سیستم</a></li>
            </ul>
        </ul>

    </div>
</div>
