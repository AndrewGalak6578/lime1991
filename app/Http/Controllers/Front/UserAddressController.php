<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Store\StoreUserAddressRequest;
use App\Http\Requests\Front\Update\UpdateUserAddressRequest;
use App\Http\Resources\Front\UserAddressResource;
use App\Models\City;
use App\Models\UserAddress;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.account.addresses.index', [
            'userAddresses'=>auth()->user()->address()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front.account.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAddressRequest $request)
    {
        $info = $request->validated();
        $info['user_id'] = auth()->id();
        UserAddress::create($info);
        flash('Адрес добавлен!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAddress $userAddress)
    {
        if($userAddress->user_id == auth()->id()){
            return new UserAddressResource($userAddress);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAddress $userAddress)
    {
        abort_if(auth()->id() != $userAddress->user_id, 404);
        return view('front.account.addresses.edit', [
            'userAddress'=>$userAddress,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress)
    {
        $userAddress->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress)
    {
        if(auth()->id() == $userAddress->user_id){
            $userAddress->delete();
            flash('Удалено!')->error();
        }else{
            flash('Что-то пошло не так!')->error();
        }
        return back();
    }

}
