<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminsDataTable;
use App\DataTables\Admin\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreAdminRequest;
use App\Http\Requests\Admin\Update\UpdateAdminRequest;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminsDataTable $dataTable)
    {
        return $dataTable->render('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $info = $request->validated();
        if($request->has('password')){
            $info['password'] = bcrypt($request['password']);
        }

        $admin = Admin::create($info);

        flash('Добавлено!')->success();
        return to_route('admin.admins.edit', $admin);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', [
            'admin'=>$admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $info = $request->validated();
        if($request->has('password')){
            $info['password'] = bcrypt($request['password']);
        }else{
            unset($info['password']);
        }

        $admin->update($info);

        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        flash('Удалено!')->error();
        return back();
    }
}
