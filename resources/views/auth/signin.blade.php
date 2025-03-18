@extends('front.layouts.app')
@section('page_title', 'Вход в личный кабинет')
@section('meta_description', 'Вход в личный кабинет покупателя LIME-MARKET')
@section('breadcrumbs')
    <li class="breadcrumb-item">Вход в личный кабинет</li>

@endsection
@section('content')
	<div class="page-content pt-30 pb-30">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 col-lg-10 col-md-12 m-auto">
					<div class="row align-self-center">
						<div class="col-lg-6 offset-lg-3 col-md-8">
							<div class="login_wrap widget-taber-content background-white">
								<div class="padding_eight_all bg-white">
									<div class="heading_s1">
										@if ($phone === null)
											<h4 class="mb-10 text-center">Войти или создать профиль</h4>
										@else
											<h4 class="mb-10 text-center">Сейчас вам поступит звонок</h4>
											<p class="mb-20 text-center">Введите последние 4 цифры входящего звонка</p>
										@endif
									</div>
									<form action="{{ route('signin') }}" method="post"> @csrf
											<div class="form-group">
												@if ($phone === null)
													<input type="tel" name="phone" placeholder="+7 (___) ___-__-__"  value="{{ $phone }}" required autocomplete="phone" autofocus id="phone" />
												@else
													<input type="text" name="code" placeholder="----"  value="{{ old('code') }}" required autofocus id="code" />
													<input name="phone" value="{{ $phone }}" hidden />
												@endif
												@if(isset($error_message))
													<span class="invalid-feedback d-block" role="alert">
														<strong>{{ $error_message }}</strong>
													</span>
												@endif
												@error('phone')
													<span class="invalid-feedback d-block" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
                      <div class="login_footer form-group mb-20">
												<div class="chek-form">
													<div class="custome-checkbox">
														@if ($phone === null)
															<input class="form-check-input" type="checkbox" required name="terms_of_use" id="terms_of_use"  />
															<label class="form-check-label" for="terms_of_use">
																<span>Я согласен с условиями пользования.
																	<a href="#">
																		<i class="fi-rs-book-alt mr-5 text-muted"></i>
																		Узнайте больше
																	</a>
																</span>
															</label>
														@else
															<input type="checkbox" name="terms_of_use" hidden checked />
														@endif
														@error('terms_of_use')
															<span class="invalid-feedback d-block" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</div>
												</div>
                      </div>
                      <div class="form-group mb-20 btn-registr text-center">
												@if ($phone === null)
													<button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="get-code">Получить код</button>
												@else
													<button type="submit" class="mb-10 btn btn-fill-out btn-block hover-up font-weight-bold" name="send-code">Войти в личный кабинет</button>
													<a class="link-full-width" href="{{ route('signin') }}">Вернуться назад</a>
												@endif
                      </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		window.addEventListener('load', () => {
			let phoneInput = document.getElementById('phone');
			let codeInput = document.getElementById('code');

			if (phoneInput !== null) {
				let numberMask = new Inputmask("+7 (999) 999-99-99");
				numberMask.mask(phoneInput);
			}

			if (codeInput !== null) {
				let codeMask = new Inputmask("9999");
				codeMask.mask(codeInput);
			}
		})
	</script>
@endsection
