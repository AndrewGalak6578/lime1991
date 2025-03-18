@extends('admin.layouts.app')
@section('page_title', 'Все коллекции брендов')
@section('page_name', 'Все коллекции брендов')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.brands.index') }}">Бренды</a></li>
    <li class="breadcrumb-item active">Все коллекции</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.products.brandCollections.create') }}" class="btn btn-primary">Добавить коллекцию</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('footer')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
