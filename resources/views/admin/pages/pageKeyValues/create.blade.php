@extends('admin.layouts.app')
@section('page_title', 'Добавить ключ/значение к странице')
@section('page_name', 'Добавить ключ/значение к странице')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.pages.edit', $page) }}">{{ $page->name }}</a></li>
    <li class="breadcrumb-item active">Ключи и значения</li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pages.pageKeyValues.store') }}" method="POST"> @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <input type="text" value="{{ $page->id }}" name="page_id" class="d-none">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="type">Тип <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control">
                                <option value="0">Текстовое поле</option>
                                <option value="1">Большое текстовое поле</option>
                                <option value="2">Редактор</option>
                                <option value="3">Фото</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="value">Значение</label>
                            <input type="text" name="value_input" id="value_input" class="form-control">
                            <textarea name="value_textarea" id="value_textarea" cols="30" rows="5" class="form-control d-none"></textarea>
                            <div id="value_editor" class="d-none">
                                <textarea name="value_editor"  cols="30" rows="10" class="editor"></textarea>
                            </div>
                            <button class="btn btn-outline-secondary btn-block mb-2 d-none"  type="button" id="chooseIcon">Выберите фото</button>
                            <input type="text" class="form-control d-none" id="chooseIcon_input" name="value_image">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="value2">Значение 2 <small>(текст, ссылка, подпись и тд)</small></label>
                            <textarea name="value2" id="value2" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Добавить</button>
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
