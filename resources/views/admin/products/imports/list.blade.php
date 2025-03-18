@extends('admin.layouts.app')
@section('page_title', 'Импорт')
@section('page_name', 'Импорт')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item active">Импорт завершен</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="mb-0">Страницы импортированных товаров</h4>
		</div>
		<div class="card-body">
			<ul>
				@foreach ($list as $el)
					<li>
						<a href="{{ $el[0] }}">{{$el[1]}}</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection
@section('footer')

@endsection
