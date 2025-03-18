@extends('admin.layouts.app')
@section('page_title', 'Категории')
@section('page_name', 'Категории')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Товары</a></li>
    <li class="breadcrumb-item active">Категории</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.products.productCategories.create') }}" class="btn btn-primary">Добавить категорию</a>
        </div>
        <div class="card-body">
{{--            {{ $dataTable->table() }}--}}
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    {!! printCategories($productCategories, 'table') !!}
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')
{{--    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}--}}
@endsection
