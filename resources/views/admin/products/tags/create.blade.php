@extends('admin.layouts.app')
@section('page_title', 'Добавить тег')
@section('page_name', 'Добавить тег')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Товары</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.products.productTags.index') }}">Теги</a></li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.productTags.store') }}" method="POST">@csrf
                <div class="row">
                    <div class="col-12 ">
                        <b class="text-primary">Основная информация</b>
                        <hr class="border-primary">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="product_category_id">Категория <span class="text-danger">*</span></label>
                            <select name="product_category_id" id="product_category_id" class="form-control">
                                <option value="0">Без категории</option>
                                @foreach($productCategories as $productCategory)
                                    <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 ">
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

@endsection
