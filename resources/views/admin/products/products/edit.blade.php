@extends('admin.layouts.app')
@section('page_title', 'Редактировать')
@section('page_name', 'Редактировать')
@section('header')
    <link rel="stylesheet" href="/admin_assets/vendor/select2/css/select2.min.css">
    <link href="/admin_assets/vendor/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    <style>
        .media-img{
            height: 200px;
        }
    </style>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $product->name }}</li>
@endsection
@section('content')
    <form action="{{ route('admin.products.products.update', $product) }}" method="POST" enctype="multipart/form-data"> @csrf @method('put')
    <div class="card">
        <div class="card-header d-flex justify-content-start">
            <a href="{{ route('front.products.show', $product) }}" target="_blank" class="btn btn-info mr-2"><i class="fa fa-eye"></i></a>
            <button type="button" data-toggle="modal" data-target="#addChars" class="btn btn-primary mr-2">Добавить характеристику</button>
            <button type="button" data-toggle="modal" data-target="#addRelated" class="btn btn-primary">Добавить сопутствующий товар</button>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-toggle="tab" data-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Основная информация</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="categories_and_tags-tab" data-toggle="tab" data-target="#categories_and_tags" type="button" role="tab" aria-controls="categories_and_tags" aria-selected="false">Бренды, категории и теги</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chars-tab" data-toggle="tab" data-target="#chars" type="button" role="tab" aria-controls="chars" aria-selected="false">Характеристики</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="media-tab" data-toggle="tab" data-target="#media" type="button" role="tab" aria-controls="media" aria-selected="false">Медия</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seo-tab" data-toggle="tab" data-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">SEO</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="related-tab" data-toggle="tab" data-target="#related" type="button" role="tab" aria-controls="related" aria-selected="false">Сопутствующие товары</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    @include('admin.products.products.parts.edit.info')
                </div>
                <div class="tab-pane fade" id="categories_and_tags" role="tabpanel" aria-labelledby="categories_and_tags-tab">
                    @include('admin.products.products.parts.edit.brand_and_categories')
                </div>
                <div class="tab-pane fade" id="chars" role="tabpanel" aria-labelledby="chars-tab">
                    @include('admin.products.products.parts.edit.chars')
                </div>
                <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                    @include('admin.products.products.parts.edit.media')
                </div>
                <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                    @include('admin.products.products.parts.edit.seo')
                </div>
                <div class="tab-pane fade" id="related" role="tabpanel" aria-labelledby="related-tab">
                    @include('admin.products.products.parts.edit.related')
                </div>
            </div>
        </div>
    </div>
        <button class="btn btn-success">Сохранить</button>
    </form>
@endsection
@section('footer')
    <!-- add chars -->
    <div class="modal fade" id="addChars" tabindex="-1" aria-labelledby="addCharsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCharsLabel">Добавить характеристику</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.products.products.chars.attach', $product) }}" method="POST"> @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_id">Категория <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($product->getCategories() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="char_id">Характеристика <span class="text-danger">*</span></label>
                        <select name="char_id" id="char_id" class="form-control">
                            @foreach($product->getCategories()->first()->chars()->get() as $char)
                                <option value="{{ $char->id }}">{{ $char->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="value">Значение <span class="text-danger">*</span></label>
                        <input type="text" name="value" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <!-- add related -->
    <div class="modal fade" id="addRelated" tabindex="-1" aria-labelledby="addRelatedLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRelatedLabel">Добавить сопутствующий товар</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.products.products.related.attach-product', $product) }}" method="POST"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product_id">Найти товар <span class="text-danger">*</span></label>
                            <select name="product_id" id="product_id" class="form-control search-products"></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @foreach($product->relatedProducts()->get() as $relatedProduct)
        <form action="{{ route('admin.products.products.related.detach-product', $product) }}" method="POST">
            @csrf <button type="submit" id="related-btn-{{ $relatedProduct->id }}" class="d-none"><i class="fa fa-times"></i></button>
        </form>
    @endforeach

    <script src="/admin_assets/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="/admin_assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/admin_assets/js/plugins-init/jquery-steps-init.js"></script>
    <script src="/admin_assets/js/jquery.autocomplete.min.js"></script>
    <script src="/admin_assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="/admin_assets/js/plugins-init/select2-init.js"></script>
    <script>

        $(document).ready(function(){
            $('body').on('click', '.deletePhoto', function(){
                let id = $(this).attr('data-photoId');
                $.ajax({
                    url: '/admin/media/destroy/'+id,
                    method: 'POST',
                    success: function(data){
                        $('#photo-block-'+id).remove();
                    }
                });
            });
        });


        $('.search-products').select2({
            ajax: {
                url: '/api/products',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
            }
        });

        $('body').on('change', '#status', function(){
            if($(this).val() == 1){
                $('#amount').removeAttr('disabled');
            }else{
                $('#amount').attr('disabled', 'true');
            }
        });

        $('#category_id').on('change', function(){
            $.ajax({
                url: '/api/get-chars',
                data: {
                    category_id: $(this).val()
                },
                method: 'GET',
                // dataType: 'html',
                success: function(data){
                    $('#char_id option').remove();
                    $.each(data, function (i, item) {
                        $('#char_id').append($('<option>', {
                            value: item.id,
                            text : item.name
                        }));
                    });
                }
            });
        });


    </script>

	<script>
		tinymce.init({
			...tinyMCEConfig,
			placeholder: 'Описание',
			selector: 'textarea.editor',
		});
	</script>
@endsection
