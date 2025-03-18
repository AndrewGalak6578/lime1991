@extends('admin.layouts.app')
@section('page_title', 'Выбор категорий')
@section('page_name', 'Выбор категорий')
@section('header')

@endsection
@section('breadcrumbs')
  <li class="breadcrumb-item">Парсер</li>
	<li class="breadcrumb-item active">Выбор категорий</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4>Выбор категорий</h4>
      <a href="{{ route('admin.parser.cencel') }}" class="btn btn-danger">Отмена</a>
		</div>
    <div class="card-body">
			{{ $dataTable->table() }}
		</div>
	</div>
@endsection
@section('footer')
	{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
