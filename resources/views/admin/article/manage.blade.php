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
                <button class="uk-button uk-button-small uk-border-rounded uk-button-primary" onclick="location.href='{{ route('Article > New') }}'">
                    ایجاد مقاله
                </button>
            </p>
            @if(count($articles))
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-striped uk-table-hover">
                    {{--                            <caption>آخرین مقالات</caption>--}}
                    <thead>
                    <tr>
                        <th>عنوان مقاله</th>
                        <th>تاریخ انتشار</th>
                        <th>دسته‌بندی</th>
                        <th>برچسب‌ها</th>
                        <th>ویرایش</th>
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
                        <th>ویرایش</th>
                        <th>حذف</th>
                        <th>بازدید</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td>@foreach($article->category as $category) <a href="{{ route('Category > Archive', $category->slug) }}" class="uk-text-meta">{{ $category->name }}@if(!$loop->last) {{', '}} @endif</a> @endforeach</td>
                            <td>@foreach($article->tag as $tag) <a href="{{ route('Tag > Archive', $tag->slug) }}" class="uk-text-meta">{{ $tag->name }}@if(!$loop->last) {{', '}} @endif</a>@endforeach</td>
                            <td>
                                <a href="{{ route('Article > Edit', $article->id) }}">
                                    <button class="uk-button uk-button-small uk-button-primary">ویرایش</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('Article > Delete', $article->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="uk-button uk-button-small uk-button-danger">حذف</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('Article > Single', $article->slug) }}">بازدید</a>
                            </td>
                        </tr>
                    @endforeach
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
