@extends('admin.layouts.app')
@section('page_title', 'Редактировать администратора')
@section('page_name', 'Редактировать администратора')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">Администраторы</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $admin->name }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.admins.update', $admin) }}" method="POST"> @csrf @method('put')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Имя <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $admin->name }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ $admin->email }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password">Пароль </label>
                            <input type="password" name="password"  class="form-control">
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
