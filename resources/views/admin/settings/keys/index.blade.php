@extends('admin.layouts.app')
@section('page_title', 'Ключи и значения')
@section('page_name', 'Ключи и значения')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Ключи и значения</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-block">
            <a href="{{ route('admin.settings.keyGroups.create') }}" class="btn btn-primary">Добавить группу ключей</a>
            <a href="{{ route('admin.settings.keys.create') }}" class="btn btn-primary">Добавить ключ</a>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="keyGroup" role="tablist">
                @foreach($keyGroups as $i => $keyGroup)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($loop->first) active @endif" id="group-{{ $keyGroup->id }}-tab" data-toggle="tab" data-target="#group-{{ $keyGroup->id }}" type="button" role="tab" aria-controls="group-{{ $keyGroup->id }}" aria-selected="true">{{ $keyGroup->name }}</button>
                </li>
                @endforeach
            </ul>
            <div class="tab-content" id="keyGroupContent">
                @foreach($keyGroups as $i => $keyGroup)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="group-{{ $keyGroup->id }}" role="tabpanel" aria-labelledby="group-{{ $keyGroup->id }}-tab">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Ключ</th>
                            <th>Значение</th>
                            <th>Значение 2</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($keyGroup->keys()->get() as $key)
                            <tr>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->key }}</td>
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
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
