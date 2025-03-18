@extends('admin.layouts.app')
@section('page_title', 'Бренды')
@section('page_name', 'Бренды')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Товары</a></li>
    <li class="breadcrumb-item active">Бренды</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.products.brands.create') }}" class="btn btn-primary">Добавить бренд</a>
            <a data-toggle="modal" data-target="#editBrandName" class="btn btn-primary">Перемещение товаров</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('footer')
    <div class="modal fade" id="editBrandName" tabindex="-1" aria-labelledby="addCharsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCharsLabel">Перемещение продуктов </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.products.brands.move')}}" method="POST"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="old_brand_id">Бранд <span class="text-danger">*</span></label>
                            <select name="old_brand_id" id="old_brand_id" class="form-control">
                                @foreach(\App\Models\Brand::all() as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Бранд назначения <span class="text-danger">*</span></label>
                            <select name="brand_id" id="category_id" class="form-control">
                                @foreach(\App\Models\Brand::all() as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="value">Значение <span class="text-danger">*</span></label>--}}
{{--                            <input type="text" name="value" required class="form-control">--}}
{{--                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
