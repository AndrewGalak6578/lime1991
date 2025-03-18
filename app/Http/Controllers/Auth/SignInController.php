<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserAuthCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignInController extends Controller
{
	protected $redirectTo = RouteServiceProvider::HOME;

	public function __construct()
	{
			// $this->middleware('guest');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'phone' => ['required', 'string', 'phone', 'max:255', 'unique:users'],
			'terms_of_use'=>['required']
		]);
	}

	public function index(Request $request) {
		if (Auth::check()) {
      return redirect('/');
		}
		$phone = null;
		$code = null;

		$phone = preg_replace('/[\+\s\t\-_\(\)]+/', '', $request->input('phone'));
		$code = $request->input('code');
		
		if ($phone !== null && strlen($phone) !== 0 && strlen($phone) !== 11) {
			return view('auth.signin', [
				'phone' => null,
				'error_message' => 'Неверно указан номер телефона',
			]);
		} elseif ($phone === null || strlen($phone) === 0) {
			return view('auth.signin', [
				'phone' => null,
			]);
		}

		if ($code === null) {
			try {
				User::create([
					'phone' => $phone,
				]);
			} catch (\Exception $e) {}
			$user = User::where('phone', $phone)->first();
			if ($user === null) {
				return view('auth.signin', [
					'phone' => null,
					'error_message' => 'Произошла ошибка',
				]);
			}
			if (UserAuthCode::where('phone', $phone)->where('expire', '>=', date('Y-m-d H:i:s'))->first() === null) {
				// отправка кода
				UserAuthCode::create([
					'code' => '0001',
					'phone' => $phone,
					'expire' => date('Y-m-d H:i:s', time() + 5 * 60),
				]);
			}
		} elseif ($code !== null) {
			$_code = UserAuthCode::where('phone', $phone)->where('expire', '>=', date('Y-m-d H:i:s'))->first();
			if ($_code === null) {
				return view('auth.signin', [
					'phone' => null,
					'error_message' => 'Код истек',
				]);
			} elseif ($code !== $_code->code) {
				return view('auth.signin', [
					'phone' => $phone,
					'error_message' => 'Неверный код',
				]);
			}
			$_code->delete();
			$user = User::where('phone', $phone)->first();
			Auth::login($user);
      return redirect('/');
		}

		return view('auth.signin', [
			'phone' => $phone,
		]);
	}

	public function logout() {
		Auth::logout();
    return redirect('/');
	}

}
