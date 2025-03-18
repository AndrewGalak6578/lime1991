@extends('admin.layouts.app')
@section('page_title', 'Редактировать бренд')
@section('page_name', 'Редактировать бренд')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.brands.index') }}">Бренды</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $brand->name }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-block">
            <a href="{{ route('admin.products.brandCollections.create', ['brand_id'=>$brand->id]) }}" class="btn btn-primary">Добавить коллекцию</a>
        </div>
        <div class="card-body">


            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-toggle="tab" data-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Основная информация</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="collections-tab" data-toggle="tab" data-target="#collections" type="button" role="tab" aria-controls="collections" aria-selected="false">Коллекции</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-toggle="tab" data-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Отзывы</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <form action="{{ route('admin.products.brands.update', $brand) }}" method="POST">@csrf @method('put')

                                <div class="row">
                                    <div class="col-12 ">
                                        <b class="text-primary">Основная информация</b>
                                        <hr class="border-primary">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Название бренда <span class="text-danger">*</span></label>
                                            <input type="text" name="name" required value="{{ $brand->name }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">URL <span class="text-danger">*</span></label>
                                            <input type="text" required name="slug" value="{{ $brand->slug }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="logo">Логотип</label>
                                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseIcon">Выберите логотип</button>
                                            <input type="text" class="form-control @if($brand->logo == null) d-none @endif" value="{{ $brand->logo }}" id="chooseIcon_input" name="logo">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="cover">Обложка</label>
                                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseCover">Выберите обложку</button>
                                            <input type="text" class="form-control @if($brand->cover == null) d-none @endif" value="{{ $brand->cover}}" id="chooseCover_input" name="cover">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description_3">Краткое описание</label>
                                            <textarea name="description_3" id="description_3" class="form-control" cols="30" rows="5">{{ $brand->description_3 }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 ">
                                        <b class="text-primary">SEO</b>
                                        <hr class="border-primary">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="seo_title">Title <small>(Заголовок страницы)</small></label>
                                            <input type="text" name="seo_title" id="seo_title" value="{{ $brand->seo_title }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="seo_description">Meta Description <small>(Мета описание страницы)</small></label>
                                            <input type="text" name="seo_description" id="seo_description" value="{{ $brand->seo_description }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="breadcrumb_name">Хлебные крошки</label>
                                            <input type="text" name="breadcrumb_name" id="breadcrumb_name" value="{{ $brand->breadcrumb_name }}" class="form-control">
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
                <div class="tab-pane fade" id="collections" role="tabpanel" aria-labelledby="collections-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Название коллекции</th>
                                <th>Кол.товаров</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brand->collections()->get() as $brandCollection)
                                <tr>
                                    <td>{{ $brandCollection->name }}</td>
                                    <td>{{$brandCollection->products->count()}}</td>
                                    <td>@include('admin.products.brands.collections.actions', $brandCollection)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">...</div>
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
