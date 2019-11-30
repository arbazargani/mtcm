@extends('admin.template')

@section('meta')
<title>ایجاد مقاله جدید</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-default">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                ایجاد صفحه جدید
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid action="{{ route('Page > Submit') }}" method="POST">
                @csrf
                <div class="uk-width-2-3@m">
                    <div class="uk-inline uk-width-1-1 uk-first-column">
                        <input type="text" name="title" id="title" placeholder="عنوان" class="uk-input form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required style="padding-left: 40px;" autofocus>
                    </div>
                    <div class="uk-inline uk-width-1-1 uk-first-column">
                        <textarea name="content" id="content" placeholder="محتوای اصلی مقاله خود را وارد کنید." class="uk-input uk-textarea form-control @error('content') is-invalid @enderror" style="padding-left: 40px;">{{ old('content') }}</textarea>
                    </div>
                </div>
                <div class="uk-width-1-3@m">
                    <button type="submit" name="publish" class="uk-button uk-button-primary uk-border-rounded" value="1">انتشار</button>
                    <button type="submit" name="draft" class="uk-button uk-button-default uk-border-rounded" value="1">پیش‌نویس</button>
                </div>
            </form>
        </div>
    </div>
@endsection
