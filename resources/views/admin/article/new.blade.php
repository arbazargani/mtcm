@extends('admin.template')

@section('meta')
<title>ایجاد مقاله جدید</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                ایجاد مقاله
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger uk-grid-small uk-position-relative uk-grid" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid action="{{ route('Article > Submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="uk-width-2-3@m">
                    <div class="uk-inline uk-width-1-1 uk-first-column uk-margin-small-bottom">
                        <input type="text" name="title" id="title" placeholder="عنوان" class="uk-input form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required style="padding-left: 40px;" autofocus>
                    </div>
                    <div class="uk-inline uk-width-1-1 column uk-margin-small-bottom">
                        <textarea name="content" id="content" placeholder="محتوای اصلی مقاله خود را وارد کنید." class="uk-input uk-textarea form-control @error('content') is-invalid @enderror" style="padding-left: 40px;">{{ old('content') }}</textarea>
                    </div>
                    <hr>
                    <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded">
                        <h3 class="uk-card-title">تنظیمات</h3>
                        <div class="uk-inline uk-width-1-1 uk-first-column uk-margin-small-bottom">
                          <!-- meta description -->
                          <div class="">
                            <label class="uk-form-label" for="meta-description">اسنیپت (Meta:description)</label>
                              <textarea type="text" name="meta-description" id="meta-description" placeholder="توضیحات متا" class="uk-textarea form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required style="padding-left: 40px;" onkeydown="checkLength();"></textarea>
                              <style>
                                #meta-description-state {
                                  width: 0%;
                                  height: 4px!important;
                                }
                              </style>
                              <div id="meta-description-state" style="width: 100%; height: 10px!important"></div>
                              <p>
                                <ul>
                                  <li>حداقل ۱۲۰ کاراکتر باشد.</li>
                                  <li>حداکثر ۱۶۰ کاراکتر باشد.</li>
                                  <li>بهتر است شامل کلمات کلیدی باشد.</li>
                                </ul>
                              </p>
                              <script>
                                function checkLength() {
                                    var len = document.getElementById('meta-description').value.length;
                                    if (len >= 1 && len <= 70) {
                                      document.getElementById('meta-description-state').setAttribute('style', 'background: red; width: 30%;');
                                    }
                                    else if ( len >= 70 && len <= 120 ) {
                                      document.getElementById('meta-description-state').setAttribute('style', 'background: orange; width: 40%;');
                                    }
                                    else if ( len >= 120  && len <= 160 ) {
                                      document.getElementById('meta-description-state').setAttribute('style', 'background: green; width: 100%;');
                                    } else (
                                      document.getElementById('meta-description-state').setAttribute('style', 'background: red; width: 100%;')
                                    )
                                  }
                              </script>
                          </div>
                          <!-- meta robots -->
                          <div>
                              <label class="uk-form-label" for="meta-robots">خزنده (Meta:robots)</label>
                              <select class="uk-select" name="meta-robots">
                                <option value="index, follow">index, follow</option>
                                 <option value="noindex">noindex</option>
                                 <option value="nofollow">nofollow</option>
                                 <option value="noindex, nofollow">noindex, nofollow</option>
                               </select>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3@m column uk-margin-small-bottom">
                    <div class="uk-container">
                        <button type="submit" name="publish" class="uk-button uk-button-primary uk-border-rounded" value="1">انتشار</button>
                        <button type="submit" name="draft" class="uk-button uk-button-default uk-border-rounded" value="1">پیش‌نویس</button>
                    </div>
                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                        <h4 class="uk-h4 tm-heading-fragment">دسته‌بندی</h4>
                        <select name="categories[]" id="categories" class="uk-select" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <hr class="uk-divider-small">

                        <ul uk-accordion>
                            <li class="uk-close">
                                <a class="uk-accordion-title" href="#">افزودن دسته</a>
                                <div class="uk-accordion-content">
                                    <p style="display: none" id="cat_area"></p>
                                    <p id="cat_preview"></p>

                                    <input class="uk-input uk-margin" type="text" id="user_category">
                                    <a class="uk-button uk-button-link uk-float-left" onclick="add_cat()"><span uk-icon="arrow-right"></span> افزودن دسته</a>

                                    <script>
                                        function add_cat() {
                                            var name = document.getElementById('user_category').value;
                                            document.getElementById('cat_area').innerHTML += '<input class="uk-invisible uk-meta" type="text" name="new_categories[]" id="new_category_'+ name +'" value="'+ name +'">';
                                            document.getElementById('cat_preview').innerHTML +=  '<a id="cat_preview_'+ name +'" style="color: #9fb8cd" onclick="' + 'remove_cat(\'new_category_' + name + '\'), ' + 'remove_cat(\'cat_preview_' + name + '\')"><span uk-icon="close"></span>' + name + ' </a>';
                                            document.getElementById('user_category').value = '';
                                        }
                                        function remove_cat(id) {
                                            var elem = document.getElementById(id);
                                            return elem.parentNode.removeChild(elem);
                                        }
                                    </script>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                        <h4 class="uk-h4 tm-heading-fragment">برچسب‌ها</h4>
                        <select name="tags[]" id="tags" class="uk-select" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>

                        <hr class="uk-divider-small">

                        <ul uk-accordion>
                            <li class="uk-close">
                                <a class="uk-accordion-title" href="#">افزودن برچسب</a>
                                <div class="uk-accordion-content">
                                    <p style="display: none" id="tag_area"></p>
                                    <p id="tag_preview"></p>

                                    <input class="uk-input uk-margin" type="text" id="user_tag">
                                    <a class="uk-button uk-button-link uk-float-left" onclick="add_tag()"><span uk-icon="arrow-right"></span> افزودن برچسب</a>

                                    <script>
                                        function add_tag() {
                                            var name = document.getElementById('user_tag').value;
                                            document.getElementById('tag_area').innerHTML += '<input class="uk-invisible uk-meta" type="text" name="new_tags[]" id="new_tag_'+ name +'" value="'+ name +'">';
                                            document.getElementById('tag_preview').innerHTML +=  '<a id="tag_preview_'+ name +'" style="color: #9fb8cd" onclick="' + 'remove_tag(\'new_tag_' + name + '\'), ' + 'remove_tag(\'tag_preview_' + name + '\')"><span uk-icon="close"></span>' + name + ' </a>';
                                            document.getElementById('user_tag').value = '';
                                        }
                                        function remove_tag(id) {
                                            var elem = document.getElementById(id);
                                            return elem.parentNode.removeChild(elem);
                                        }
                                    </script>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                      <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded">
                        <h4 class="uk-h4 tm-heading-fragment">تصویر نوشته</h4>
                        <input type="file" name="cover" id="cover">
                      </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
