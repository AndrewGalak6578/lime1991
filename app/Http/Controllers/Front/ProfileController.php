<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Update\UpdateUserRequest;
use App\Http\Requests\Front\Update\UpdateUserSettingsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //Страница личный кабинет
    public function index()
    {
        return view('front.account.profile', [
            'user'=>auth()->user()
        ]);
    }

    //Обновление основной информации о пользователе
    public function update(UpdateUserRequest $request)
    {
        auth()->user()->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    //Обновить настройки пользователя
    public function updateSettings(UpdateUserSettingsRequest $request)
    {
        $info = $request->validated();

        if($request->has('new_password') AND $request['new_password'] != null){
            if (\Hash::check($request->old_password, auth()->user()->password)) {
                $info['password'] = bcrypt($request['new_password']);
            }else{
                flash('Старый пароль не верный!')->error();
                return back();
            }
        }else{
            unset($info['password']);
        }

        auth()->user()->update($info);
        flash('Обновлено!')->success();
        return back();
    }

    //Страница моих заказов
    public function orders()
    {
        return view('front.account.orders', [
            'user'=>auth()->user(),
            'orders'=>[]
        ]);
    }

    //Страница избранного
    public function favorites()
    {
        return view('front.account.favorites', [
            'user'=>auth()->user(),
            'favorites'=>[]
        ]);
    }

    //Страница настроек профиля
    public function settings()
    {
        return view('front.account.settings', [
            'user'=>auth()->user()
        ]);
    }

    //проверка email на оформление заказа
    public function checkEmail(Request $request)
    {
        return (User::where('email', $request['email'])->exists()) ? 'registered' : 'false';
    }


}
