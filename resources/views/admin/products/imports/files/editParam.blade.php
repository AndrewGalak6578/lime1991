@extends('admin.layouts.app')
@section('page_title', 'Редактирование параметра')
@section('page_name', 'Редактирование параметра')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}"> Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.excelFiles.index') }}"> Импорт товаров</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.excelFiles.edit', $excelFileParam->excelFile) }}"> {{ $excelFileParam->excelFile->name }}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.products.excelFiles.edit', $excelFileParam->excel_file_id) }}">{{ $excelFileParam->getParamName() }}</a></li>
@endsection
@section('content')
    <div class="card">

        @if($excelFileParam->change_value)
        <div class="card-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCharModal">Добавить</button>
        </div>
        @endif

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Основная информация</button>
                </li>
                @if($excelFileParam->change_value)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Значение</button>
                </li>
                @endif
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{ route('admin.products.excelFileParams.update', $excelFileParam) }}" method="POST"> @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="param">Параметр <span class="text-danger">*</span></label>
                                <select  name="param" required id="param" class="form-control">
                                    <option value="product_name" @selected($excelFileParam->param == 'product_name' )>Название товара</option>
                                    <option value="product_code" @selected($excelFileParam->param == 'product_code')>Артикул товара</option>
                                    <option value="product_price" @selected($excelFileParam->param == 'product_price')>Цена товара</option>
                                    <option value="product_amount" @selected($excelFileParam->param == 'product_amount')>Наличие товара</option>
                                    <option value="product_description" @selected($excelFileParam->param == 'product_description')>Описание товара</option>
                                    <option value="product_photo_cover" @selected($excelFileParam->param == 'product_photo_cover')>Основное фото</option>
                                    <option value="product_photos" @selected($excelFileParam->param == 'product_photos')>Доп. фото</option>
                                    <option value="brand" @selected($excelFileParam->param == 'brand')>Бренд</option>
                                    <option value="collection" @selected($excelFileParam->param  == 'collection')>Коллекция</option>
                                    <option value="char" @selected($excelFileParam->param == 'char')>Характеристика</option>
                                    <option value="dop" @selected($excelFileParam->param == 'dop')>Доп.товар</option>
                                    <option value="dop_block" @selected($excelFileParam->param == 'dop_block')>Блок Доп.товара</option>
                                    <option value="seo_title" @selected($excelFileParam->param == 'seo_title')>SEO Title</option>
                                    <option value="seo_description" @selected($excelFileParam->param == 'seo_description')>SEO Description</option>
                                    <option value="seo_breadcrumb" @selected($excelFileParam->param == 'seo_breadcrumb')>SEO Breadcrumb</option>
                                </select>
                            </div>

                            <div class="form-group" id="product_amount_default" @if($excelFileParam->param != 'product_amount') style="display: none" @endif>
                                <label for="product_amount_default">Наличия товара по умолчанию</label>
                                <input type="number" name="default_amount" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="column_key">Колонка <span class="text-danger">*</span></label>
                                <input type="text" name="column" value="{{ $excelFileParam->column }}" class="form-control">
                            </div>
{{--                            <div class="form-group" id="char_id_form">--}}
{{--                                <label for="char_id">Характеристика из категории</label>--}}
{{--                                <select name="char_id" id="char_id" class="form-control">--}}
{{--                                    @foreach($excelFileParam->excelFile->category->chars()->get() as $char)--}}
{{--                                        <option @selected($char->id == $excelFileParam->char_id) value="{{ $char->id }}">{{ $char->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            @if($excelFileParam->param == 'char')
                            <div class="form-group" id="char_id_form">
                                <label for="char_id">Характеристика из категории</label>
                                <select name="char_id" id="char_id" class="form-control">
                                    @foreach($excelFileParam->excelFile->category->chars()->get() as $char)
                                        <option @selected($char->id == $excelFileParam->char_id) value="{{ $char->id }}">{{ $char->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group char" >
                                <input type="checkbox" name="mm_to_cm" @checked(old('mm_to_cm', $excelFileParam->mm_to_cm)) id="mmtocm" class="form-checkbox" >
                                <label for="mmtocm">мм в см</label>
                            </div>
                            <div class="form-group char" >
                                <input type="checkbox" name="change_value" id="changeValue" @checked(old('change_value', $excelFileParam->change_value))  class="form-checkbox" >
                                <label for="changeValue">Заменяемые значения</label>
                            </div>
                            <div class="form-group" id="newCharValueBlock" >
                                <input type="checkbox" name="skip_new_values" @checked(old('skip_new_values', $excelFileParam->skip_new_values)) id="newCharValue"  class="form-checkbox" >
                                <label for="newCharValue">Пропускать не заданные значения</label>
                            </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </form>
                </div>
                @if($excelFileParam->change_value)
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Значение характеристики</th>
                            <th scope="col">Текст под замену в EXCEL</th>
                            <th scope="col">Действии</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($excelFileParam->charSettings()->get() as $excelFileParamsSetting)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$excelFileParamsSetting->charValue->value}}</td>
                            <td>{{$excelFileParamsSetting->excel_name}}</td>
                            <td>
                                <a class="btn btn-warning btn-xs sharp" data-toggle="modal" data-target="#edetCharModal_{{$excelFileParamsSetting->id}}"><i class="fa fa-edit"></i></a>

                                <div class="modal fade" id="edetCharModal_{{$excelFileParamsSetting->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Редактирование</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('admin.products.excelFileParamsSettings.update', $excelFileParamsSetting)}}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="">Значение характеристики</label>
                                                        <select name="char_value_id" class="form-control">
                                                            @foreach($excelFileParam->char->values()->get() as $value)
                                                                <option @selected($excelFileParamsSetting->char_value_id == $value->id) value="{{$value->id}}">{{$value->value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="">Текст под замену в EXCEL</label>
                                                        <input name="excel_name" class="form-control" value="{{$excelFileParamsSetting->excel_name}}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <button onclick="destroy('#delete-brand-', '{{ $excelFileParamsSetting->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.products.excelFileParamsSettings.destroy', $excelFileParamsSetting) }}" method="POST" id="delete-brand-{{ $excelFileParamsSetting->id }}">@csrf @method('delete')</form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('footer')

    <script>
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

    @if($excelFileParam->change_value)
    <div class="modal fade" id="addCharModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.products.excelFileParamsSettings.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="excel_file_param_id" value="{{$excelFileParam->id}}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Значение характеристики ({{ $excelFileParam->char->name }})</label>

                            <select name="char_value_id" class="form-control">
                                @foreach($excelFileParam->char->values()->get() as $value)
                                    <option value="{{$value->id}}">{{$value->value}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="">Текст под замену в EXCEL</label>
                            <input name="excel_name" class="form-control" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endif
    @endsection
