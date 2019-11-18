<div class="uk-section">
    <div class="uk-card uk-card-default">
        <div class="uk-card-header">
            <h3 class="uk-meta">ارسال کامنت</h3>
        </div>
        <div class="uk-card-body">
            <form class="uk-forn" action="{{ route('Comment > Submit', $article[0]->id) }}" method="post">
                @csrf
                @if(!Auth::check())
                    <div class="uk-inline uk-width-1-1 uk-grid uk-grid-margin uk-column-1-2 uk-first-column" uk-grid>
                        <div>
                            <i class="uk-form-icon uk-icon" uk-icon="icon: user" style="right: auto"></i>
                            <input id="name" type="text" placeholder="نام"
                                   class="uk-input form-control @error('name') is-invalid @enderror" name="name"
                                   required autocomplete="name">
                        </div>
                        <div>
                            <i class="uk-form-icon uk-icon" uk-icon="icon: user" style="right: auto"></i>
                            <input id="family" type="text" placeholder="نام خانوادگی"
                                   class="uk-input form-control @error('family') is-invalid @enderror" name="family"
                                   required autocomplete="family">
                        </div>
                    </div>
                    <div class="uk-inline uk-width-1-1 uk-grid uk-grid-margin uk-column-1-2 uk-first-column" uk-grid>
                        <div>
                            <i class="uk-form-icon uk-icon" uk-icon="icon: inbox" style="right: auto"></i>
                            <input id="email" type="text" placeholder="ایمیل"
                                   class="uk-input form-control @error('email') is-invalid @enderror" name="email"
                                   required autocomplete="email">
                        </div>
                        <div>
                            <i class="uk-form-icon uk-icon" uk-icon="icon: web" style="right: auto"></i>
                            <input id="website" type="text" placeholder="وبسایت"
                                   class="uk-input form-control @error('website') is-invalid @enderror" name="website"
                                   autocomplete="website">
                        </div>
                    </div>
                @else
                <div class="uk-inline uk-width-1-1 uk-grid uk-grid-margin uk-column-1-2 uk-first-column" uk-grid>
                    <div>
                        <span>
                        ثبت دیدگاه با کاربر {{ Auth::user()->username }}. | <a
                        href="{{ route('User > Logout') }}">خروج؟</a>
                        </span>
                    </div>
                    <div>
                        <i class="uk-form-icon uk-icon" uk-icon="icon: web" style="right: auto"></i>
                        <input id="website" type="text" placeholder="وبسایت"
                               class="uk-input form-control @error('website') is-invalid @enderror" name="website"
                               autocomplete="website">
                    </div>
                </div>
                @endif
                <div class="uk-inline uk-width-1-1 uk-grid uk-grid-margin" uk-grid>
                    <div>
                        <textarea id="content" class="uk-input uk-height-medium" uk-input form-control @error('content') is-invalid
                                  @enderror name="content" rows="8" cols="80" style="width: 100%;"
                                  placeholder="نظرتان را بنویسید."></textarea>
                        <hr>
                        <button type="submit" class="uk-button uk-button-primary">ثبت</button>
                        <button type="reset" class="uk-button uk-button-default">پاک کردن</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if(count($comments))
    <div class="uk-card uk-card-default">
        <div class="uk-card-header">
            <h3 class="uk-meta">دیدگاه کاربران</h3>
        </div>
        <div class="uk-card-body">
            @foreach($comments as $comment)
                <div class="uk-comment uk-comment-primary uk-margin-small">
                    <div class="uk-comment-header">
                        ارسال شده توسط
                        {{ $comment->name }}
{{--                        {{ $comment['name'] }}--}}
                        در تاریخ
                        {{ $comment->created_at }}
{{--                        {{ $comment['created_at'] }}--}}
                    </div>
                    <div class="uk-comment-body uk-padding-small" style="background-color: rgba(74,123,227,0.11)">
                        <p class="uk-margin-small-right">
                            {{ $comment->content }}
{{--                            {{ $comment['content'] }}--}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="uk-alert uk-alert-danger">
        <span>دیدگاهی برای این نوشته ثبت نشده است.</span>
    </div>
@endif
