<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreUserRequest;
use App\Http\Requests\Admin\Update\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index',[
            'users'=>User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $info = $request->validated();

        if ($request-> has('password') and $request->password !=null ){
            $info['password']= bcrypt($request->password);
        }else
        {
            unset($info['password']);
        }
        User::create($info);

        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $info = $request->validated();

        if ($request->has('password')){
            $info['password'] = bcrypt($request->password);
        }else{
            unset($info['password']);
        }

        $user->update($info);

        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash('Удалено!')->error();

        return back();
    }
}
