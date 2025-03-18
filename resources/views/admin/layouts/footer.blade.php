</div>
</div>
<!--**********************************
    Content body end
***********************************-->

<!--**********************************
    Footer start
***********************************-->
{{--<div class="footer">--}}
{{--    <div class="copyright">--}}
{{--        <p>{{ env('APP_NAME') }} © Разработано <a href="https://ilyaskorolev.com/" target="_blank">Ilyas Korolev</a> 2023</p>--}}
{{--    </div>--}}
{{--</div>--}}
<!--**********************************
    Footer end
***********************************-->

<!--**********************************
   Support ticket button start
***********************************-->

<!--**********************************
   Support ticket button end
***********************************-->


</div>

<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
@include('admin.layouts.modals')
<!-- Required vendors -->
<script src="/admin_assets/vendor/global/global.min.js"></script>
{{--<script src="/admin_assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>--}}
<script src="/admin_assets/js/custom.js"></script>
<script src="/admin_assets/js/deznav-init.js"></script>
<script src="/admin_assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="/admin_assets/js/tinymce/tinymce.min.js"></script>


<!-- Svganimation scripts -->
<script src="/admin_assets/vendor/svganimation/vivus.min.js"></script>
<script src="/admin_assets/vendor/svganimation/svg.animation.js"></script>
<script src="/admin_assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/front_assets/js/map.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

    // Файловый менеджер
    var fileManager = function(id, type, options, inputId) {
        let button = document.getElementById(id);
        let input = document.getElementById(inputId);
        // let block = document.getElementById(videoBlock);
        button.addEventListener('click', function () {
            var route_prefix = (options && options.prefix) ? options.prefix : '/admin/laravel-filemanager';

            $('#fileManagerModal').modal('show');
            window.open(route_prefix + '?type=' + type || 'image', 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    console.log(item);
                    // console.log(item.url);
                    input.value = item.url;
                    input.classList.remove('d-none');
                    if(id == 'chooseCoverBtn'){
                        document.getElementById('cover_filename').value = item.name;
                        document.getElementById('cover_thumb_url').value = item.thumb_url;
                    }
                    // image.setAttribute('src', item.url);
                    // return item.url;
                    $('#fileManagerModal').modal('hide');
                    // if(isVideo){
                    //     block.classList.remove('d-none');
                    // }
                }).join(',');
            };
        });
    };

    //Фотогалерея
    var photoGallery = function(id, type, options) {
        let button = document.getElementById(id);
        let block = document.getElementById('gallery-block');

        button.addEventListener('click', function () {
            var route_prefix = (options && options.prefix) ? options.prefix : '/admin/laravel-filemanager';

            $('#fileManagerModal').modal('show');
            window.open(route_prefix + '?type=' + type || 'image', 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {


                // console.log(items);
                var file_path = items.map(function (item, index) {

                    let name = 'photos[]';
                    if(options.type == 'cover'){
                         name = 'cover_url';
                    }else{
                         name = 'photos[]';
                    }

                    $('#photo_gallery_body').append(' <div class="col-12 col-md-3" data-name="'+item.name+'"> <img src="'+item.url+'" class="img-fluid img-gallery" alt=""> <input value="'+item.url+'" class="d-none" name="'+name+'" ><div class="form-group"> <label for="">Alt</label> <input type="text" name="alt_'+name+'" class="form-control"> </div><div class="form-group"> <button type="button" class="btn btn-danger deleteGalleryRow" value="'+item.name+'">Удалить</button> </div><hr></div>');
                    // console.log(item);
                    // console.log(item.url);
                    // input.value = item.url;
                    // image.setAttribute('src', item.url);
                    // return item.url;

                    // if(isVideo){
                    //block.classList.remove('d-none');
                    // }
                }).join(',');
                $('#fileManagerModal').modal('hide');
            };
        });
    };

    // photoGallery('chooseIconGallery', 'image', {prefix: '/admin/laravel-filemanager'});


</script>
<script src="/admin_assets/js/scripts.js"></script>
<script>
	var tinyMCEConfig = {
		plugins: 'image link lists table preview emoticons charmap ',
		toolbar: 'preview | undo redo | cut copy paste | blocks fontsize | bold italic underline removeformat | alignleft aligncenter alignright | link image | bullist numlist outdent indent | table | emoticons charmap ',
		toolbar_mode: 'wrap',
		menubar: false,
		// images_upload_url: '/admin/upload/image', // URL для загрузки изображений
		automatic_uploads: true,
		file_picker_types: 'image',
		image_dimensions: false,
		images_upload_credentials: true,
		images_upload_handler: function (blobInfo, progress) {
			return new Promise((resolve, reject) => {
				var xhr, formData;

				xhr = new XMLHttpRequest();
				xhr.withCredentials = false;
				xhr.open('POST', '/admin/upload/image');
				xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

				xhr.onload = function() {
					var json;

					if (xhr.status < 200 || xhr.status >= 300) {
						reject('HTTP Error: ' + xhr.status);
						return;
					}

					json = JSON.parse(xhr.responseText);

					if (!json || typeof json.location != 'string') {
						reject('Invalid JSON: ' + xhr.responseText);
						return;
					}

					resolve(json.location);
				};

				formData = new FormData();
				formData.append('file', blobInfo.blob(), blobInfo.filename());

				xhr.send(formData);
			});
    }
	};
</script>
@yield('footer')
</body>
</html>
