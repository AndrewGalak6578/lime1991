@extends('admin.layouts.app')
@section('page_title', 'Товары')
@section('page_name', 'Товары')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Товары</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.products.products.create') }}" class="btn btn-primary">Добавить товар</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('footer')
	{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
