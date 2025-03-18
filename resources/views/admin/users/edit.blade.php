@extends('admin.layouts.app')
@section('page_title', 'Редактировать пользователя')
@section('page_name', 'Редактировать пользователя')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $user->getFullName() }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-toggle="tab" data-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Основная информация</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="address-tab" data-toggle="tab" data-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">Адреса доставки</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="orders-tab" data-toggle="tab" data-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">Заказы</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-toggle="tab" data-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Отзывы</button>
                </li>
{{--                <li class="nav-item" role="presentation">--}}
{{--                    <button class="nav-link" id="referal-tab" data-toggle="tab" data-target="#referal" type="button" role="tab" aria-controls="referal" aria-selected="false">Рефералы</button>--}}
{{--                </li>--}}
{{--                <li class="nav-item" role="presentation">--}}
{{--                    <button class="nav-link" id="bonuse-tab" data-toggle="tab" data-target="#bonuse" type="button" role="tab" aria-controls="bonuse" aria-selected="false">Бонусная система</button>--}}
{{--                </li>--}}
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST"> @csrf @method('put')
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">Имя <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $user->name }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Фамилия</label>
                                    <input type="text" name="last_name" value="{{ $user->last_name }}"  class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ $user->email }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" name="password" class="form-control">
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
                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">

                        <div class="row">
                            <div class="col-12">

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Адреса</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($user->address()->get() as $userAddress)
                                                <tr>
                                                    <td>{{ $userAddress->full_address }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                            </div>
                        </div>

                </div>
                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Заказ</th>
                                        <th>Кол.товаров</th>
                                        <th>Стоимость товаров</th>
                                        <th>Стоимость доставки</th>
                                        <th>Всего</th>
                                        <th>Дата</th>
                                        <th>Статус</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->orders()->orderBy('id', 'DESC')->get() as $order)
                                        <tr>
                                            <td>№{{ $order->id }}</td>
                                            <td>{{ $order->products()->count() }}</td>
                                            <td>{{ $order->amount }}₽</td>
                                            <td>{{ $order->getDeliveryPrice() }}</td>
                                            <td>{{ $order->getAllTotal() }}₽</td>
                                            <td>{{ date_format($order->created_at, 'd.m.Y H:i') }}</td>
                                            <td>{{ $order->getStatus() }}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm sharp"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning btn-sm sharp"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                       
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Продукт</th>
                            <th scope="col">Сообщение</th>
                            <th scope="col">Рейтинг</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->reviews as $review)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$review->product->name}}</td>
                                <td>{{$review->review}}</td>
                                <td>{{$review->rating}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="referal" role="tabpanel" aria-labelledby="referal-tab">referal</div>
                <div class="tab-pane fade " id="bonuse" role="tabpanel" aria-labelledby="bonuse-tab">bonuse</div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
