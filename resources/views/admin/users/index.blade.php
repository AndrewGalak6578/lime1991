@extends('admin.layouts.app')
@section('page_title', 'Пользователи')
@section('page_name', 'Пользователи')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Пользователи</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Добавить пользователя</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('footer')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
