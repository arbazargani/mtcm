{{-- Jquery --}}
<script src="{{ asset('assets/js/jquery-3.5.0.min.js') }}"></script>

{{-- TinyMCE --}}
<script src="{{ asset('assets/js/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector:'#content',
        plugins : 'visualblocks wordcount ltr rtl directionality advlist autolink link image lists charmap print preview table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol code',
        toolbar: 'visualblocks wordcount ltr rtl directionality advlist autolink link image lists charmap print preview table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol code',
        directionality : "rtl",
        height: 500,
        file_picker_callback (callback, value, meta) {
            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

            tinymce.activeEditor.windowManager.openUrl({
                url : '/file-manager/tinymce5',
                title : 'FileManager',
                width : x * 0.8,
                height : y * 0.8,
                onMessage: (api, message) => {
                    callback(message.content, { text: message.text })
                }
            })
        }
    });
</script>



{{-- Google Charts --}}
<script src="{{ asset('assets/js/loader.js') }}"></script>

{{-- select2 js --}}
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/js/select2.min.js') }}"></script>

<style>
    li.select2-selection__choice {
        color: #727272;
    }
</style>
<script>
    $(document).ready(function() {
        $('.uk-select').select2();
    });
</script>

{{-- Theme mode switcher --}}
<script>
    function switch_theme(mode) {

        const switches = document.getElementsByClassName('uk-section');

        for (let item of switches) {
            item.classList.remove('uk-light');
            item.classList.remove('uk-background-secondary');
            item.classList.remove('uk-section-secondary');
            item.classList.remove('uk-section-default');
            item.classList.add('uk-background-default');
            item.classList.add('uk-dark');
        }

    }
</script>
    
{{-- Persian Datepicker --}}
<!-- dependes on jquery -->
<script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">

<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").pDatepicker({
            format: 'YYYY-MM-DD H:m:s',
            calendar:{
                persian: {
                    locale: 'fa'
                }
            }
        });
    });
</script>
