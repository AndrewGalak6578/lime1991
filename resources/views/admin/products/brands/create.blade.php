@extends('admin.layouts.app')
@section('page_title', 'Добавить бренд')
@section('page_name', 'Добавить бренд')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.brands.index') }}">Бренды</a></li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <form action="{{ route('admin.products.brands.store') }}" method="POST">@csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 ">
                        <b class="text-primary">Основная информация</b>
                        <hr class="border-primary">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Название бренда <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="logo">Логотип</label>
                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseIcon">Выберите логотип</button>
                            <input type="text" class="form-control d-none" id="chooseIcon_input" name="logo">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="cover">Обложка</label>
                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseCover">Выберите обложку</button>
                            <input type="text" class="form-control d-none" id="chooseCover_input" name="cover">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description_3">Краткое описание</label>
                            <textarea name="description_3" id="description_3" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-12 mt-2 ">
                        <b class="text-primary">SEO</b>
                        <hr class="border-primary">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="seo_title">Title <small>(Заголовок страницы)</small></label>
                            <input type="text" name="seo_title" id="seo_title" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="seo_description">Meta Description <small>(Мета описание страницы)</small></label>
                            <input type="text" name="seo_description" id="seo_description" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="breadcrumb_name">Хлебные крошки</label>
                            <input type="text" name="breadcrumb_name" id="breadcrumb_name" class="form-control">
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
