<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Store\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $info = $request->validated();

        //Определяем пользователя
        if(auth()->check()){
            $user = auth()->user();
            if($user->phone == null){
                $user->update(['phone'=>$request['phone']]);
            }
        }else{
            $password = Str::random(8);
            $user = User::create([
                'name'=>$request['name'],
                'last_name'=>$request['last_name'],
                'email'=>$request['email'],
                'phone'=>$request['phone'],
                'password' => bcrypt($password)
            ]);
            //TODO отправить письмо приглашение
        }
        $info['user_id'] = $user->id;


        //стоимость товаров в корзины
        $info['amount'] = getCartTotal(getActiveCoupon());


        //Определяем адрес доставки
        if($request['delivery_method'] == 1){

            if($request['user_address_id'] == 0){
                $address = UserAddress::create([
                    'user_id'=>$user->id,
                    'city'=>$request['city'],
                    'street'=>$request['street'],
                    'house'=>$request['house'],
                    'apartment'=>$request['apartment'],
                    'lat'=>$request['lat'],
                    'lng'=>$request['lng'],
                    'full_address'=>$request['full_address'],
                    'address_comment'=>$request['address_comment'],
                ]);
            }else{
                $address = UserAddress::find($request['user_address_id']);
            }

            $info['user_address_id'] = $address->id;
            $info['full_address'] = $address->getAddress();
            $info['lat'] = $address->lat;
            $info['lng'] = $address->lng;
            $info['address_comment'] = $address->address_comment;


            //Определяем стоимость доставки
            if($address->city != 'Краснодар'){
                $info['delivery_price'] = 'Уточнять у менеджера';
            }else{
                if($info['amount'] < getValue('delivery_price')){
                    $info['delivery_price'] = getSecondValue('delivery_price');
                }else{
                    $info['delivery_price'] = 0;
                }
            }

        }





        //формируем статус заказа
        $info['status'] = ($request['payment_method'] == 3) ? 5 : 0;

        //Создаем заказ
        $order = Order::create($info);


        //Добавляем к заказу товары
        $carts = (auth()->check()) ? $user->carts()->get() : \Cart::getContent();
        foreach($carts as $cart)
        {
            $product = (auth()->check()) ? $cart->product : $cart->associatedModel;
            $orderProduct = OrderProduct::create([
                'order_id'=>$order->id,
                'product_id'=>$product->id,
                'price'=>$product->getPrice(),
                'quantity'=>$cart->quantity,
                'name'=>$product->name,
                'photo'=>$product->getCoverUrl(),
                'code'=>$product->code
            ]);
        }


        //Удалить все из корзины
        if(Auth::check()){
            $user->carts()->delete();
        }else{
            \Cart::clear();
        }

        //Проверяем способ оплаты
        if($request['payment_method'] == 3){

            $final_amount = ($info['delivery_price'] == 'Уточнять у менеджера') ? $info['amount'] : $info['amount'] + $info['delivery_price'];
            //TODO отпраивть к оператору на оплату
        }

        //TODO отправить электронное сообщение клиенту
        //TODO отправить электронное сообщение администратору


        flash('Заказ оформлен, скоро с вами свяжется наш менеджер!')->success();
        return to_route('front.index');



    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        abort_if($order->user_id != auth()->id(), 404);
        return view('front.account.order', [
            'order'=>$order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
