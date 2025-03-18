@extends('front.layouts.app')
@section('page_title', 'Профиль пользователя')
@section('meta_description', 'Профиль пользователя')
@section('header')
    <style>
        textarea{
            min-height: 150px !important;
        }
    </style>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Личный кабинет</li>
@endsection
@section('content')
    <div class="personal-area">
        <div class="container">
            <h2 class="personal-area__title">Личный кабинет</h2>
            @include('front.account.parts.links')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('front.profile.update') }}" method="post"> @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-6 ">
                                            <div class="form-group">
                                                <label for="name">Имя <span class="text-danger">*</span></label>
                                                <input type="text" required name="name" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 ">
                                            <div class="form-group">
                                                <label for="last_name">Фамилия <span class="text-danger">*</span></label>
                                                <input type="text" required name="last_name" value="{{ $user->last_name }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-12 col-md-6 ">
                                            <div class="form-group">
                                                <label for="phone">Телефон <span class="text-danger">*</span></label>
                                                <input value="{{ old('phone', mb_substr($user->phone, 1)) }}" id="phone" type="text" name="phone" placeholder="Номер телефона">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <button class="btn">Сохранить</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>
    </div>
	<script>
		window.addEventListener('load', () => {
			let phoneInput = document.getElementById('phone');

			if (phoneInput !== null) {
				let numberMask = new Inputmask("+7 (999) 999-99-99");
				numberMask.mask(phoneInput);
			}
		})
	</script>
@endsection
@section('footer')

@endsection

