@extends('admin.layouts.app')
@section('page_title', 'Редактировать группу ключей')
@section('page_name', 'Редактировать группу ключей')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Настройки</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.settings.keys.values') }}">Ключи и значения</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.settings.keyGroups.index') }}">Группы ключей</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $keyGroup->name }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.settings.keyGroups.update', $keyGroup) }}" method="POST"> @csrf @method('put')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $keyGroup->name }}" required class="form-control">
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
