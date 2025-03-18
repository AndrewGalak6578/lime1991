@extends('admin.layouts.app')
@section('page_title', 'Выбор брендов')
@section('page_name', 'Выбор брендов')
@section('header')

@endsection
@section('breadcrumbs')
  <li class="breadcrumb-item">Парсер</li>
	<li class="breadcrumb-item active">Выбор брендов</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4>Выбор брендов</h4>
      <a href="{{ route('admin.parser.cencel') }}" class="btn btn-danger">Отмена</a>
		</div>
	</div>
@endsection
@section('footer')
@endsection
