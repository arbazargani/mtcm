{{-- Sidebar stauk-margin-auto uk-text-justifyrts --}}
<div class="tm-sidebar-right uk-visible@m uk-align-right uk-box-shadow-medium" style="
                                                                                        padding: 45px 45px 60px 45px;
                                                                                        overflow: auto;
                                                                                        position: inherit;
                                                                                        height: 100%;
">
    <ul class="uk-nav uk-nav-default tm-nav">
        <li class="uk-nav-header">محتوا</li>
        <li class=""><a href="{{ route('Article > Manage') }}">مقالات</a></li>
        <li class=""><a href="{{ route('Page > Manage') }}">صفحات</a></li>
        <li class=""><a href="{{ route('Category > Manage') }}">دسته‌ها</a></li>
        <li class=""><a href="{{ route('Tag > Manage') }}">برچسب‌ها</a></li>
    </ul>

    <hr class="uk-divider-small">

    <ul class="uk-nav uk-nav-default tm-nav">
        <li class="uk-nav-header">کاربران</li>
        <li class=""><a href="{{ route('Profile') }}">پروفایل شما</a></li>
        <li class=""><a>سایر کاربران</a></li>
    </ul>
</div>
{{-- Sidebar ends --}}
