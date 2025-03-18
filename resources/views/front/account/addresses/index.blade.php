@extends('front.layouts.app')
@section('page_title', 'Профиль пользователя')
@section('page_desc', 'Профиль пользователя')
@section('body_class', 'page-account')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('front.profile') }}">Личный кабинет</a></li>
    <li class="breadcrumb-item active" aria-current="page">Адреса доставки</li>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if( $userAddresses->count() > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Адрес</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userAddresses as $userAddress )
                                        <tr>
                                            <td>{{ $userAddress->full_address }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @else
                                    <p>У вас пока нет адресов доставки. Для добавление адреса оформите заказ.</p>
                                @endif
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
