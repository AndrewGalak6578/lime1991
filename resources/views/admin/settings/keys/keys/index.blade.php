@extends('admin.layouts.app')
@section('page_title', 'Ключи')
@section('page_name', 'Ключи')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Настройки</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.settings.keys.values') }}">Ключи и значения</a></li>
    <li class="breadcrumb-item active">Ключи</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.settings.keys.create') }}" class="btn btn-primary">Добавить ключ</a>
        </div>
        <div class="card-body">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Ключ</th>
                        <th>Группа</th>
                        <th>Значение</th>
                        <th>Значение 2</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keys as $key)
                        <tr>
                            <td>{{ $key->name }}</td>
                            <td>{{ $key->key }}</td>
                            <td>{{ $key->group->name }}</td>
                            <td>{{ $key->value }}</td>
                            <td>{{ $key->value_2 }}</td>
                            <td>
                                <a href="{{ route('admin.settings.keys.edit', $key) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                                <button onclick="destroy('#delete-key-', '{{ $key->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.settings.keys.destroy', $key) }}" method="POST" id="delete-key-{{ $key->id }}">@csrf @method('delete')</form>
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
