@extends('admin.layouts.app')
@section('page_title', 'Заявки на обратный звонок')
@section('page_name', 'Заявки на обратный звонок')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Заявки на обратный звонок</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.callmes.create') }}" class="btn btn-primary">Добавить заявку</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('footer')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
