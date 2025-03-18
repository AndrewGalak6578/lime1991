@extends('admin.layouts.app')
@section('page_title', 'Import files')
@section('page_name', 'Import files')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">ExcelFiles</a></li>
    <li class="breadcrumb-item active">Import</li>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button data-toggle="modal" data-target="#addExcelFile" class="btn btn-primary">Добавить</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($excelFiles as $excelFile)
                            <tr>
                                <td>{{ $excelFile->name }}</td>
                                <td>{{ $excelFile->category?->name }}</td>
                                <td>
                                    <a href="{{ route('admin.products.excelFiles.edit', $excelFile) }}" class="btn btn-warning">Редактировать</a>
                                    <button onclick="destroy('#delete-fileName-', '{{ $excelFile->id }}')" class="btn btn-danger">Удалить</button>
                                    <form action="{{ route('admin.products.excelFiles.destroy', $excelFile) }}" method="POST" id="delete-fileName-{{ $excelFile->id }}">@csrf @method('delete')</form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
@section('footer')

    <div class="modal fade" id="addExcelFile" tabindex="-1" aria-labelledby="addExcelFileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExcelFileLabel">Добавить Excel File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.products.excelFiles.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Название <span class="text-danger">*</span></label>
                        <input type="text" name="name" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="type">Тип <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control">
                            <option value="xlsx">XLSX</option>
                            <option value="csv">CSV</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Категория товаров</label>
                        <select name="category_id" id="category_id" class="form-control">
                            {!! printCategories($product_categories) !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">File <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="page">Номер листа <span class="text-danger">*</span></label>
                        <input type="number" min="1" step="1" value="1" name="page" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection
