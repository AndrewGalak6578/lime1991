@extends('admin.layouts.app')
@section('page_title', 'Купоны')
@section('page_name', 'Купоны')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Купоны</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">Добавить купон</a>
        </div>
        <div class="card-body">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Код</th>


                        <th>Действителен до</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->name }}</td>
                            <td>{{ $coupon->code }}</td>
                            @if($coupon->type == 0)
                                    %
                                @elseif($coupon->type == 1)
                                    руб.
                                @elseif($coupon->type == 2)
                                    Бесплатная доставка
                                @endif</td>
                            <td>{{ \Carbon\Carbon::createFromDate($coupon->available_until) }}</td>
                            <td>
                                @if($coupon->status == 1)
                                    <button class="btn btn-success btn-xs">Действительный</button>
                                    @else
                                    <button class="btn btn-dark btn-xs">Не действительный</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                                <button onclick="destroy('#delete-coupon-', '{{ $coupon->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" id="delete-coupon-{{ $coupon->id }}">@csrf @method('delete')</form>
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
