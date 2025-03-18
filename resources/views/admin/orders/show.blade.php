@extends('admin.layouts.app')
@section('page_title', 'Просмотр заказа #'.$order->id)
@section('page_name', 'Просмотр заказа #'.$order->id)
@section('header')
    <style>
        .pr_image img{
            height: 100px;
            width: 100px;
            object-fit: cover;
        }
        .card-header{
            display: block;
            width: 100%;
        }
    </style>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
    <li class="breadcrumb-item active">Просмотр</li>
    <li class="breadcrumb-item active">{{ $order->id }}</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('admin.users.edit', $order->user_id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-user"></i> Открыть пользователя</a>
            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Редактировать</a>
            <button class="btn btn-info"><i class="fa fa-print"></i> Печать</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-6 m-text-center">
                            <h4 class="mb-0 ">Основная информация</h4>
                        </div>
                        <div class="col-12 col-md-6 text-right m-text-center">
                            {!! $order->getStatusButton() !!}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <b>Номер заказа</b>
                            <p>{{ $order->id }}</p>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <b>Дата и время оформления</b>
                            <p>{{ $order->orderDateTime() }}</p>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <b>Получатель</b>
                            <p>{{ $order->clientName() }}</p>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <b>Номер телефона</b>
                            <p>{{ $order->phone }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <b>Адрес доставки</b>
                            <p>{{ $order->full_address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="mb-0">Товары в заказе</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Цена за ед.</th>
                                <th>Количество</th>
                                <th>Общая цена</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products()->get() as $product)
                                <tr>
                                    <td class="image product-thumbnail">
                                        <a href="{{ route('front.products.show', $product->product) }}" target="_blank">
                                            <div class="d-flex  align-items-center">
                                                <div class="pr_image">
                                                    <img src="{{ $product->product->getCoverUrl() }}" alt="#" class="mr-2">
                                                </div>
                                                <div class="pr_info pl-5">
                                                    <h6 class="w-160"><span class="text-heading">{{ $product->product->name }}</span></h6>
                                                    <p>{{ $product->product->code }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{ $product->price }}&#x20bd;</td>
                                    <td>
                                        <h6 class="text-muted pl-20 pr-20">{{ $product->quantity }}</h6>
                                    </td>
                                    <td>
                                        <h4 class="text-brand">{{ $product->quantity*$product->price }}&#x20bd;</h4>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="mb-0">Стоимость и доставка</h4>
                </div>
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <b>Стоимость товаров</b>
                        <p>{{ $order->amount }}₽</p>
                    </div>
                    <div class="col-12 mb-3">
                        <b>Стоимость доставки</b>
                        <p>{{ $order->getDeliveryPrice() }}</p>
                    </div>
                    <div class="col-12 mb-3">
                        <b>Общая стоимость</b>
                        <p>{{ $order->getAllTotal() }}₽</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
