@extends('front.layouts.app')
@section('page_title', 'Корзина')
@section('meta_description', 'Корзина')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Корзина</li>
@endsection
@section('content')

    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Корзина</h1>
                @if(getCartCountTotal() > 0)
                <div class="d-flex justify-content-between" id="cart-total-span">
                    <h6 class="text-body">В вашей корзине {{ getCartCountTotal() }} товара</h6>
                    <h6 class="text-body"><a href="javascript:removeAllFromCart();" class="text-muted"><i class="fi-rs-trash mr-5"></i>Очистить корзину</a></h6>
                </div>
                @endif
            </div>
        </div>
        @if(getCartCountTotal() > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                        <tr class="main-heading">

                            <th scope="col" colspan="2" class="pl-30">Товвар</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Всего</th>
                            <th scope="col" class="end">Удалить</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($carts as $cart)
                            @auth
                                @php $product = $cart->product; @endphp
                            @else
                                @php $product = $cart->associatedModel; @endphp
                            @endauth
                            <tr class="pt-30" id="cart-line-{{ $product->id }}">

                                <td class="image product-thumbnail pl-30 pt-40"><img src="{{ $product->getCoverUrl() }}" alt="#"></td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="{{ route('front.products.show', $product) }}">{{ $product->name }}</a></h6>
                                    {{--            <div class="product-rate-cover">--}}
                                    {{--                <div class="product-rate d-inline-block">--}}
                                    {{--                    <div class="product-rating" style="width:90%">--}}
                                    {{--                    </div>--}}
                                    {{--                </div>--}}
                                    {{--                <span class="font-small ml-5 text-muted"> (4.0)</span>--}}
                                    {{--            </div>--}}
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-body">&#x20bd;<span>{{ $product->getPrice() }}</span> </h4>
                                </td>
                                <td class="text-center detail-info" data-title="Stock">
                                    <div class="detail-extralink mr-15">
                                        <div class="detail-qty border radius">
                                            <a href="javasciprt:void(0);" class="qty-down" data-productId="{{ $product->id }}"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val quantity-{{ $product->id }}">{{ $cart->quantity }}</span>
                                            <a href="javasciprt:void(0);" class="qty-up" data-productId="{{ $product->id }}"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-brand">&#x20bd;<span>{{ $cart->quantity*$product->getPrice() }}</span> </h4>
                                </td>
                                <td class="action text-center" data-title="Удалить из корзины"><a href="javascript:removeFromCart({{ $product->id }});" class="text-body"><i class="fi-rs-trash"></i></a></td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="cart-action d-flex justify-content-between">
                    <a href="/" class="btn "><i class="fi-rs-arrow-left mr-10"></i>В магазин</a>
                </div>
                <div class="row mt-50">
                    <div class="col-lg-5">
                        <div class="p-40">
                            <h4 class="mb-10">Применить купон</h4>
                            <p class="mb-30"><span class="font-lg text-muted">У Вас есть промокод? </span> </p>
                            <form action="{{route('front.coupon.store')}}" method="post">
                                @csrf
                                <div class="d-flex justify-content-between">
                                <input type="text" class="font-medium mr-15 coupon" placeholder="Ввести промокод"
                                       name="code" value="{{old('code')}}">
                                <button type="submit" class="fi-rs-label mr-10">Применить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="border p-md-4 cart-totals ml-30" id="cart-total-block">
                    <div class="table-responsive">
                        <table class="table no-border">
                            <tbody>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Сумма товаров в корзине</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">&#x20bd;{{ getCartTotal() }}</h4>
                                </td>
                            </tr>

                            @if($coupon)
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Купон {{$coupon->name }}</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            @if ($coupon->type == 0)
                                                {{$coupon->coupon_amount}}%
                                            @elseif ($coupon->type == 1)
                                                {{$coupon->coupon_amount}} сом
                                            @endif</h4>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Скидка</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">&#x20bd; {{getCartTotal() - getCartTotal(getActiveCoupon())}}</h4>
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td scope="col" colspan="2">
                                    <div class="divider-2 mt-10 mb-10"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Общая сумма</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">&#x20bd;{{ getCartTotal(getActiveCoupon())}}</h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('front.checkout.index') }}" class="btn mb-20 w-100">К оформлению заказа<i class="fi-rs-sign-out ml-15"></i></a>
                </div>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-12">
                    <p>У вас в корзине пока ничего нет!</p>
                    <div class="cart-action d-flex justify-content-between" style="margin-top: 50px;">
                        <a href="/" class="btn "><i class="fi-rs-home mr-10"></i>Перейти на главную</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('footer')

@endsection

