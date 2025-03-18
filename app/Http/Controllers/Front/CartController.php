<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart as UserCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if(Auth()->check()){
            $carts = auth()->user()->carts()->get();
        }else {
            $carts = \Cart::getContent();
        }
        $coupon = getActiveCoupon();
        return view('front.cart.index', [
            'carts'=>$carts,
            'coupon' => $coupon,
        ]);
    }

    public function store(Request $request)
    {
        $product = Product::find($request['product_id']);

        if(auth()->check()){
            //добавлять в модель
            $qty = $request['quantity'] ? $request['quantity'] : 1;
            $info = [
                'user_id'=>auth()->id(),
                'product_id'=>$request['product_id'],
                'quantity'=>$qty
            ];
            if(UserCart::where(['user_id'=>auth()->id(), 'product_id' => $request['product_id']])->exists()){
                $cart = UserCart::where(['user_id'=>auth()->id(), 'product_id' => $request['product_id']])->first();
                $cart->update([
                    'quantity'=>$cart->quantity+$qty
                ]);
            }else{
                UserCart::create($info);
            }
        }else{
            //добавлять в сессии
            \Cart::add([
                'id'=>$request['product_id'],
                'name'=>$product->name,
                'price'=>$product->getPrice(),
                'quantity'=>$request['quantity'] ? $request['quantity'] : 1,
                'attributes'=>[
                    'img'=>$product->getCoverUrl(),
                ],
                'associatedModel'=>$product
            ]);
        }

        return response('added', 200);
    }

    public function update(Request $request, $cart)
    {
        if(Auth::check()){
            $cart = UserCart::where(['user_id'=>auth()->id(), 'product_id'=>$cart])->first();

            $cart->update([
                'quantity' => $request['quantity']
            ]);

        }else{
            \Cart::update($cart, [
                'quantity' => ($request['type'] == 1) ? -1 : 1
            ]);
        }
        return response('updated', 200);
    }

    public function destroy(Request $request, $cart)
    {
        if(Auth::check()){
            $cart = UserCart::where(['user_id'=>auth()->id(), 'product_id'=>$cart])->first();
            $cart->delete();
        }else{
            \Cart::remove($cart);
        }
        return response('deleted', 200);
    }

    public function removeAllFromCart()
    {
        if(Auth::check()){
            auth()->user()->carts()->delete();
        }else{
            \Cart::clear();
        }
        return response('deleted', 200);
    }

}
