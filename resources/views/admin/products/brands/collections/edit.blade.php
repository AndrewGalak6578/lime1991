@extends('admin.layouts.app')
@section('page_title', 'Редактировать коллекцию')
@section('page_name', 'Редактировать коллекцию')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.brands.index') }}">Бренды</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.brands.edit', $brandCollection->brand_id) }}">{{ $brandCollection->brand->name }}</a></li>
    <li class="breadcrumb-item active">Коллекции</li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $brandCollection->name }}</li>
@endsection
@section('content')
    <form action="{{ route('admin.products.brandCollections.update', $brandCollection) }}" method="POST">@csrf @method('put')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 ">
                        <b class="text-primary">Основная информация</b>
                        <hr class="border-primary">
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="name">Название коллекции <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $brandCollection->name }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="brand_id">Бренд <span class="text-danger">*</span></label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                @foreach($brands as $brand)
                                    <option @selected($brandCollection->brand_id == $brand->id) value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-2 ">
                        <b class="text-primary">SEO</b>
                        <hr class="border-primary">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="seo_title">Title <small>(Заголовок страницы)</small></label>
                            <input type="text" name="seo_title" id="seo_title" value="{{ $brandCollection->seo_title }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="seo_description">Meta Description <small>(Мета описание страницы)</small></label>
                            <input type="text" name="seo_description" id="seo_description" value="{{ $brandCollection->seo_description }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="breadcrumb_name">Хлебные крошки</label>
                            <input type="text" name="breadcrumb_name" id="breadcrumb_name" value="{{ $brandCollection->breadcrumb_name }}" class="form-control">
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

@endsection
