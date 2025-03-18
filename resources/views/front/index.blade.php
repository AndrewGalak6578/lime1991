@extends('front.layouts.app')
@section('page_title', 'Главная страница')
@section('meta_description', 'Главная страница')
@section('header')
    <style>
        .slider-arrow{
            top: 45%;
        }
    </style>
@endsection
@section('content')
    <section class="home-slider position-relative mb-15">
        <div class="container">
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                    @foreach($homeSliders as $homeSlide)
                    <a href="{{ $homeSlide->link }}" class="single-hero-slider single-animation-wrap">
                        <picture>
                            <source srcset="{{ $homeSlide->mobile_img }}" media="(max-width: 768px)">
                            <img src="{{ $homeSlide->web_img }}" class="w-100" alt="">
                        </picture>
                    </a>
                    @endforeach
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </div>
    </section>


    <section class="popular-categories">
        <div class="container wow animate__animated animate__fadeIn mb-30">
            <div class="section-title">
                <div class="title">
									@if ($value = $keyValues->where('key', 'zagolovok-kataloga-tovarov')->first())
                    <h3>{{ $value->value }}</h3>
									@endif
                </div>
                <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                     id="carausel-10-columns-arrows"></div>
            </div>
            <div class="carausel-10-columns-cover position-relative">
                <div class="carausel-10-columns" id="carausel-10-columns">

                    @foreach($catalogs as $catalog)
                    <div class="card-2 {{ $catalog->bg }} wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="{{ $catalog->link }}"><img src="{{ $catalog->icon }}" alt="{!! $catalog->name !!}" /></a>
                        </figure>
                        <h6><a href="{{ $catalog->link }}">{!! $catalog->name !!}</a></h6>
                        @if($catalog->description != null)
                        <span>140 позиций</span>
                        @endif
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!--End category slider-->
    <section class="banners">
        <div class="container">
            <!-- <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="" class="banner-img">
                        <img src="" alt="" />
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="" class="banner-img">
                        <img src="" alt="" />
                    </a>
                </div>
            </div> -->
        </div>
    </section>
    <!--End banners-->
    <section class="product-tabs popular-product-main section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
							@if ($value = $keyValues->where('key', '1-blok-tovarov')->first())
								<h3>{{ $value->value }}</h3>
							@endif
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
												@if ($blocks->where('name', 'Блок 1')->first())
													@foreach($blocks->where('name', 'Блок 1')->first()->products()->get() as $product)
															<div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-flex align-items-stretch">
															@include('front.products.card', $product)
															</div>
													@endforeach
												@endif
                    </div>
                    <!--End product-grid-4-->
                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <!--Products Tabs-->

    <!--End Best Sales-->

    <section class="newsletter mt-30 mb-15 wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner">
                        <div class="newsletter-content">
                            <h2 class="mt-20 mb-20">
                                Нужна консультация?
                            </h2>
                            <p class="mb-45">Оставьте Ваш номер телефона. <br>Наш менеджер перезвонит Вам в
                                ближайшее время.</p>
                            <div class="form-subcriber d-flex">
                                <input type="text" id="footer-your-phone"  placeholder="Номер телефона" />
                                <input type="text" id="footer-from-where" value="@yield('page_title')" class="d-none" />
                                <input type="text" id="footer-from-where-url" value="{{ url()->full() }}" class="d-none" />
                                <button class="btn" id="footer-call-me" type="button">Отправить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                         data-wow-delay="0">
                        <div class="banner-icon">
                            <img src="/front_assets/imgs/theme/icons/icon-1.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Купоны и скидки</h3>
                            <p>Получайте купоны и скидки за повторные заказы</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                         data-wow-delay=".1s">
                        <div class="banner-icon">
                            <img src="/front_assets/imgs/theme/icons/icon-2.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Бесплатная <br> доставка</h3>
                            <p>по г. Краснодар</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                         data-wow-delay=".2s">
                        <div class="banner-icon">
                            <img src="/front_assets/imgs/theme/icons/icon-3.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Гарантия качества</h3>
                            <p>Официальная гарантия от производителя</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                         data-wow-delay=".3s">
                        <div class="banner-icon">
                            <img src="/front_assets/imgs/theme/icons/icon-4.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Широкий ассортимент</h3>
                            <p>от эконома до премиума</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                         data-wow-delay=".4s">
                        <div class="banner-icon">
                            <img src="/front_assets/imgs/theme/icons/icon-5.svg" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Легкий возврат</h3>
                            <p>В течении 30 дней</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')

@endsection
