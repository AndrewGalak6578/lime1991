@extends('admin.layouts.app')
@section('page_title', 'Теги')
@section('page_name', 'Теги')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Теги</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.products.productTags.create') }}" class="btn btn-primary">Добавить тег</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('footer')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
