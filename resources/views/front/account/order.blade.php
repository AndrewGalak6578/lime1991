@extends('front.layouts.app')
@section('page_title', 'Мои заказы')
@section('meta_description', 'Мои заказы')
@section('header')
    <style>
        .mb-5{
            margin-bottom: 35px !important;
        }
        .mt-5{
            margin-top: 35px !important;
        }
        @media (max-width: 768px) {
            .m-text-center{
                text-align: center !important;
            }
            .m-mb-5{
                margin-bottom: 45px !important;
            }
        }
    </style>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('front.profile') }}">Личный кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('front.profile.orders') }}">Мои заказы</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $order->id }}</li>
@endsection
@section('content')
    <div class="personal-area">
        <div class="container">
            <h2 class="personal-area__title">Мои заказы</h2>
            @include('front.account.parts.links')
           <div class="row">
               <div class="col-12">
                   <div class="card ">
                       <div class="card-header">
                           <div class="row">
                               <div class="col-12 col-md-6 m-text-center">
                                   <h4 class="mb-0 m-mb-5">Основная информация</h4>
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
                   <div class="card mt-5">
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
                   <div class="card mt-5">
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
        </div>
    </div>
@endsection
@section('footer')

@endsection

