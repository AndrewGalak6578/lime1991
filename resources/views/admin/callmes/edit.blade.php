@extends('admin.layouts.app')
@section('page_title', 'Редактировать заявку на обратный звонок')
@section('page_name', 'Редактировать заявку на обратный звонок')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.callmes.index') }}">Заявки на обратный звонок</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $callme->id }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.callmes.update', $callme) }}" method="POST"> @csrf @method('put')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="name">Имя <span class="text-danger">*</span></label>
                        <input type="text" name="name" required value="{{ $callme->name }}" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="phone">Телефон <span class="text-danger">*</span></label>
                        <input type="text" name="phone" required value="{{ $callme->phone }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="from_where">Откуда</label>
                            <input type="text" name="from_where" value="{{ $callme->from_where }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="status">Статус <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control">
                                <option @selected($callme->status == 0) value="0">Не обработано</option>
                                <option @selected($callme->status == 1) value="1">Обработано</option>
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
@endsection
@section('footer')

@endsection
