@extends('admin.template')

@section('meta')
<title>ایجاد مقاله جدید</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-default">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                ایجاد مقاله
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger uk-grid-small uk-position-relative uk-grid" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid action="{{ route('Article > Submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="uk-width-2-3@m">
                    <div class="uk-inline uk-width-1-1 uk-first-column uk-margin-small-bottom">
                        <input type="text" name="title" id="title" placeholder="عنوان" class="uk-input form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required style="padding-left: 40px;" autofocus>
                    </div>
                    <div class="uk-inline uk-width-1-1 column uk-margin-small-bottom">
                        <textarea name="content" id="content" placeholder="محتوای اصلی مقاله خود را وارد کنید." class="uk-input uk-textarea form-control @error('content') is-invalid @enderror" style="padding-left: 40px;">{{ old('content') }}</textarea>
                    </div>
                </div>
                <div class="uk-width-1-3@m column uk-margin-small-bottom">
                    <div class="uk-container">
                        <button type="submit" name="publish" class="uk-button uk-button-primary uk-border-rounded" value="1">انتشار</button>
                        <button type="submit" name="draft" class="uk-button uk-button-default uk-border-rounded" value="1">پیش‌نویس</button>
                    </div>
                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                        <h4 class="uk-h4 tm-heading-fragment">دسته‌بندی</h4>
                        <select name="categories[]" id="categories" class="uk-select" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                        <h4 class="uk-h4 tm-heading-fragment">برچسب‌ها</h4>
                        <select name="tags[]" id="tags" class="uk-select" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                        <h4 class="uk-h4 tm-heading-fragment">تصویر نوشته</h4>
                        <input type="file" name="cover" id="cover">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
