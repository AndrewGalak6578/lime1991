@extends('front.layouts.app')
@section('page_title', 'Профиль пользователя')
@section('page_desc', 'Профиль пользователя')
@section('body_class', 'page-account')
@section('breadcrumbs')

@endsection
@section('header')

@endsection
@section('content')
    <div class="personal-area">
        <div class="container">
            <h2 class="personal-area__title">Адреса доставки</h2>
            <div class="row">
                @include('front.account.parts.links')
            </div>
            <div class="row">
                <div class="card-header mb-20">
                    <h5 class="title-block">Адреса доставки</h5>
                </div>
                <form action="{{ route('front.userAddresses.update', $userAddress)}}" method="POST"> @csrf @method('put')
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <select name="city" id="city" required class="form-select">

                                        <option value="Краснодар">Краснодар</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <input name="street" id="street" value="{{ old('street', $userAddress->street) }}" required type="text" placeholder="Улица *" class="form-control address_input">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <input name="house" id="house" value="{{ old('house', $userAddress->house) }}" required type="text" placeholder="Дом *" class="form-control address_input">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <input name="apartment" id="apartment" value="{{ old('apartment', $userAddress->apartment) }}" type="text" placeholder="Квартира/Офис" class="form-control address_input">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <input name="entrance" id="entrance" value="{{ old('entrance', $userAddress->entrance) }}" type="text" placeholder="Подъезд" class="form-control address_input">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <input name="floor" id="floor" value="{{ old('floor', $userAddress->floor) }}" type="text" placeholder="Этаж" class="form-control address_input">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea name="address_comment" id="address_comment"  placeholder="Комментарий" cols="30" rows="10" class="form-control address_input">{{ old('address_comment', $userAddress->address_comment) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-3 ">
                            <button class="btn">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
