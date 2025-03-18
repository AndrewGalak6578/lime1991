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
		@if (count($list[0]) > 0)
			<div class="card">
				<div class="card-header">
					<h4 class="mb-0">Импортированные сопутсвующие товары</h4>
				</div>
				<div class="card-body">
					<ul>
						@foreach ($list[0] as $el)
							<li>
								<p>Товар: {{ $el[0] }}</p>
								@if (count($el[1]) > 0)
									<p>Добавлены: {{ implode(', ', $el[1]) }}</p>
								@endif
								@if (count($el[2]) > 0)
									<p>Пропущены (не найдены): {{ implode(', ', $el[2]) }}</p>
								@endif
							</li>
							<hr>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
		@if (count($list[1]) > 0)
			<div class="card">
				<div class="card-header">
					<h4 class="mb-0">Не импортированные сопутсвующие товары (Не найдены)</h4>
				</div>
				<div class="card-body">
					<p>{{ implode(', ', $list[1]) }}</p>
				</div>
			</div>
		@endif
@endsection
@section('footer')

@endsection
