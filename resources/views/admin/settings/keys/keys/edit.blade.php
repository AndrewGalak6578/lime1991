@extends('admin.layouts.app')
@section('page_title', 'Редактировать ключ')
@section('page_name', 'Редактировать ключ')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Настройки</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.settings.keys.values') }}">Ключи и значения</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.settings.keys.index') }}">Ключи</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $key->name }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.settings.keys.update', $key) }}" method="POST"> @csrf @method('put')
                <input type="text" class="d-none" value="{{ $key->id }}" name="key_id">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $key->name }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="key">Ключ <span class="text-danger">*</span></label>
                            <input type="text" name="key" value="{{ $key->key }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="key_group_id">Группа <span class="text-danger">*</span></label>
                            <select name="key_group_id" id="key_group_id" class="form-control">
                                @foreach($keyGroups as $keyGroup)
                                    <option @selected($keyGroup->id == $key->key_group_id) value="{{ $keyGroup->id }}">{{ $keyGroup->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="value">Значение</label>
                            <textarea name="value" id="value" cols="30" rows="5" class="form-control">{{ $key->value }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="value_2">Значение 2</label>
                            <textarea name="value_2" id="value_2" cols="30" rows="5" class="form-control">{{ $key->value_2 }}</textarea>
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
@endsection
@section('footer')

@endsection
