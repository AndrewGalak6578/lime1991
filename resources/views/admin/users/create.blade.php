@extends('admin.layouts.app')
@section('page_title', 'Добавить пользователя')
@section('page_name', 'Добавить пользователя')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST"> @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Имя <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="last_name">Фамилия</label>
                            <input type="text" name="last_name"  class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password">Пароль <span class="text-danger">*</span></label>
                            <input type="password" name="password" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Добавить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')

@endsection
