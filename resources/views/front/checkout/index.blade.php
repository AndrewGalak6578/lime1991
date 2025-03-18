@extends('front.layouts.app')
@section('page_title', 'Оформление заказа')
@section('meta_description', 'Оформление заказа')
@section('header')
    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Оформление заказа</li>
@endsection
@section('content')
    <form action="{{ route('front.orders.store') }}" method="POST"> @csrf

    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Оформить заказ</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="row">
                   <div class="col-12">
                       <div class="card pe-0 ps-0">
                           <div class="card-header">
                               <h4>Адрес и способ доставки</h4>
                           </div>
                           <div class="card-body">

                               <div class="col-12">
                                   <div class="row">
                                       <h4 class="mb-30">Способ доставки</h4>
                                   </div>
                               </div>

                               <div class="col-12">
                                   <div class="row">
                                       <div class="payment_option">
                                           <div class="custome-radio">
                                               <input class="form-check-input" value="1"  type="radio" name="delivery_method" id="delivery_method_1" checked="">
                                               <label class="form-check-label" for="delivery_method_1" data-bs-toggle="collapse" data-target="#delivery_method_1" aria-controls="delivery_method_1">Доставка</label>
                                           </div>
                                           <div class="custome-radio">
                                               <input class="form-check-input" value="2"  type="radio" name="delivery_method" id="delivery_method_2" >
                                               <label class="form-check-label" for="delivery_method_2" data-bs-toggle="collapse" data-target="#delivery_method_2" aria-controls="delivery_method_2">Самовывоз</label>
                                           </div>
                                       </div>
                                   </div>
                               </div>



                               <div class="col-12">
                                   <div class="row" id="delivery-address">
                                       <h4 class="mb-30">Адрес доставки</h4>
                                   </div>
                               </div>
                               <div class="col-12">

                                   <div class="form-group">
                                       <select name="user_address_id" id="address_type" required class="form-select">
                                           <option value="0">Добавить новый адрес</option>
                                           @auth
                                               @foreach(auth()->user()->address()->get() as $address)
                                                   <option data-cityName="{{ $address->city }}" value="{{ $address->id }}">{{ $address->getAddress() }}</option>
                                               @endforeach
                                           @endauth
                                       </select>
                                   </div>
                               </div>
                               <div class="col-12 new-address">
                                   <div class="form-group">
                                       <label for="address">Введите адрес</label>
                                       <input id="address" name="address" type="text" />
                                   </div>
                               </div>

                               <div class="d-none">
                                   <div class="col-12 col-md-4">
                                       <div class="form-group">
                                           <label for="city">Город <span class="text-danger">*</span></label>
                                           <input type="text" name="city" id="city" class="form-control">
                                       </div>
                                   </div>
                                   <div class="col-12 col-md-8">
                                       <div class="form-group">
                                           <label for="street">Улица <span class="text-danger">*</span></label>
                                           <input type="text" name="street" value="{{ old('street') }}" id="street" class="form-control">
                                       </div>
                                   </div>
                                   <div class="col-6 col-md-3">
                                       <div class="form-group">
                                           <input name="house" id="house" value="{{ old('house') }}"  type="text" placeholder="Дом *" class="form-control address_input">
                                       </div>
                                   </div>
                                   <div class="col-6 col-md-3">
                                       <div class="form-group">
                                           <input name="apartment" id="apartment" value="{{ old('apartment') }}" type="text" placeholder="Квартира/Офис" class="form-control address_input">
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="form-group">
                                           <textarea name="full_address" id="full_address"  placeholder="Полный адрес" cols="30" rows="10" class="form-control address_input">{{ old('address_comment') }}</textarea>
                                       </div>
                                   </div>

                                   <div class="col-12">
                                       <input type="text" name="lat" id="lat">
                                       <input type="text" name="lng" id="lng">
                                   </div>

                               </div>


                               <div class="col-12 new-address">
                                   <div class="form-group">
                                       <textarea name="address_comment" id="address_comment"  placeholder="Комментарий" cols="30" rows="10" class="form-control address_input">{{ old('address_comment') }}</textarea>
                                   </div>
                               </div>
                           </div>

                       </div>
                   </div>
            </div>

                <div class="row">



               <div class="col-12">
                   <div class="card mt-30">
                       <div class="card-header">
                           <h4>Контакты</h4>
                       </div>
                       <div class="card-body">
                           <div class="row">
                               <div class="col-12 col-md-6">
                                   <div class="form-group">
                                       <input name="name" required type="text" placeholder="Ваше имя" value="{{ (auth()->check()) ? old('name', auth()->user()->name) : old('name') }}" class="form-control">
                                   </div>
                               </div>
                               <div class="col-12 col-md-6">
                                   <div class="form-group">
                                       <input name="last_name" required type="text" placeholder="Ваша фамилия" value="{{ (auth()->check()) ? old('last_name', auth()->user()->last_name) : old('last_name') }}" class="form-control">
                                   </div>
                               </div>
                               <div class="col-12 col-md-6">
                                   <div class="form-group">
                                       <input name="phone" required type="text" placeholder="Номер телефона" value="{{ (auth()->check()) ? old('phone', auth()->user()->phone) : old('phone') }}" class="form-control">
                                   </div>
                               </div>
                               <div class="col-12 col-md-6">
                                   <div class="form-group">
                                       <input name="email" required type="email" placeholder="Электронная почта" value="{{ (auth()->check()) ? old('email', auth()->user()->email) : old('email') }}" class="form-control" @guest id="email" @endguest>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>


                    <div class="col-12">
                        <div class="card mt-30">
                            <div class="card-header">
                                <h4>Способ оплаты</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="payment_option">
                                            <div class="custome-radio">
                                                <input class="form-check-input" value="1"  type="radio" name="payment_method" id="payment_method_1" checked="">
                                                <label class="form-check-label" for="payment_method_1" data-bs-toggle="collapse" data-target="#payment_method_1" aria-controls="payment_method_1">Наличными при получении</label>
                                            </div>

                                            <div class="custome-radio">
                                                <input class="form-check-input" value="2"  type="radio" name="payment_method" id="payment_method_2" >
                                                <label class="form-check-label" for="payment_method_2" data-bs-toggle="collapse" data-target="#payment_method_2" aria-controls="payment_method_2">Картой при получении</label>
                                            </div>

                                            <div class="custome-radio">
                                                <input class="form-check-input" value="3"  type="radio" name="payment_method" id="payment_method_3" >
                                                <label class="form-check-label" for="payment_method_3" data-bs-toggle="collapse" data-target="#payment_method_3" aria-controls="payment_method_3">Онлайн на сайте</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="border p-40 cart-totals  mb-40">
                    <div class="d-flex align-items-end justify-content-between mb-30 pl-20">
                        <h4>Ваш заказ</h4>
                        <h6 class="text-muted">{{ getCartTotal() }}&#x20bd;</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                            @foreach($carts as $cart)
                                @auth
                                    @php $product = $cart->product; @endphp
                                @else
                                    @php $product = $cart->associatedModel; @endphp
                                @endauth
                            <tr>
                                <td class="image product-thumbnail"><img src="{{ $product->getCoverUrl() }}" alt="#"></td>
                                <td>
                                    <h6 class="w-160 mb-5"><a href="{{ route('front.products.show', $product) }}" class="text-heading">{{ $product->name }}</a></h6></span>
                                </td>
                                <td>
                                    <h6 class="text-muted pl-20 pr-20">x {{ $cart->quantity }}</h6>
                                </td>
                                <td>
                                    <h4 class="text-brand">{{ $cart->quantity*$product->getPrice() }}&#x20bd;</h4>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card  mb-50">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Стоимость товаров</td>
                                    <td>{{ getCartTotal() }}&#x20bd;</td>
                                </tr>
                                <tr id="delivery-total" class="d-none">
                                    <td>Доставка</td>
                                    <td><span id="delivery-total-price"></span>&#x20bd;</td>
                                </tr>

                                @if($coupon)
                                    <tr>
                                        <td>Купон {{$coupon->name }}</td>
                                        <td>
                                            @if ($coupon->type == 0)
                                                {{$coupon->coupon_amount}}%
                                            @elseif ($coupon->type == 1)
                                                {{$coupon->coupon_amount}} сом
                                                @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Скидка</td>
                                        <td>
                                            &#x20bd; {{getCartTotal() - getCartTotal(getActiveCoupon())}}
                                        </td>
                                    </tr>

                                @endif

                                <tr>
                                    <td>Общая сумма</td>
                                    <td><span id="all-total">{{  getCartTotal(getActiveCoupon()) }}</span>&#x20bd;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-grid gap-1">
                    <button id="submit-button" type="submit" class="btn btn-block ">Оформить заказ</button>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>
    <script>
        $("#address").suggestions({
            token: "bb4191ad1a09e247c4f080f924323f74198a0657",
            type: "ADDRESS",
            constraints: {
                locations: { region_fias_id: "d00e1013-16bd-4c09-b3d5-3cb09fc54bd8" },
            },
            onSelect: function(suggestion) {
                updateDeliveryPrice(suggestion.data.city);
                $('#city').val(suggestion.data.city);
                $('#street').val(suggestion.data.street);
                $('#house').val(suggestion.data.house);
                $('#apartment').val(suggestion.data.flat);
                $('#lat').val(suggestion.data.geo_lat);
                $('#lng').val(suggestion.data.geo_lon);
                $('#full_address').val(suggestion.unrestricted_value);
            }
        });

        $('#address_type').on('change', function(){
            if($(this).val() == 0){
                $('.new-address').removeClass('d-none');
            }else{
                updateDeliveryPrice($('#address_type option:selected').attr('data-cityname'));
                $('.new-address').addClass('d-none');
            }
        });

        $('input[name="delivery_method"]').on('change', function (){
            if($(this).val() == 2){
                $('#delivery-address').addClass('d-none');
            }else{
                $('#delivery-address').removeClass('d-none');
            }
        });

        function updateDeliveryPrice(city)
        {
            let totalPrice = '<?php echo getCartTotal(); ?>';
            let deliveryPrice = 0;

            $('#delivery-total').removeClass('d-none');
            if(city == 'Краснодар'){
                let minFreeDelivery = '<?php echo getValue('delivery_price');?>';
                if(parseInt(totalPrice) < parseInt(minFreeDelivery)){
                    deliveryPrice = '<?php echo getSecondValue('delivery_price');?>';
                    $('#delivery-total-price').html(deliveryPrice);
                }else{
                    $('#delivery-total-price').html('0');
                }
            }else{
                $('#delivery-total-price').html('Уточняйте у менеджера');
            }
            $('#all-total').html(parseInt(totalPrice)+parseInt(deliveryPrice));
        }
    </script>
@endsection

