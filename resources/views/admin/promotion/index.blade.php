@extends('admin.layouts.app')
@section('page_title', 'Акции')
@section('page_name', 'Акции')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Акции</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.promotion.create') }}" class="btn btn-primary">Добавить акцию</a>
        </div>
        <div class="card-body">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Номинал</th>
                        <th>Действителен до</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promotions as $promotion)
                        <tr>
                            <td>{{ $promotion->name }}</td>
                            <td>{{ $promotion->discount }}%</td>
                            <td>{{ \Carbon\Carbon::createFromDate($promotion->available_until) }}</td>
                            <td>
                                @if($promotion->status == 1)
                                    <button class="btn btn-success btn-xs">Действительный</button>
                                    @else
                                    <button class="btn btn-dark btn-xs">Не действительный</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.promotion.edit', $promotion) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                                <button onclick="destroy('#delete-coupon-', '{{ $promotion->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.promotion.destroy', $promotion) }}" method="POST" id="delete-coupon-{{ $promotion->id }}">@csrf @method('delete')</form>
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
