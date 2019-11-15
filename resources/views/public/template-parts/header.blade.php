<div class="tm-navbar-container uk-navbar-container uk-light uk-active">
    <div class="uk-container uk-container-expand uk-background-secondary">
        <nav class="uk-navbar">
            <div class="uk-navbar-right">
                <a class="uk-navbar-item uk-logo" href="{{ route('Home') }}">
                    <img
                        src="{{ asset('assets/image/logo.png') }}" alt="سیستم مدیریت محتوای تاینی"
                        style="width: 48px; height: 48px;"></a>
                <div class="uk-width-auto">
                    <h4 class="uk-margin-remove-bottom uk-visible@s">سیستم مدیریت محتوای تاینی</h4>
                </div>
            </div>
            <div class="uk-navbar-left">
                <ul class="uk-navbar-nav uk-visible@m">
                    @if(!Auth::check())
                    <li class="uk-active">
                        <a href="{{ route('login') }}"><span style="padding: 2px 0px 4px;">ورود</span></a>
                    </li>
                    @else
                    <li class="">
                        <a href="{{ route('Admin') }}">
                            <span style="background: #FFFFFF; color: #2088F0; padding: 2px 12px 4px;">پنل مدیریت</span>
                        </a>
                    </li>

                        <li class="">
                            <a href="{{ route('User > Logout') }}">خروج</a>
                        </li>
                    @endif
                    <li class="">
                        <a href="javascript:void(0)" class="uk-icon-link" aria-expanded="false">
                            <span>صفحات مهم</span>
                            <i class="fa fa-angle-down fa-lg fa-fw"></i>
                        </a>
                        <div uk-dropdown="pos: bottom-justify; mode: click; offset: -16;"
                             class="uk-padding-small uk-dropdown"
                             style="width: 170.406px; left: -29.7969px; top: 64px;">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="">
                                    <a href="#" target="_blank">
                                        <span>فرم تماس</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#" target="_self">
                                        <span>ثبت سفارش</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                    <!-- start of mobile menu -->
                    <button class="uk-button uk-button-default uk-margin-small uk-hidden@m" type="button" uk-toggle="target: #modal-menu" style="margin-left: 3px;">فهرست</button>
                    <div id="modal-menu" uk-modal>
                      <div class="uk-modal-dialog uk-modal-body">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        @if(!Auth::check())
                            <div>
                                <a class="uk-button uk-button-primary" href="{{ route('login') }}">ورود</a>
                            </div>
                        @else
                           <div class="uk-flex uk-flex-center">
                            <a href="{{ route('Admin') }}" style="margin: 0 2px 0 2px;">
                                <span class="uk-button uk-button-primary" style="text-decoration: none;">پنل مدیریت</span>
                            </a>
                            <a href="{{ route('User > Logout') }}" style="margin: 0 2px 0 2px;">
                                <span class="uk-button uk-button-danger" style="text-decoration: none;">خروج</span>
                            </a>
                           </div>
                        @endif
                            <hr class="uk-divider-icon">
                            <span>فهرست دسته‌بندی ها</span>
                            <ul>
                                @foreach($categories as $category)
                                    @if($category->id !== 1)
                                        <li><a href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                      </div>
                    </div>
                    <!-- end of mobile menu -->
            </div>
        </nav>
    </div>
</div>
