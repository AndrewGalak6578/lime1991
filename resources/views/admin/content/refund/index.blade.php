@extends('admin.layouts.app')
@section('page_title', 'Страница возврата')
@section('page_name', 'Страница возврата')
@section('header')
@endsection
@section('breadcrumbs')
	<li class="breadcrumb-item active">Страница возврата</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="mb-0">Редактирование страницы возврата</h4>
		</div>
		<div class="card-body">
		
		<form method="POST" action={{ route('admin.content.refund.store') }}>
			@csrf
			<div class="row">
				<div class="form-group col-12">
					<textarea id="textareaEditor" name="content">{{ $page->html }}</textarea>
				</div>
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
