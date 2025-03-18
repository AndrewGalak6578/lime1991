@extends('admin.layouts.app')
@section('page_title', 'Редактировать значение')
@section('page_name', 'Редактировать значение')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.chars.index') }}">Характеристики</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.chars.index', ['category_id'=>$char->category_id]) }}">{{ $char->category->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.chars.edit', $char) }}">Значения</a></li>
    <li class="breadcrumb-item">Редактировать</li>
    <li class="breadcrumb-item active">{{ $charValue->value }}</li>
@endsection
@section('content')
    <form action="{{ route('admin.products.charValues.update', $charValue) }}" method="POST">@csrf @method('put')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="value">Значение <span class="text-danger">*</span></label>
                            <input type="text" name="value" value="{{ $charValue->value }}" class="form-control">
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
