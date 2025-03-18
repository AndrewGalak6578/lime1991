<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreUserRequest;
use App\Http\Requests\Admin\Update\UpdateUserAddressRequest;
use App\Http\Requests\Admin\Update\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $info = $request->validated();
        $info['password'] = bcrypt($request['password']);

        $user = User::create($info);
        flash('Добавлно!')->success();
        return to_route('admin.users.edit', $user);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user'=>$user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $info = $request->validated();
        if($request->has('password')){
            $info['password'] = bcrypt($request['password']);
        }else{
            unset($info['password']);
        }

        $user->update($info);

        flash('Обновелно!')->success();
        return back();
    }

    public function updateAddress(UpdateUserAddressRequest $request, User $user)
    {
        $user->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        flash('Удалено!')->error();
        return back();
    }
}
