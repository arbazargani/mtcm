<div class="uk-background-secondary uk-light uk-padding uk-padding-remove-bottom uk-margin-medium-top">
    <!-- sockets holder -->
    <div class="uk-child-width-1-4@m uk-margin uk-background-secondary" uk-grid>

        <!-- socket -->
        <div class="uk-container">
            <h4 class="uk-text-emphasis">صفحات</h4>
            <hr class="uk-divider-small">
            <ul class="uk-list">
                <li>
                    <span uk-icon="arrow-right"></span> <a class="uk-link-reset" href="{{ route('Page > Single', 'ارتباط')  }}">ارتباط</a>
                </li>
                <li>
                    <span uk-icon="arrow-right"></span> <a class="uk-link-reset" href="{{ route('Page > Single', 'درباره')  }}">درباره</a>
                </li>
                <li>
                <span uk-icon="arrow-right"></span> <a class="uk-link-reset" href="{{ route('Page > Single', 'تبلیغات')  }}">تبلیغات</a>
                </li>
            </ul>
        </div>
        <!-- socket -->


        <!-- socket -->
        <div class="uk-container">
            <h4 class="uk-text-emphasis">سایر رسانه‌ها</h4>
            <hr class="uk-divider-small">
            <div id="14730017806"><script type="text/JavaScript" src="https://www.aparat.com/embed/2TmSX?data[rnddiv]=14730017806&data[responsive]=yes"></script></div>
        </div>
        <!-- socket -->


        <!-- socket -->
        <div class="uk-container">
            <h4 class="uk-text-emphasis">آب و هوا</h4>
            <hr class="uk-divider-small">
            <style>
                iframe {
                    border: 0px !important;
                }
            </style>
            <!-- Begin Horuph.com Weather code -->
            <script src="http://weather.horuph.com/frame/?lang=fa&imagesize=1&color0=212121&color1=226699&bgcolor=3599FF&bdcolor=C4C4C4&border=1&curved=7&haveshadow=1&showdetail=1&showsponsors=0&showforcast=1&city=Tehran" type="text/javascript" language="javascript"></script>
            <!-- End Horuph.com Weather code -->
        </div>
        <!-- socket -->


        <!-- socket -->
        <div class="uk-container">
            <h4 class="uk-text-emphasis">جستجو</h4>
            <hr class="uk-divider-small">
            <form  class="uk-grid-small" action="/" uk-grid>
                <div class="uk-width-2-3">
                    <input class="uk-input" type="text" name="query" id="query">
                </div>
                <div class="uk-width-expand">
                    <button class="uk-button uk-button-primary" type="submit">جستجو</button>
                </div>
            </form>
        </div>
        <!-- socket -->

    </div>
    <!-- sockets holder -->

    <!-- sockets holder -->
    <div class="uk-background-secondary uk-padding-small" style="padding: 10px; border-top: 1px solid #4e4e4e;" uk-grid>

{{--        <div class="uk-width-1-2">--}}
{{--            <img src="{{ asset('assets/image/logo.png') }}" style="width: 24px; height: 24px; vertical-align: middle;" alt="Alireza Bazargani">--}}
{{--            <span style="font-size: 11px!important;">طراحی توسط</span>--}}
{{--            <a class="uk-link-reset uk-text-primary" href="{{ route('Home') }}" target="_blank" rel="follow">--}}
{{--                <span style="font-size: 11px!important;">علیرضا بازرگانی</span>--}}
{{--            </a>--}}
{{--        </div>--}}
        <div class="uk-width-1-2">
            <img src="{{ asset('assets/image/mamooth-cms.png') }}" style="width: 24px; height: 24px; background: white; padding: 2px; border-radius: 3px; vertical-align: middle;" alt="MAMOOT CMS">
            <a class="uk-link-reset uk-text-primary" href="{{ route('Home') }}" target="_blank" rel="follow">
                <span style="font-size: 11px!important;">سیستم مدیریت محتوای 'ماموت'</span>
            </a>
        </div>
        <div class="uk-width-1-2">
            <a class="uk-float-left" href="{{ route('Rss') }}" target="_blank" class="uk-icon-link" uk-icon="rss"></a>
            <span class="uk-float-left"> &nbsp;&nbsp;|&nbsp;&nbsp;</span>
            <a class="uk-float-left" href="" target="_blank" class="uk-icon-link" uk-icon="twitter"></a>
        </div>

    </div>
    <!-- sockets holder -->

</div>
