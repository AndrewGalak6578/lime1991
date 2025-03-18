@extends('admin.layouts.app')
@section('page_title', 'Добавить слайд')
@section('page_name', 'Добавить слайд')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.edit', 1) }}">Главная страница</a></li>
    <li class="breadcrumb-item active">Слайды</li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <form action="{{ route('admin.pages.homeSlides.store') }}" method="POST"> @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="logo">Изображение для ПК (14:5 например: 2800x1000)</label>
                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseIcon">Выберите фото</button>
                            <input type="text" class="form-control d-none" id="chooseIcon_input" name="web_img">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="cover">Изображение для моб. (9:6 например: 1500x1000)</label>
                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseCover">Выберите фото</button>
                            <input type="text" class="form-control d-none" id="chooseCover_input" name="mobile_img">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="link">Ссылка</label>
                            <input type="text" name="link" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="alt">Alt</label>
                            <input type="text" name="alt" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="position">Позиция</label>
                            <input type="text" name="position" value="100" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Добавить</button>
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







