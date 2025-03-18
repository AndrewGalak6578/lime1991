@extends('admin.layouts.app')
@section('page_title', 'Редактировать купон')
@section('page_name', 'Редактировать купон')
@section('header')
    <link rel="stylesheet" href="/admin_assets/vendor/select2/css/select2.min.css">
    <link href="/admin_assets/vendor/jquery-steps/css/jquery.steps.css" rel="stylesheet">
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Купоны</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $coupon->id }}</li>
@endsection
@section('content')

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="coupon-brand" data-toggle="tab" data-target="#brand" type="button" role="tab" aria-controls="brand" aria-selected="true">Бренд</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="coupon-info" data-toggle="tab" data-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">Информация</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="brand" role="tabpanel" aria-labelledby="brands-tab">

                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addbrands">
                                    Добавить бренд
                                </button>
                            </div>
                            <div class="col-12 mt-3">
                                <table class="table datatable">
                                    <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Размер скидки</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                             @foreach($couponBrands as $couponBrand)
                                        <tr>
                                            <td>{{ $couponBrand->brands->name }}</td>
                                            <td>{{ $couponBrand->value }}</td>
                                            <td>
                                                <button onclick="destroy('#delete-couponBrand-', '{{ $couponBrand->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                <form action="{{ route('admin.couponBrands.destroy', $couponBrand) }}" method="POST" id="delete-couponBrand-{{ $couponBrand->id }}">@csrf @method('delete')</form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                        <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST"> @csrf @method('put')
                        <div class="row">
                            <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $coupon->name }}" required class="form-control">
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="code">Код <span class="text-danger">*</span></label>
                            <input type="text" name="code" value="{{ $coupon->code }}" required class="form-control">
                        </div>
                     </div>
                     <div class="col-12 col-md-6 d-none">
                        <div class="form-group">
                            <label for="type">Тип <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control">

                                <option @selected($coupon->type == 3)  value="3">По брендам</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-none">
                        <div class="form-group">
                            <label for="coupon_amount">Номинал</label>
                            <input type="text" name="coupon_amount" value="{{ $coupon->coupon_amount }}" id="coupon_amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="users_amount">Доступность купона <span class="text-danger">*</span></label>
                            <select name="users_amount" id="users_amount" class="form-control">
                                <option @selected($coupon->users_amount == 0) value="0">Доступен всем</option>
                                <option @selected($coupon->users_amount == 1) value="1">Только одному пользователю</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_id">Пользователь </label>
                            <select name="user_id" @disabled($coupon->users_amount == 0) id="user_id" class="form-control select2-userID">
                                @foreach($users as $user)
                                    <option @selected($coupon->user_id == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="available_until">Доступен до</label>
                            <input type="datetime-local" name="available_until" value="{{ $coupon->available_until }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select name="status" id="status" class="form-control">
                                <option @selected($coupon->status == 1) value="1">Действительный</option>
                                <option @selected($coupon->status == 2) value="2">Не действительный</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </div>
                            </form>
                    </div>


              </div>
            </div>
        </div>

@endsection
@section('footer')
    {{--    модальное окно добавление бренда начало--}}
    <div class="modal fade" id="addbrands" tabindex="-1" aria-labelledby="addbrandsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addbrandsLabel">Добавить бренд</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.couponBrands.store') }}" method="POST"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brand_id">Бренд <span class="text-danger">*</span></label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="value">Значение <span class="text-danger">*</span></label>
                            <input type="text" name="value" required class="form-control">
                        </div>
                        <div class="form-group d-none">
                            <label for="coupon_id">Купон</label>
                            <input type="text" name="coupon_id" value="{{ $coupon->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--модальное окно добавление бренда конец--}}



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
