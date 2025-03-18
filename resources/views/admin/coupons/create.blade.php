@extends('admin.layouts.app')
@section('page_title', 'Добавить купон')
@section('page_name', 'Добавить купон')
@section('header')
    <link rel="stylesheet" href="/admin_assets/vendor/select2/css/select2.min.css">
    <link href="/admin_assets/vendor/jquery-steps/css/jquery.steps.css" rel="stylesheet">
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Купоны</a></li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <form action="{{ route('admin.coupons.store') }}" method="POST"> @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="name">Название <span class="text-danger">*</span></label>
                        <input type="text" name="name" required class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="code">Код <span class="text-danger">*</span></label>
                        <input type="text" name="code" required class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-6 d-none">
                    <div class="form-group ">
                        <label for="type">Тип <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control">
                            <option value="0">Скидка в %</option>
                            <option value="1">Фиксированная скидка в ₽</option>
                            <option value="2">Бесплатная доставка</option>
                            <option value="3"selected>По брендом</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-none">
                    <div class="form-group">
                        <label for="coupon_amount">Номинал</label>
                        <input type="text" name="coupon_amount" id="coupon_amount" value="0" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="users_amount">Доступность купона <span class="text-danger">*</span></label>
                        <select name="users_amount" id="users_amount" class="form-control">
                            <option value="0">Доступен всем</option>
                            <option value="1">Только одному пользователю</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="user_id">Пользователь </label>
                        <select name="user_id" disabled id="user_id" class="form-control select2-userID">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="available_until">Доступен до</label>
                        <input type="datetime-local" name="available_until" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Действительный</option>
                            <option value="2">Не действительный</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('footer')
    <script src="/admin_assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="/admin_assets/js/plugins-init/select2-init.js"></script>
    <script>
        $('#users_amount').on('change', function(){
            if($(this).val() == 1){
                $('#user_id').removeAttr('disabled');
            }else{
                $('#user_id').attr('disabled', 'true')
            }
        })
    </script>
@endsection
