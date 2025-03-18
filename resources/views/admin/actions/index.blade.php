@extends('admin.layouts.app')
@section('page_title', 'Акции')
@section('page_name', 'Акции')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Акции</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.actions.create') }}" class="btn btn-primary">Добавить</a>
        </div>
        <div class="card-body">
            <table class="table datatable">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Тип</th>
                    <th>Действителен до</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($actions as $action)
                    <tr>
                        <td>{{ $action->name }}</td>
                        <td>{{ $action->type }}</td>
                        <td>{{ $action->available_to }}</td>
                        <td>{{ $action->status }}</td>

                        <td>
                            <a href="{{ route('admin.actions.edit', $action) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                            <button onclick="destroy('#delete-action-', '{{ $action->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                            <form action="{{ route('admin.actions.destroy', $action) }}" method="POST" id="delete-action-{{ $action->id }}">@csrf @method('delete')</form>
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
