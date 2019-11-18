@extends('admin.template')

@section('meta')
    <title>ویرایش برگه</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-default">
        <div class="uk-container uk-container-large">
            <h2 class="uk-h2 tm-heading-fragment">
                ویرایش برگه
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid="" action="{{ route('Page > Update', $page->id) }}" method="POST">
                @csrf
                <div class="uk-width-2-3">
                    <div class="uk-inline uk-width-1-1 uk-first-column">
                        <input type="text" name="title" id="title" placeholder="عنوان" class="uk-input form-control @error('title') is-invalid @enderror" value="{{ $page->title  }}" required style="padding-left: 40px;" autofocus>
                    </div>
                    <div class="uk-inline uk-width-1-1 uk-first-column">
                        <textarea name="content" id="content" placeholder="محتوای اصلی مقاله خود را وارد کنید." class="uk-textarea form-control @error('content') is-invalid @enderror" style="padding-left: 40px;" rows="7">{{ $page->content }}</textarea>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <div class="uk-container">
                        <button type="submit" name="update" class="uk-button uk-button-medium uk-button-secondary uk-border-rounded" value="1">بروزرسانی</button>
                        @if($page->state == 1)
                            <button type="submit" name="draft" class="uk-button uk-button-medium uk-button-danger uk-border-rounded" value="1">پیش‌نویس</button>
                        @elseif($page->state == 0)
                            <button type="submit" name="publish" class="uk-button uk-button-medium uk-button-primary uk-border-rounded" value="1">انتشار</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
