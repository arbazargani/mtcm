@extends('admin.template')

@section('meta')
<title>مدیریت مقالات</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-default">
        <div class="uk-container uk-container-small">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                مدیریت مقالات
            </h2>
            <p class="uk-text-lead uk-text-meta">
            <div class="uk-margin" uk-grid>
                <div>
                    <button class="uk-button uk-button-small uk-border-rounded uk-button-primary" onclick="location.href='{{ route('Article > New') }}'">ایجاد مقاله</button>
                </div>
                <div>
                    <form method="get">
                        <span class="uk-text-meta">دسته‌بندی:‌ </span>
                        <select class="uk-select uk-input uk-form-width-medium uk-form-small" name="category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit">اعمال</button>
                    </form>
                </div>
                <div>
                    <form method="get">
                        <span class="uk-text-meta">برچسب‌ها:‌ </span>
                        <select class="uk-select uk-input uk-form-width-medium uk-form-small" name="tag">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit">اعمال</button>
                    </form>
                </div>
                </div>
            </p>
            @if(count($articles))
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-striped uk-table-hover">
                    {{--<caption>آخرین مقالات</caption>--}}
                    <thead>
                    <tr>
                        <th>عنوان مقاله</th>
                        <th>تاریخ انتشار</th>
                        <th>دسته‌بندی</th>
                        <th>برچسب‌ها</th>
                        <th>وضعیت</th>
                        <th>ویرایش</th>
                        <th>عملیات</th>
                        <th>حذف</th>
                        <th>بازدید</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td>عنوان مقاله</td>
                        <td>تاریخ انتشار</td>
                        <th>دسته‌بندی</th>
                        <th>برچسب‌ها</th>
                        <th>وضعیت</th>
                        <th>ویرایش</th>
                        <th>عملیات</th>
                        <th>حذف</th>
                        <th>بازدید</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @include('admin.article.fetch')
                    </tbody>
                </table>
                </div>
            @else
                <div class="uk-alert-warning" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>مقاله‌ای در سیستم موجود نیست.</p>
                </div>
            @endif
        </div>
@endsection
