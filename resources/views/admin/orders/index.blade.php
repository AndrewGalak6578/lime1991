@extends('admin.layouts.app')
@section('page_title', 'Заказы')
@section('page_name', 'Заказы')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Заказы</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="social-links mb-4 fs-16 font-weight-bold">
                <a class="btn {{ (!request()->has('status')) ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.orders.index') }}">Все заказы</a>
                @for($i = 0; $i <= 6; $i++)
                <a class="btn {{ (request()->has('status') && request()->get('status') == $i) ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.orders.index', ['status'=>$i]) }}">{{ orderStatuses($i) }}</a>
                @endfor
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table" id="datatable">
                <thead>
                <tr>
                    <th>Заказ</th>
                    <th>Кол.товаров</th>
                    <th>Стоимость товаров</th>
                    <th>Стоимость доставки</th>
                    <th>Всего</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
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
@endsection
@section('footer')

@endsection
