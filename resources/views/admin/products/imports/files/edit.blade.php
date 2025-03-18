@extends('admin.layouts.app')
@section('page_title', 'ExcelFile Import')
@section('page_name', 'ExcelFile Import')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.excelFiles.index') }}"> Импорт товаров</a></li>
    <li class="breadcrumb-item active">{{ $excelFile->name }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-inline-block">
            <button data-toggle="modal" data-target="#addParamModal" class="btn btn-primary">Добавить параметр импорта</button>

            <button data-toggle="modal" data-target="#importModal" class="btn btn-primary">Импортировать</button>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Параметры</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Основная информация</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Параметр</th>
                            <th>Колонка</th>
                            <th>Характеристика</th>
                            <th>Значение по умолчанию</th>
                            <th>мм в см</th>
                            <th>Заменяемые характеристики</th>
                            <th>Пропускать не заданные значения</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($excelFile->params()->get() as $excelFileParam)
                            <tr>
                                <td>{{ $excelFileParam->getParamName() }}</td>
                                <td>{{ $excelFileParam->column }}</td>
                                <td>{{ ($excelFileParam->char_id != 0) ? $excelFileParam->char?->name : '-'  }}</td>
                                <td>{{ $excelFileParam->default_amount }}</td>
                                <td>{{ ($excelFileParam->mm_to_cm) ? 'Да' : '' }}</td>
                                <td>{{ ($excelFileParam->change_value) ? 'Да' : '' }}</td>
                                <td>{{ ($excelFileParam->skip_new_values) ? 'Да' : '' }}</td>
                                <td>
                                    <a href="{{ route('admin.products.excelFileParams.edit', $excelFileParam) }}" class="btn btn-warning">Редактировать</a>
                                    <button onclick="destroy('#delete-key-', '{{ $excelFileParam->id }}')" class="btn btn-danger">Удалить</button>
                                    <form action="{{ route('admin.products.excelFileParams.destroy', $excelFileParam) }}" method="POST" id="delete-key-{{ $excelFileParam->id }}">@csrf @method('delete')</form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="{{ route('admin.products.excelFiles.update', $excelFile) }}" method="POST"> @csrf @method('put')
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name">Название</label>
                                    <input type="text" name="name" required value="{{ $excelFile->name }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="category_id">Категория</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        {!! printCategories($product_categories, 'option', '', $excelFile->category_id) !!}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-success">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <button data-toggle="modal" data-target="#addNameModal" class="btn btn-primary">Настройки формирования названия</button>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Параметр</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($excelFile->names()->get() as $excelFileName)
                        <tr>
                            <td>{{ $excelFileName->getParam() }}</td>
                            <td>
                                <button onclick="destroy('#delete-fileName-', '{{ $excelFileName->id }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.products.excelFileNames.destroy', $excelFileName) }}" method="POST" id="delete-fileName-{{ $excelFileName->id }}">@csrf @method('delete')</form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('footer')

    <!-- Modal -->
    <div class="modal fade" id="addParamModal" tabindex="-1" aria-labelledby="addParamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addParamModalLabel">Добавить параметр</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.products.excelFileParams.store') }}" method="POST"> @csrf
                    <input type="text" name="excel_file_id" value="{{ $excelFile->id }}" class="d-none">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="param">Параметр <span class="text-danger">*</span></label>
                        <select name="param" required id="param" class="form-control">
                            <option value="product_name">Название товара</option>
                            <option value="product_code">Артикул товара</option>
                            <option value="product_price">Цена товара</option>
                            <option value="product_amount">Наличие товара</option>
                            <option value="product_description">Описание товара</option>
                            <option value="product_photo_cover">Основное фото</option>
                            <option value="product_photos">Доп. фото</option>
                            <option value="brand">Бренд</option>
                            <option value="collection">Коллекция</option>
                            <option value="char">Характеристика</option>
                            <option value="dop">Доп.товар</option>
                            <option value="dop_block">Блок Доп.товара</option>
                            <option value="seo_title">SEO Title</option>
                            <option value="seo_description">SEO Description</option>
                            <option value="seo_breadcrumb">SEO Breadcrumb</option>
                        </select>
                    </div>
                    <div class="form-group" id="product_amount_default" style="display: none">
                        <label for="product_amount_default">Наличия товара по умолчанию</label>
                        <input type="number" name="default_amount" class="form-control">
                    </div>
                    <div class="form-group d-none" id="char_id_form">
                        <label for="char_id">Характеристика из категории</label>
                        <select name="char_id" id="char_id" class="form-control">
                            <option value="0">Выберите характеристику</option>
                            @if($excelFile->category)
                                @foreach($excelFile->category->chars()->get() as $char)
                                    <option value="{{ $char->id }}">{{ $char->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="column_key">Колонка <span class="text-danger">*</span></label>
                        <select name="column" id="column_key" required class="form-control">
                            @foreach($excelFile['columns'][0] as $column)
                                <option value="{{ $column }}">{{ $column }}</option>
                            @endforeach
                                <option value="0">Без колонки</option>
                        </select>
                    </div>
                    <div class="form-group char" style="display: none;">
                        <input type="checkbox" name="mm_to_cm" id="mmtocm" class="form-checkbox" >
                        <label for="mmtocm">мм в см</label>
                    </div>
                    <div class="form-group char" style="display: none;">
                        <input type="checkbox" name="change_value" id="changeValue"  class="form-checkbox" >
                        <label for="changeValue">Заменяемые значения</label>
                    </div>
                    <div class="form-group" id="newCharValueBlock" style="display: none;">
                        <input type="checkbox" name="skip_new_values" id="newCharValue"  class="form-checkbox" >
                        <label for="newCharValue">Пропускать не заданные значения</label>
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

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Импортировать</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.products.excelFiles.import') }}" method="POST" enctype="multipart/form-data"> @csrf
                    <input type="text" name="excel_file_id" value="{{ $excelFile->id }}" class="d-none">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Файл с товарами <span class="text-danger">*</span></label>
                        <input type="file" name="file"  id="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Импортировать</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                </div>
                </form>
            </div>
        </div>
    </div>


<!-- Modal -->
    <div class="modal fade" id="addNameModal" tabindex="-1" aria-labelledby="addNameModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNameModalLabel">Настройки формирования названия</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.products.excelFileNames.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                    <input type="text" name="excel_file_id" value="{{ $excelFile->id }}" class="d-none">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Тип параметра <span class="text-danger">*</span></label>
                        <select name="type" id="type" required class="form-control">
                            <option value="0">Произвольное поле</option>
                            @foreach($excelFile->params()?->get() as $param)
                                <option value="{{ $param->id }}">{{ $param->getParamName() }}{{  ($param->char_id != 0) ? ': '.$param->char?->name : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="text">
                        <label for="text">Текст</label>
                        <input type="text" name="text" class="form-control">
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

    <script>

        $('#type').on('change', function(){
           if($(this).val() == 0){
               $('#text').show();
           } else{
               $('#text').hide();
           }
        });

        let key = document.getElementById('param');
        let chars = document.querySelectorAll('.char');
        let product_amount_default = document.getElementById('product_amount_default');
        let char_id_form = document.getElementById('char_id_form');

        key.onchange = function (){
            if(this.value == 'char'){
                chars.forEach(function (char){
                    char.style.display = 'block';
                });
                char_id_form.classList.remove('d-none');
            }else{
                chars.forEach(function (char){
                    char.style.display = 'none';
                });
                char_id_form.classList.add('d-none');
            }

            if(this.value == 'product_amount'){
                product_amount_default.style.display = 'block';
            }else{
                product_amount_default.style.display = 'none';
            }
        }


        let changeValue = document.getElementById('changeValue');
        let newCharValueBlock = document.getElementById('newCharValueBlock');

        changeValue.onchange = function (){
            if(this.checked){
                newCharValueBlock.style.display = 'block';
            }else{
                newCharValueBlock.style.display = 'none';
            }
        }
    </script>
@endsection
