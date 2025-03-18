@extends('admin.layouts.app')
@section('page_title', 'Страница контактов')
@section('page_name', 'Страница контактов')
@section('header')
@endsection
@section('breadcrumbs')
	<li class="breadcrumb-item active">Страница контактов</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="mb-0">Редактирование страницы контактов</h4>
		</div>
		<div class="card-body">
		
		<form method="POST" action={{ route('admin.content.contacts.store') }}>
			@csrf
			<div class="row">
				<div class="form-group col-12 mb-20">
					<textarea id="textareaEditor" name="content">{{ $page->html }}</textarea>
				</div>
			</div>
			<div class="row">
				<h4 class="mb-10 col-12">Редактирование карты</h4>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="price">Широта</label>
						<input type="text" name="latitude" value="0" class="form-control">
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<label for="price">Долгота</label>
						<input type="text" name="longitude" value="0" class="form-control">
					</div>
				</div>
				<div class="col-12 map-container" id="contacts-map" data-coords="{{ (isset($page->values['coordinates']) ? implode(',', $page->values['coordinates']) : '0,0') }}"></div>
				<div class="form-group col-12">
					<button class="btn btn-primary">Сохранить</button>
				</div>
			</div>
		</form>

		</div>
	</div>
@endsection
@section('footer')
	<script>
		tinymce.init({
			...tinyMCEConfig,
			placeholder: 'Текст для страницы...',
			selector: '#textareaEditor',
		});
	</script>
@endsection
