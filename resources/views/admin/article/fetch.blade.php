@foreach($articles as $article)

@php
    $condition_type = isset($_GET['condition_type']) ? $_GET['condition_type'] : 'or';
    $author_matches = 1;
    $categories_matches = 0;
    $filters_set = 0;
    $article_matches = 1;
@endphp

@if( isset($_GET['author']) && !is_null($_GET['author'])  && $_GET['author'] != 'all' )
    @if($article->user_id == $_GET['author'])
        @php
            $author_matches = true;
        @endphp
    @else
        @php
            $author_matches = false;
        @endphp
    @endif
@endif
@if( isset($_GET['categories']) && count($_GET['categories']) )
    @foreach($article->category as $category)
        @foreach($_GET['categories'] as $param)
            @if($category->id == $param)
                @php
                    $categories_matches = true;
                @endphp
            @endif
        @endforeach
    @endforeach
@endif

@if( ($categories_matches == true || $author_matches == true) )
    @php
        //die ($categories_matches . '|' . $author_matches);
        $article_matches = true;
    @endphp
@endif

@if($article_matches)
    <tr>
        <td>{{ $article->title }}</td>
        <td>{{ $article->created_at }}</td>
        <td>@foreach($article->category as $category) <a href="{{ route('Category > Archive', $category->slug) }}" class="uk-text-meta">{{ $category->name }}@if(!$loop->last) {{', '}} @endif</a> @endforeach</td>
        <td>@foreach($article->tag as $tag) <a href="{{ route('Tag > Archive', $tag->slug) }}" class="uk-text-meta">{{ $tag->name }}@if(!$loop->last) {{', '}} @endif</a>@endforeach</td>
        <td>
            @if($article->state == 0)
                <div class="state-drafted"></div>
            @elseif($article->state == 1)
                <div class="state-published"></div>
            @else
                <div class="state-deleted"></div>
            @endif
        </td>
        <td>
            <a href="{{ route('Article > Edit', $article->id) }}">
                <button class="uk-button uk-button-small uk-button-secondary">ویرایش</button>
            </a>
        </td>
        <td>
            @if($article->state == -1)
                <form action="{{ route('Article > Restore', $article->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="uk-button uk-button-small uk-button-primary">بازیابی</button>
                </form>
            @else
                -
            @endif
        </td>
        <td>
            <form action="{{ route('Article > Delete', $article->id) }}" method="POST">
                @csrf
                <button type="submit" class="uk-button uk-button-text uk-text-danger">حذف</button>
            </form>
        </td>
        <td>
            <a href="{{ route('Article > Single', $article->slug) }}">بازدید</a>
        </td>
    </tr>
@endif

@endforeach

@if(!$article_matches)
<div class="uk-alert-warning" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>مقاله‌ای این ترکیب وجود ندارد.</p>
    <span>
        <a href="{{ route('Article > Manage') }}">پاک کردن فیلترها</a>
    </span>
</div>
@endif
