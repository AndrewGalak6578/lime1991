@extends('admin.layouts.app')
@section('page_title', 'Характеристики')
@section('page_name', 'Характеристики')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Товары</a></li>
    <li class="breadcrumb-item active">Характеристики</li>

@endsection
@section('content')

        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <a href="{{ route('admin.products.chars.create') }}" class="btn btn-primary mr-1">Добавить характеристику</a>
                    <a href="{{ route('admin.products.charGroups.index') }}" class="btn btn-info">Группы характеристик</a>
                </div>
            </div>
            <div class="card-body">
                @if(!request()->has('category_id'))
                <table class="table" id="datatable">
                    <thead>
                    <tr>
                        <th>Категория</th>
                        <th>Кол.характеристик</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    {!! printCategories($productCategories, 'table-chars') !!}
                    </tbody>
                </table>
@else
                <table class="table" id="datatable">
                    <thead>
                    <tr>
                        <th>Характеристика</th>
                        <th>Кол.значений</th>
                        <th>Тип</th>
                        <th>Группа</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($chars as $char)
                            <tr>
                                <td>{{ $char->name }}</td>
                                <td>{{ $char->values()->count() }}</td>
                                <td>{{ ($char->category_id == 0) ? 'Общая' : $char->category->name }}</td>
                                <td>{{ ($char->char_group_id == 0) ? 'Без группы' : $char->group->name }}</td>
                                <td>
                                    <a href="{{ route('admin.products.chars.edit', $char) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <button onclick="destroy('#delete-char-', '{{ $char->id }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    <form action="{{ route('admin.products.chars.destroy', $char) }}" method="POST" id="delete-char-{{ $char->id }}">@csrf @method('delete')</form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

@endsection
@section('footer')

@endsection
