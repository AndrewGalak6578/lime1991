@extends('front.layouts.app')
@section('page_title', 'Настройки профиля')
@section('meta_description', 'Настройки профиля')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('front.profile') }}">Личный кабинет</a></li>
    <li class="breadcrumb-item active" aria-current="page">Настройки</li>
@endsection
@section('content')
    <div class="personal-area">
        <div class="container">
            <h2 class="personal-area__title">Настройки</h2>
            @include('front.account.parts.links')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('front.profile.settings.update') }}"> @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Электронная почта<span class="required">*</span></label>
                                            <input required value="{{ old('email', $user->email) }}" class="form-control" name="email" type="email" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Текущий пароль</label>
                                            <input  class="form-control" name="old_password" type="password" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6  col-md-12">
                                        <div class="form-group">
                                            <label>Новый пароль</label>
                                            <input class="form-control" name="new_password" type="password" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6  col-md-12">
                                        <div class="form-group">
                                            <label>Повторите пароль</label>
                                            <input class="form-control" name="new_password_confirmation" type="password" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold">Сохранить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('footer')

@endsection

