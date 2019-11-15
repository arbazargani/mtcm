@extends('admin.template')

@section('meta')
<title>مدیریت برگه‌ها</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-default">
        <div class="uk-container uk-container-small">
            <div>
                <div>
                    <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                        مدیریت برگه‌ها
                    </h2>
                    <p class="uk-text-lead uk-text-meta">
                        <button class="uk-button uk-button-small uk-border-rounded uk-button-primary" onclick="location.href='{{ route('Page > New') }}'">
                            ایجاد برگه
                        </button>
                    </p>
                    @if(count($pages))
                        <table class="uk-table uk-table-striped uk-table-hover">
    {{--                            <caption>آخرین برگه‌ها</caption>--}}
                                <thead>
                                <tr>
                                    <th>عنوان برگه</th>
                                    <th>تاریخ انتشار</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                    <th>بازدید</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td>عنوان برگه</td>
                                    <td>تاریخ انتشار</td>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                    <th>بازدید</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($pages as $page)
                                    <tr>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->created_at }}</td>
                                        <td>
                                            <a href="{{ route('Page > Edit', $page->id) }}">
                                                <button class="uk-button uk-button-small uk-button-primary">ویرایش</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('Page > Delete', $page->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="uk-button uk-button-small uk-button-danger">حذف</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('Page > Single', $page->slug) }}">بازدید</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                        {{ $pages->links() }}
                    @else
                        <div class="uk-alert-warning" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>برگه‌ای در سیستم موجود نیست.</p>
                        </div>
                    @endif
            </div>
        </div>
    </div>
@endsection
