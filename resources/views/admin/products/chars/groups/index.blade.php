@extends('admin.layouts.app')
@section('page_title', 'Группы характеристик')
@section('page_name', 'Группы характеристик')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.chars.index') }}">Характеристики</a></li>
    <li class="breadcrumb-item active">Группы характеристик</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.products.charGroups.create') }}" class="btn btn-primary">Добавить группу</a>
        </div>
        <div class="card-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Количество характеристик</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($charGroups as $charGroup)
                        <tr>
                            <td>{{ $charGroup->name }}</td>
                            <td>{{ $charGroup->chars()->count() }}</td>
                            <td>
                                <a href="{{ route('admin.products.charGroups.edit', $charGroup) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <button onclick="destroy('#delete-charGroup-', '{{ $charGroup->id }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.products.charGroups.destroy', $charGroup) }}" method="POST" id="delete-charGroup-{{ $charGroup->id }}">@csrf @method('delete')</form>
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
