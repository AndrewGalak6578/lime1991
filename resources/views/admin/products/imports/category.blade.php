@extends('admin.layouts.app')
@section('page_title', 'Выбор категории')
@section('page_name', 'Выбоор категории')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
	<li class="breadcrumb-item"><a href="{{ route('admin.products.import') }}">Импорт</a></li>
    <li class="breadcrumb-item active">Выбор категории</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="mb-0">Выбор категории</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.products.import.category') }}" class="d-flex" method="POST" enctype="multipart/form-data"> @csrf
				<input hidden name="file_id" value="{{ $file_id }}">
				<div class="row">
					<div class="form-group col-12">
						<label for="category">Категория <span class="text-danger">*</span></label>
						<select name="category" required class="form-control">
							<option value="" disabled selected>Категория</option>
							@foreach ($categories as $category)
								<option disabled value="">{{ $category->name }}</option>
								@foreach ($category->subProductCategories as $subcategory)
									<option value="{{ $subcategory->id }}">&nbsp;&nbsp;{{ $subcategory->name }}</option>
								@endforeach
							@endforeach
						</select>
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
