<div class="uk-container uk-background-muted uk-width-1-1" uk-sticky>

    <div class="uk-text-left" style="direction: ltr;">
        <a class="uk-icon-button uk-hidden@m" uk-icon="menu" uk-toggle="target: #offcanvas-nav"></a>

        <a class="uk-link-reset uk-icon-button" onClick='document.getElementById("logout").submit();' target="_self" uk-icon="sign-out"></a>

        <a class="uk-link-reset uk-icon-button" href="{{ route('Profile') }}" target="_self" uk-icon="user"></a>

        <a class="uk-link-reset uk-icon-button" href="{{ route('Home') }}" target="_blank" uk-icon="home"></a>

        <form action="{{ route('logout') }}" method="post" class="uk-hidden" id="logout">
            @csrf
            <button type="submit"></button>
        </form>

        <a class="uk-link-reset uk-icon-button" id="switcher" onclick="switch_theme('light')" target="_self" uk-icon="paint-bucket"></a>

    </div>

</div>
