@extends('admin.layouts.app')
@section('page_title', 'Блоки доп.товаров')
@section('page_name', 'Блоки доп.товаров')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item active">Доп.блоки</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.products.productBlocks.create') }}" class="btn btn btn-primary"><i class="fa fa-plus"></i> Добавить блок</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Товары</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productBlocks as $productBlock)
                        <tr>
                            <td>{{ $productBlock->name }}</td>
                            <td>{{ $productBlock->blockProducts()->count() }}</td>
                            <td>
                                <a href="{{ route('admin.products.productBlocks.edit', $productBlock) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                                <button onclick="destroy('#delete-block-', '{{ $productBlock->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.products.productBlocks.destroy', $productBlock) }}" method="POST" id="delete-block-{{ $productBlock->id }}">@csrf @method('delete')</form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')

@endsection
