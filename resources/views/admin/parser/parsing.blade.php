@extends('admin.layouts.app')
@section('page_title', 'Парсинг')
@section('page_name', 'Парсинг')
@section('header')
@endsection
@section('breadcrumbs')
  <li class="breadcrumb-item">Парсер</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4>Парсим данные с сайта cs-online...</h4>
      <a href="{{ route('admin.parser.cencel') }}" class="btn btn-danger">Остановить парсинг</a>
		</div>
		<iframe src="/admin/parser/parsingProgress" height="300"></iframe>
	</div>
@endsection
@section('footer')
@endsection
