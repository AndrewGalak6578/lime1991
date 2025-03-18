@extends('admin.layouts.app')
@section('page_title', 'Создание статьи')
@section('page_name', 'Создание статьи')
@section('header')
@endsection
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{ route('admin.blog') }}">Блог</a></li>
	<li class="breadcrumb-item active">Создание статьи</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="mb-0">Создание статьи</h4>
		</div>
		<div class="card-body">
		
		<form method="POST" action={{ route('admin.blog.store') }}>
			@csrf
			<div class="row">
				<h4 class="mb-10 col-12">Новая статья</h4>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<label for="name">Название</label>
						<input type="text" name="name" value="" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-12 mb-20">
					<textarea id="textareaEditor" name="content"></textarea>
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
			placeholder: 'Текст для статьи...',
			selector: '#textareaEditor',
		});
	</script>
@endsection
