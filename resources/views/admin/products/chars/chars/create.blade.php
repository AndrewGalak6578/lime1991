@extends('admin.layouts.app')
@section('page_title', 'Добавить характеристику')
@section('page_name', 'Добавить характеристику')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Товары</a></li>
    <li class="breadcrumb-item active"><a href="#">Характеристики</a></li>
    <li class="breadcrumb-item">Добавить</li>
@endsection
@section('content')
    <form action="{{ route('admin.products.chars.store') }}" method="POST">@csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="category_id">Категория <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="0">Без категории</option>
                                {!! printCategories($product_categories, 'option', '', request()->get('category_id')) !!}
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="char_group_id">Группа характеристик <span class="text-danger">*</span></label>
                            <select name="char_group_id" id="char_group_id" class="form-control">
                                <option value="0">Без группы</option>
                                @foreach($charGroups as $charGroup)
                                    <option value="{{ $charGroup->id }}">{{ $charGroup->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="show_in_filter">Показать в фильтре <span class="text-danger">*</span></label>
                            <select name="show_in_filter" id="show_in_filter" class="form-control">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="show_in_filter">Ползунок</label>
                            <select name="type" id="type" class="form-control">
                                <option value="0">Нет</option>
                                <option value="1">Да</option>
                            </select>
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

@endsection
