@extends('front.layouts.app')
@section('page_title', 'Мои заказы')
@section('meta_description', 'Мои заказы')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('front.profile') }}">Личный кабинет</a></li>
    <li class="breadcrumb-item active" aria-current="page">Мои заказы</li>
@endsection
@section('content')
    <div class="personal-area">
        <div class="container">
            <h2 class="personal-area__title">Мои заказы</h2>
            @include('front.account.parts.links')
            <div class="card">
                <div class="card-body">
                    @if(auth()->user()->orders()->orderBy('id', 'DESC')->count()>0)
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
                            @foreach(auth()->user()->orders()->orderBy('id', 'DESC')->get() as $order)
                                <tr>
                                    <td>№{{ $order->id }}</td>
                                    <td>{{ $order->products()->count() }}</td>
                                    <td>{{ $order->amount }}₽</td>
                                    <td>{{ $order->getDeliveryPrice() }}</td>
                                    <td>{{ $order->getAllTotal() }}₽</td>
                                    <td>{{ date_format($order->created_at, 'd.m.Y H:i') }}</td>
                                    <td>{{ $order->getStatus() }}</td>
                                    <td><a href="{{ route('front.profile.orders.show', $order) }}" class="btn-small d-block">Просмотр</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p>У вас пока нет заказов!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection

