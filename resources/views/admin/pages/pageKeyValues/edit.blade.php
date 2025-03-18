@extends('admin.layouts.app')
@section('page_title', 'Редактировать ключ/значение к странице')
@section('page_name', 'Редактировать ключ/значение к странице')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.edit', $page) }}">{{ $page->name }}</a></li>
    <li class="breadcrumb-item active">Ключи и значения</li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $pageKeyValue->id }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pages.pageKeyValues.update', $pageKeyValue) }}" method="POST"> @csrf @method('put')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $pageKeyValue->name }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="key">Ключ <span class="text-danger">*</span></label>
                            <input type="text" name="key" required value="{{ $pageKeyValue->key }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="type">Тип <span class="text-danger">*</span></label>
                            <select name="type" disabled id="type" class="form-control">
                                <option @selected($pageKeyValue->type == 0) value="0">Текстовое поле</option>
                                <option @selected($pageKeyValue->type == 1) value="1">Большое текстовое поле</option>
                                <option @selected($pageKeyValue->type == 2) value="2">Редактор</option>
                                <option @selected($pageKeyValue->type == 3) value="3">Фото</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="value">Значение</label>
                            @if($pageKeyValue->type == 0)
                            <input value="{{ $pageKeyValue->value }}" type="text" name="value" id="value_input" class="form-control">
                            @elseif($pageKeyValue->type == 1)
                            <textarea name="value" id="value_textarea" cols="30" rows="5" class="form-control">{{ $pageKeyValue->value }}</textarea>
                            @elseif($pageKeyValue->type == 2)
                                <div id="value_editor" class="">
                                <textarea name="value"  cols="30" rows="10" class="editor">{{ $pageKeyValue->value }}</textarea>
                            </div>
                            @elseif($pageKeyValue->type == 3)
                            <button class="btn btn-outline-secondary btn-block mb-2"  type="button" id="chooseIcon">Выберите фото</button>
                            <input type="text" value="{{ $pageKeyValue->value }}" class="form-control" id="chooseIcon_input" name="value">
                        @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="value2">Значение 2 <small>(текст, ссылка, подпись и тд)</small></label>
                            <textarea name="value2" id="value2" cols="30" rows="5" class="form-control">{{ $pageKeyValue->value2 }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script>


        $('body').on('change', '#type', function(){
            if($(this).val() == 0){
                $('#value_input').removeClass('d-none');
                $('#value_textarea').addClass('d-none');
                $('#value_editor').addClass('d-none');
                $('#chooseIcon').addClass('d-none');
            }else if($(this).val() == 1){
                $('#value_input').addClass('d-none');
                $('#value_textarea').removeClass('d-none');
                $('#value_editor').addClass('d-none');
                $('#chooseIcon').addClass('d-none');
            }else if($(this).val() == 2){
                $('#value_input').addClass('d-none');
                $('#value_textarea').addClass('d-none');
                $('#value_editor').removeClass('d-none');
                $('#chooseIcon').addClass('d-none');
            }else if($(this).val() == 3){
                $('#value_input').addClass('d-none');
                $('#value_textarea').addClass('d-none');
                $('#value_editor').addClass('d-none');
                $('#chooseIcon').removeClass('d-none');
            }
        });

        fileManager('chooseIcon', 'file', {prefix: '/admin/laravel-filemanager'}, 'chooseIcon_input');
    </script>
@endsection
