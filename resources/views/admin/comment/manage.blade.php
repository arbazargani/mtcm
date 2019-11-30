@extends('admin.template')

@section('meta')
<title>مدیریت دیدگاه‌ها</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-default">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                مدیریت دیدگاه‌های ثبت شده توسط کاربران
            </h2>
            <div class="uk-grid-small uk-position-relative uk-grid" uk-grid>
                <div class="uk-width-1-1">
                    @if(count($comments))
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-striped uk-table-hover">
                                {{--<caption>آخرین مقالات</caption>--}}
                                <thead>
                                <tr>
                                    <th>محتوای دیدگاه</th>
                                    <th>تاریخ انتشار</th>
                                    <th>مقاله مرتبط</th>
                                    <th>نویسنده</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>محتوای دیدگاه</th>
                                    <th>تاریخ انتشار</th>
                                    <th>مقاله مرتبط</th>
                                    <th>نویسنده</th>
                                    <th>حذف</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>
                                            <span style="white-space: nowrap;
                                                         overflow: hidden;
                                                         text-overflow: ellipsis;
                                            ">{{ $comment->content }}</span>
                                        </td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td><a href="{{ route('Article > Single', $comment->article->slug) }}">{{ $comment->article->title }}</a></td>
                                        <td>{{ $comment->name . $comment->family }}</td>
                                        <td>
                                            <form action="{{ route('Comment > Delete', $comment->id) }}" method="post">
                                                @csrf
                                                <button class="uk-button uk-button-danger" type="submit">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="uk-alert-warning" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>دیدگاهی در سیستم ثبت نشده است.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
