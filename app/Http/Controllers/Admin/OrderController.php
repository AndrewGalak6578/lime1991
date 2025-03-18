<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->has('status')){
            $orders = Order::with('products')->orderByDesc('id')->where(['status' => request()->get('status')])->get();
        }else{
            $orders = Order::with('products')->orderByDesc('id')->get();
        }

        return view('admin.orders.index', [
            'orders'=>$orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order'=>$order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', [
            'order'=>$order
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function add_product_to_order(Request $request, Order $order)
    {
        if(!$order->hasProduct($request['product_id'])){
            $product = Product::find($request['product_id']);
            OrderProduct::create([
                'order_id'=>$order->id,
                'product_id'=>$product->id,
                'price'=>$product->getPrice(),
                'quantity'=>$request['quantity'],
                'name'=>$product->name,
                'photo'=>$product->getCoverUrl(),
                'code'=>$product->code
            ]);

            $order->update([
                'amount'=>$order->amount+($product->getPrice()*$request['quantity'])
            ]);

            flash('Товар добавлен в заказ!')->success();

        }else{
            flash('Товар уже есть в заказе!')->error();
        }
        return back();
    }

    public function remove_product_from_order(Request $request, Order $order)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
