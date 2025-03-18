@extends('admin.layouts.app')
@section('page_title', 'Редактировать категорию')
@section('page_name', 'Редактировать категорию')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.productCategories.index') }}">Категории</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $productCategory->name }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Основная информация</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Подкатегории</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Характеристики</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{ route('admin.products.productCategories.update', $productCategory) }}" method="POST">@csrf @method('put')
                        <div class="row">
                            <div class="col-12 ">
                                <b class="text-primary">Основная информация</b>
                                <hr class="border-primary">
                            </div>
                            <div class="col-12 col-md-10">
                                <div class="form-group">
                                    <label for="name">Название категории <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $productCategory->name }}" required id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="parent_id">Родительская категория <span class="text-danger">*</span></label>
                                    <select name="parent_id" id="parent_id" required class="form-control">
                                        <option @selected($productCategory->parent_id == 0) value="0">Без родительской категории</option>
                                        {!! printCategories($productCategories, 'option', '', $productCategory->parent_id) !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="slug">URL <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $productCategory->slug }}" name="slug" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="icon">Иконка</label>
                                    <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseIcon">Выберите иконку</button>
                                    <input type="text" value="{{ $productCategory->icon }}" class="form-control @if($productCategory->icon == null) d-none @endif" id="chooseIcon_input" name="icon">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cover">Обложка</label>
                                    <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseCover">Выберите обложку</button>
                                    <input type="text" value="{{ $productCategory->cover }}" class="form-control  @if($productCategory->cover == null) d-none @endif" id="chooseCover_input" name="cover">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="editor"  >{{ $productCategory->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2 ">
                                <b class="text-primary">SEO</b>
                                <hr class="border-primary">
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="seo_title">Title <small>(Заголовок страницы)</small></label>
                                    <input type="text" name="seo_title" id="seo_title"  value="{{ $productCategory->seo_title }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="seo_description">Meta Description <small>(Мета описание страницы)</small></label>
                                    <input type="text" name="seo_description" id="seo_description"  value="{{ $productCategory->seo_description }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="breadcrumb_name">Хлебные крошки</label>
                                    <input type="text" name="breadcrumb_name" id="breadcrumb_name" value="{{ $productCategory->breadcrumb_name }}" class="form-control">
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
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table" id="datatable">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        {!! printCategories($productCategory->subProductCategories()->get(), 'table') !!}
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <table class="table" id="datatable">
                                        <thead>
                                        <tr>
                                            <th>Характеристика</th>
                                            <th>Кол.значений</th>
                                            <th>Тип</th>
                                            <th>Группа</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($productCategory->chars()->get() as $char)
                                                <tr>
                                                    <td>{{ $char->name }}</td>
                                                    <td>{{ $char->values()->count() }}</td>
                                                    <td>{{ ($char->category_id == 0) ? 'Общая' : $char->category->name }}</td>
                                                    <td>{{ ($char->char_group_id == 0) ? 'Без группы' : $char->group->name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.products.chars.edit', $char) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                        <button onclick="destroy('#delete-char-', '{{ $char->id }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        <form action="{{ route('admin.products.chars.destroy', $char) }}" method="POST" id="delete-char-{{ $char->id }}">@csrf @method('delete')</form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('footer')
    <script>
        fileManager('chooseIcon', 'file', {prefix: '/admin/laravel-filemanager'}, 'chooseIcon_input');
        fileManager('chooseCover', 'file', {prefix: '/admin/laravel-filemanager'}, 'chooseCover_input');
    </script>
@endsection
