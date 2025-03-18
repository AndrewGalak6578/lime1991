
@extends('admin.layouts.app')
@section('page_title', 'Настройка импорта')
@section('page_name', 'Настройка импорта')
@section('header')

@endsection
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
	<li class="breadcrumb-item"><a href="{{ route('admin.products.import') }}">Импорт</a></li>
	<li class="breadcrumb-item"><a href="{{ route('admin.products.import.upload') }}">Выбор категории</a></li>
	<li class="breadcrumb-item active">Настройка импорта</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="mb-0">Настройка импорта</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.products.import.importing') }}" class="d-flex" method="POST" enctype="multipart/form-data"> @csrf
				<input hidden name="file_id" value="{{ $file_id }}">
				<input hidden name="category" value="{{ $category }}">
				<div class="row">
					<div class="form-group col-12">
						<hr>
						<p>Настройки <span class="text-danger">*</span></p>
						<p>Выберите соответстиве полей таблицы в соответстивии с их назначением.</p>
						<div class="row">

							<div class="form-group col-4">
								<label for="field_name">Название <span class="text-danger">*</span></label>
								<select name="field_name" class="form-control" required>
									<option value="" disabled selected>Нет соответстивя</option>
									@foreach ($chars as $key => $char)
										<option value="{{ $key }}">{{ $char }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-4">
								<label for="field_price">Цена <span class="text-danger">*</span></label>
								<select name="field_price" class="form-control" required>
									<option value="" disabled selected>Нет соответстивя</option>
									@foreach ($chars as $key => $char)
										<option value="{{ $key }}">{{ $char }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-4">
								<label for="field_desc">Описание</label>
								<select name="field_desc" class="form-control">
									<option value="" disabled selected>Нет соответстивя</option>
									@foreach ($chars as $key => $char)
										<option value="{{ $key }}">{{ $char }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-4">
								<label for="field_photo">Фото <span class="text-danger">*</span></label>
								<select name="field_photo" class="form-control" required>
									<option value="" disabled selected>Нет соответстивя</option>
									@foreach ($chars as $key => $char)
										<option value="{{ $key }}">{{ $char }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-4">
								<label for="field_article">Артикул <span class="text-danger">*</span></label>
								<select name="field_article" class="form-control" required>
									<option value="" disabled selected>Нет соответстивя</option>
									@foreach ($chars as $key => $char)
										<option value="{{ $key }}">{{ $char }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-4">
								<label for="field_brand">Бренд <span class="text-danger">*</span></label>
								<select name="field_brand" class="form-control" required>
									<option value="" disabled selected>Нет соответстивя</option>
									@foreach ($chars as $key => $char)
										<option value="{{ $key }}">{{ $char }}</option>
									@endforeach
								</select>
							</div>

						</div>
					</div>
					<div class="form-group col-12">
						<hr>
						<p>Характеристики <span class="text-danger">*</span></p>
						<p>Характеристикам, которые нужно добавить к товару, выберите существующую, что соответствует характеристике из файла или выберите "создать новую".</p>
						<div class="row">
							@foreach ($chars as $key => $char)
								<div class="form-group col-4">
									<label for="chars">{{ $char }}</label>
									<select name="{{ 'char:'.$key }}" class="form-control">
										<option value="" selected>Не добавлять</option>
										<option value="0">Создать новую</option>
										@foreach ($category_chars as $key => $c_char)
											<option value="{{ $c_char['id'] }}">{{ $c_char['name'] }}</option>
										@endforeach
									</select>
								</div>
							@endforeach
						</div>
					</div>
					<div class="col-12">
						<hr>
						<button class="btn btn-primary">Импортировать</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
@section('footer')

@endsection
