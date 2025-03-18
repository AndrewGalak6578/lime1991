@extends('admin.layouts.app')
@section('page_title', 'Export')
@section('page_name', 'Export')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item active">Export</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Модуль</th>
                        <th>Export</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Категории</td>
                        <td>
                            <a href="{{ route('admin.products.export.categories') }}" download class="btn btn-primary">Export</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Теги</td>
                        <td>
                            <a href="{{ route('admin.products.export.tags') }}" download class="btn btn-primary">Export</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Бренды</td>
                        <td>
                            <a href="{{ route('admin.products.export.brands') }}" download class="btn btn-primary">Export</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Коллекции</td>
                        <td>
                            <a href="{{ route('admin.products.export.collections') }}" download class="btn btn-primary">Export</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Товары</td>
                        <td>
                            <a href="{{ route('admin.products.export.products') }}" download class="btn btn-primary">Export</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')

@endsection
