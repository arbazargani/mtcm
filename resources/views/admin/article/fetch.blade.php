@foreach($articles as $article)
    @if(isset($_GET['category']) && !empty($_GET['category']))
        @foreach($article->category as $FilterCategory)
            @if($FilterCategory->id == $_GET['category'])
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
            @endif
        @endforeach
    @elseif(isset($_GET['tag']) && !empty($_GET['tag']))
        @foreach($article->tag as $FilterTag)
            @if($FilterTag->id == $_GET['tag'])
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
            @endif
        @endforeach

    @else
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
    @endif
@endforeach
