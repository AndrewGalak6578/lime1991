@extends('front.layouts.app')
@section('page_title', 'Избранные товары')
@section('meta_description', 'Избранные товары')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('front.profile') }}">Личный кабинет</a></li>
    <li class="breadcrumb-item active" aria-current="page">Избранные товары</li>
@endsection
@section('content')
    <div class="container mb-30 mt-50 ">
        <div class="personal-area">
            <div class="container">
                <h2 class="personal-area__title">Избранное</h2>
                @include('front.account.parts.links')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 m-auto ">

                            @if(auth()->user()->products()->where('status', '!=', 5)->count()>0)
                                <div class="table-responsive shopping-summery">
                                    <table class="table table-wishlist">
                                        <thead>
                                        <tr class="main-heading">

                                            <th scope="col" colspan="2" class="pl-30">Товар</th>
                                            <th scope="col">Цена</th>
                                            <th scope="col">Количество</th>
                                            <th scope="col" class="pl-30">Добавить/Убрать</th>
                                            <th scope="col" class="end">Удалить</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(auth()->user()->products()->where('status', '!=', 5)->get() as $product)
                                            <tr class="pt-30">

                                                <td class="pl-30 image product-thumbnail pt-40"><img src="{{ $product->getCoverUrl() }}" alt="#" /></td>
                                                <td class="product-des product-name">
                                                    <h6><a class="product-name mb-10" href="{{ route('front.products.show', $product) }}">{{ $product->name }}</a></h6>
{{--                                                    <div class="product-rate-cover">--}}
{{--                                                        <div class="product-rate d-inline-block">--}}
{{--                                                            <div class="product-rating" style="width: 90%"></div>--}}
{{--                                                        </div>--}}
{{--                                                        <span class="font-small ml-5 text-muted"> (4.0)</span>--}}
{{--                                                    </div>--}}
                                                </td>
                                                <td class="price" data-title="Цена">
                                                    <h3 class="text-brand">&#x20bd;{{ $product->getPrice() }}</h3>
                                                </td>
                                                <td class="text-center detail-info" data-title="Наличие">
                                                    {!! $product->getStatusViewButton() !!}
                                                </td>
                                                <td class="text-left pl-20" data-title="Корзина">
                                                    <button class="btn btn-sm addToCart" data-productId="{{ $product->id }}">Добавить в корзину</button>
                                                </td>
                                                <td class="action text-center" data-title="Remove">
                                                    <a href="javascript:removeFromFavorite({{ $product->id }});" class="text-body"><i class="fi-rs-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <p>В избранном пока нет товаров</p>
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

