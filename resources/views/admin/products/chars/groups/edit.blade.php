@extends('admin.layouts.app')
@section('page_title', 'Редактировать группу характеристик')
@section('page_name', 'Редактировать группу характеристик')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.chars.index') }}">Характеристики</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.charGroups.index') }}">Группы характеристик</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $charGroup->name }}</li>
@endsection
@section('content')
    <form action="{{ route('admin.products.charGroups.update', $charGroup) }}" method="POST"> @csrf @method('put')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Название группы <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $charGroup->name }}" required class="form-control">
                        </div>
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
