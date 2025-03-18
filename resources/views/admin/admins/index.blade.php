@extends('admin.layouts.app')
@section('page_title', 'Администраторы')
@section('page_name', 'Администраторы')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Администраторы</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">Добавить администратора</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('footer')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
