    <div class="uk-card uk-card-default">
        <div class="uk-card-header">
            <h3 class="uk-meta">دیدگاه کاربران</h3>
        </div>
        <div class="uk-card-body">
            <ul class="uk-background-muted uk-text-light" uk-accordion>
                <li>
                    <a class="uk-accordion-title uk-padding-small" href="#">افزودن دیدگاه</a>
                    <div class="uk-accordion-content">
                        <div class="uk-card-body">
                            <form class="uk-forn" action="{{ route('Comment > Submit', $article[0]->id) }}" method="post">
                                @csrf
                                @if(!Auth::check())
                                    <div class="uk-grid-match uk-grid-small uk-text-center uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>
                                        <div>
                                            <input id="name" type="text" placeholder="نام"
                                                   class="uk-input form-control @error('name') is-invalid @enderror uk-width-1-1@m"
                                                   name="name"
                                                   required autocomplete="name">
                                        </div>
                                        <div>
                                            <input id="family" type="text" placeholder="نام خانوادگی"
                                                   class="uk-input form-control @error('family') is-invalid @enderror"
                                                   name="family"
                                                   required autocomplete="family">
                                        </div>
                                    </div>
                                    <div class="uk-grid-match uk-grid-small uk-text-center uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>
                                        <div>
                                            <input id="email" type="text" placeholder="ایمیل"
                                                   class="uk-input form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   required autocomplete="email">
                                        </div>
                                        <div>
                                            <input id="website" type="text" placeholder="وبسایت"
                                                   class="uk-input form-control @error('website') is-invalid @enderror"
                                                   name="website"
                                                   autocomplete="website">
                                        </div>
                                    </div>
                                @else
                                    <div class="uk-grid-match uk-grid-small uk-text-right" uk-grid>
                                        <div class="uk-width-1-2@m">
                                            <p>
                                                ثبت دیدگاه با کاربر {{ Auth::user()->username }}. | <a
                                                    href="{{ route('User > Logout') }}">خروج؟</a>
                                            </p>
                                        </div>
                                        <div class="uk-width-1-2@m">
                                            <input id="website" type="text" placeholder="وبسایت"
                                                   class="uk-input form-control @error('website') is-invalid @enderror"
                                                   name="website"
                                                   autocomplete="website">
                                        </div>
                                    </div>
                                @endif
                                <div class="uk-grid-match uk-grid-small uk-child-width-1-1 uk-text-right" uk-grid>
                                    <div>
                                        <textarea id="content" class="uk-input uk-height-medium" uk-input form-control
                                                @error('content') is-invalid
                                                @enderror name="content" rows="8" cols="80" style="width: 100%;"
                                                placeholder="نظرتان را بنویسید."></textarea>
                                        <hr>
                                        <button type="submit" class="uk-button uk-button-primary">ثبت</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
            @if(count($comments->where('approved', '=', 1)))
                @foreach($comments->reverse() as $comment)
                    @if($comment->approved)
                        <div class="uk-comment uk-comment-primary uk-margin-small">
                            <div class="uk-comment-header">
                                ارسال شده توسط
                                <a>{{ $comment->name . ' ' . $comment->family }}</a>
                                در تاریخ
                                {{ $comment->created_at }}
                            </div>
                            <div class="uk-comment-body uk-padding-small" style="background-color: rgba(74,123,227,0.11)">
                                <p class="uk-margin-small-right">
                                    {{ $comment->content }}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="uk-alert uk-alert-danger">
                    <span>دیدگاهی برای این نوشته ثبت نشده است.</span>
                </div>
            @endif
        </div>
    </div>
