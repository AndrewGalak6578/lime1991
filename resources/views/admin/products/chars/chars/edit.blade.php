@extends('admin.layouts.app')
@section('page_title', 'Редактировать характеристику')
@section('page_name', 'Редактировать характеристику')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.products.chars.index') }}">Характеристики</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $char->name }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCharValue">Добавить значение</button>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="values-tab" data-toggle="tab" data-target="#values" type="button" role="tab" aria-controls="values" aria-selected="true">Значения</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="info-tab" data-toggle="tab" data-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">Основная информация</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="values" role="tabpanel" aria-labelledby="values-tab">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Значение</th>
                                <th>Кол.товаров</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($char->values()->get() as $value)
                                <tr>
                                    <td>{{ $value->value }}</td>
                                    <td>-</td>
                                    <td>
                                        <a href="{{ route('admin.products.charValues.edit', $value) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <button onclick="destroy('#delete-charValue-', '{{ $value->id }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        <form action="{{ route('admin.products.charValues.destroy', $value->id) }}" method="POST" id="delete-charValue-{{ $value->id }}">@csrf @method('delete')</form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <form action="{{ route('admin.products.chars.update', $char) }}" method="POST">@csrf @method('put')
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">Название <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $char->name }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" required value="{{ $char->slug }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="category_id">Категория <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option @selected($char->category_id == 0) value="0">Без категории</option>
                                        {!! printCategories($categories, 'option', '', $char->category_id) !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="char_group_id">Группа характеристик <span class="text-danger">*</span></label>
                                    <select name="char_group_id" id="char_group_id" class="form-control">
                                        <option value="0">Без группы</option>
                                        @foreach($charGroups as $charGroup)
                                            <option @selected($char->char_group_id == $charGroup->id) value="{{ $charGroup->id }}">{{ $charGroup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="show_in_filter">Показывать в фильтре</label>
                                    <select name="show_in_filter" id="show_in_filter" class="form-control">
                                        <option @selected($char->show_in_filter == 1) value="1">Да</option>
                                        <option @selected($char->show_in_filter == 0) value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="show_in_filter">Ползунок</label>
                                    <select name="type" id="type" class="form-control">
                                        <option @selected($char->type == 1) value="1">Да</option>
                                        <option @selected($char->type == 0) value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-success">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <div class="modal fade" id="addCharValue" tabindex="-1" aria-labelledby="addCharValueLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCharValueLabel">Добавить значение</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.products.charValues.store') }}" method="POST"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="value">Значение</label>
                            <input type="text" name="value" class="form-control">
                        </div>
                        <input type="text" name="char_id" value="{{ $char->id }}" class="form-control d-none">
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
