@extends('admin.layouts.app')
@section('page_title', 'Редактировать слайд')
@section('page_name', 'Редактировать слайд')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.edit', 1) }}">Главная страница</a></li>
    <li class="breadcrumb-item active">Слайды</li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $homeSlide->id }}</li>
@endsection
@section('content')
    <form action="{{ route('admin.pages.homeSlides.update', $homeSlide) }}" method="POST"> @csrf @method('put')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="logo">Изображение для ПК (14:5 например: 2800x1000)</label>
                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseIcon">Выберите фото</button>
                            <input type="text" class="form-control" value="{{ $homeSlide->web_img }}" id="chooseIcon_input" name="web_img">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="cover">Изображение для моб. (9:6 например: 1500x1000)</label>
                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseCover">Выберите фото</button>
                            <input type="text" class="form-control" value="{{ $homeSlide->mobile_img }}" id="chooseCover_input" name="mobile_img">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="link">Ссылка</label>
                            <input type="text" name="link" value="{{ $homeSlide->link }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="alt">Alt</label>
                            <input type="text" name="alt" value="{{ $homeSlide->alt }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="position">Позиция</label>
                            <input type="text" name="position" value="{{ $homeSlide->position }}"  class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('footer')
    <script>
        fileManager('chooseIcon', 'file', {prefix: '/admin/laravel-filemanager'}, 'chooseIcon_input');
        fileManager('chooseCover', 'file', {prefix: '/admin/laravel-filemanager'}, 'chooseCover_input');
    </script>
@endsection







