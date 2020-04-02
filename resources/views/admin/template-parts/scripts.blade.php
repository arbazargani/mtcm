{{-- jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

{{-- tinymce editor --}}
<script src="https://cdn.tiny.cloud/1/b3zbxrwztsjum71vs51caf64xuyitiqpxu3irnfb1i7qgusn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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



{{-- google charts --}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

{{-- select2 js --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
