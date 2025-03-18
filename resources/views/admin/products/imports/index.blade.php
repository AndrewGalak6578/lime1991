@extends('admin.layouts.app')
@section('page_title', 'Импорт')
@section('page_name', 'Импорт')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item active">Импорт</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="mb-0">Импорт товаров из Excel файла</h4>
		</div>
		<div class="card-body">
			<!-- <p class="mb-10">Выбор категорий и прочего будет доступен на следующем шаге</h4> -->
			<form action="{{ route('admin.products.import.upload') }}" class="d-flex" method="POST" enctype="multipart/form-data"> @csrf
				<div class="row">
					<input type="checkbox" name="type" value="products" checked required hidden>
					<div class="form-group col-12">
						<input type="file" name="file" required class="form-control w-80 mr-2">
					</div>
					<div class="form-group col-12">
						<button class="btn btn-primary">Далее</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<h4 class="mb-0">Импорт сопутствующих товаров из Excel файла</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.products.import.upload') }}" class="d-flex" method="POST" enctype="multipart/form-data"> @csrf
				<div class="row">
					<input type="checkbox" name="type" value="chains" checked required hidden>
					<div class="form-group col-12">
						<input type="file" name="file" required class="form-control w-80 mr-2">
					</div>
					<div class="form-group col-12">
						<button class="btn btn-primary">Далее</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
@section('footer')

@endsection
