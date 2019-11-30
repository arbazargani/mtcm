@extends('public.template')

@section('content')
<div class="uk-container uk-align-center uk-width-1-3@m uk-width-1-2@s uk-padding-remove uk-first-column" style="max-width: 1120px;">
    <div class="uk-card uk-card-default uk-box-shadow-small">
        <div class="uk-card-header" style="padding: 15px 30px 17px;">
            <h2 class="uk-margin-remove uk-visible@s">ورود به سامانه</h2>
            <h3 class="uk-margin-remove uk-hidden@s">ورود به سامانه</h3>
        </div>
        <div class="uk-card-body uk-padding-xsmall">
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid="" action="{{ route('login') }}" method="POST">
                @csrf
                <input type="hidden" name="redirect" value="">
                <div class="uk-inline uk-width-1-1 uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: user" style="right: auto"></i>
                    <input id="username" type="text" placeholder="نام کاربری" class="uk-input form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" style="padding-left: 40px;" autofocus>
{{--                    @error('username')--}}
{{--                    <div class="uk-alert-danger" uk-alert role="alert">--}}
{{--                        <a class="uk-alert-close" uk-close></a>--}}
{{--                        <p><strong>{{ $message }}</strong></p>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

                    {{--for mail login--}}
                <!-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->
                    {{--                    @error('email')--}}
                    {{--                        <span class="invalid-feedback" role="alert">--}}
                    {{--                            <strong>{{ $message }}</strong>--}}
                    {{--                        </span>--}}
                    {{--                    @enderror--}}
                </div>
                <div class="uk-inline uk-width-1-1 uk-grid-margin uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: lock" style="right: auto"></i>
                    <input id="password" type="password" placeholder="گذرواژه" class="uk-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

{{--                    @error('password')--}}
{{--                    <div class="uk-alert-danger" uk-alert role="alert">--}}
{{--                        <a class="uk-alert-close" uk-close></a>--}}
{{--                        <p><strong>{{ $message }}</strong></p>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
                </div>
                <div class="uk-inline uk-width-1-1 uk-grid-margin uk-first-column">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div class="uk-width-1-2@s uk-grid-margin uk-first-column">
                    <button class="uk-button uk-button-primary uk-width-1-1" style="padding: 0px 8px;" name="LoginFromWeb">ورود به سامانه</button>
                </div>
                <div class="uk-width-1-2@s uk-grid-margin">
                    <a class="uk-button uk-button-secondary uk-width-1-1" style="padding: 0px 8px;" href="http://adsl.tci.ir/signup/">ثبت نام آنلاین</a>
                </div>
            </form>
        </div>
        <div class="uk-card-footer">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
