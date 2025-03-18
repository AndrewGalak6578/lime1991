@extends('admin.layouts.app')
@section('page_title', 'Добавить категорию')
@section('page_name', 'Добавить категорию')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.productCategories.index') }}">Категории</a></li>
    <li class="breadcrumb-item active">Добавить категорию</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.productCategories.store') }}" method="POST">@csrf
                <div class="row">
                    <div class="col-12 ">
                        <b class="text-primary">Основная информация</b>
                        <hr class="border-primary">
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="form-group">
                            <label for="name">Название категории <span class="text-danger">*</span></label>
                            <input type="text" name="name" required id="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="parent_id">Родительская категория <span class="text-danger">*</span></label>
                            <select name="parent_id" id="parent_id" required class="form-control">
                                <option value="0">Без родительской категории</option>
                                {!! printCategories($productCategories) !!}
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="icon">Логотип</label>
                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseIcon">Выберите иконку</button>
                            <input type="text" class="form-control d-none" id="chooseIcon_input" name="icon">
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
                            <label for="description">Описание</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="editor"></textarea>
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
            </form>
        </div>
    </div>


@endsection
@section('footer')
    <script>
        fileManager('chooseIcon', 'file', {prefix: '/admin/laravel-filemanager'}, 'chooseIcon_input');
        fileManager('chooseCover', 'file', {prefix: '/admin/laravel-filemanager'}, 'chooseCover_input');
    </script>
@endsection
