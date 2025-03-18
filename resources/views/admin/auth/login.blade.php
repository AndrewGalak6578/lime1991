@extends('admin.auth.layouts.app')
@section('page_title', 'Войти')
@section('header')

@endsection
@section('content')
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Войти</h4>
                                    <form action="{{ route('admin.login') }}" method="POST"> @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Электронная почта</strong> <span class="text-danger">*</span></label>
                                            <input type="email" name="email" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Пароль</strong> <span class="text-danger">*</span></label>
                                            <input type="password" name="password" required class="form-control">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Войти</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
