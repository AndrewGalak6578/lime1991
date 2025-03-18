@extends('admin.layouts.app')
@section('page_title', 'Группы ключей')
@section('page_name', 'Группы ключей')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Настройки</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.settings.keys.values') }}">Ключи и значения</a></li>
    <li class="breadcrumb-item active">Группы ключей</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.settings.keyGroups.create') }}" class="btn btn-primary">Добавить группу ключей</a>
        </div>
        <div class="card-body">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Количество ключей</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keyGroups as $keyGroup)
                        <tr>
                            <td>{{ $keyGroup->name }}</td>
                            <td>{{ $keyGroup->keys()->count() }}</td>
                            <td>
                                <a href="{{ route('admin.settings.keyGroups.edit', $keyGroup) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                                <button onclick="destroy('#delete-keyGroup-', '{{ $keyGroup->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.settings.keyGroups.destroy', $keyGroup) }}" method="POST" id="delete-keyGroup-{{ $keyGroup->id }}">@csrf @method('delete')</form>
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
