<!DOCTYPE html>
<html class="no-js" lang="ru">

<head>
    <meta charset="utf-8" />
    <title>@yield('page_title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" /> <meta name="description" content="@yield('meta_description')" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/front_assets/logo/logo.png" />
    <!-- Template CSS -->

    <link rel="stylesheet" href="/front_assets/css/plugins/slick.css" />

    <!--     -->
    <link rel="stylesheet" href="/front_assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="/front_assets/css/plugins/slider-range.css" />
    <link rel="stylesheet" href="/front_assets/css/main.css?v=5.6" />
    <link href="/front_assets/css/map.css" rel="stylesheet">
    <link rel="stylesheet" href="/front_assets/css/plugins/simple-lightbox.min.css">
		<script src="https://api-maps.yandex.ru/v3/?apikey=e0bf0d0f-97f7-4cb2-93b1-9cbc4d3436f0&lang=ru_RU">/*test*/</script>
		<script src="https://api-maps.yandex.ru/v3/?apikey=4636e874-8e53-42ab-8d33-526f7f85bded&lang=ru_RU"></script>
    <style>
			.dynamic-content {
				p {
					display: block !important;
				}
				img {
					display: block !important;
				}
				ol, ul {
					display: block !important;
					margin-block-start: 1em !important;
					margin-block-end: 1em !important;
					margin-inline-start: 0px !important;
					margin-inline-end: 0px !important;
					padding-inline-start: 40px !important;
					unicode-bidi: isolate !important;
				}
				ol {
					list-style-type: decimal !important;
				}
				ul {
					list-style-type: disc !important;
				}
			}
        .breadcrumb{
            display:flex;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .title-card-product{
            margin-top: 0;
        }
        .search-style-2{
            position: relative;
        }
        .search-results{
            display: none;
        }
        .search-results.with-results{
            display: block;
        }
        .search-results{
            position: absolute;
            background: white;
            z-index: 9;
            padding: 10px;
            border: 2px solid #ADE453;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
        }
        .search-product{
            display: block;
            border-bottom: 1px solid #eee;
            padding: 5px;
        }
        .search-product-img{
            width: 100%;
            height: 100px;
            width: 100px;
            object-fit: cover;
        }
        .search-product .product-details{
            margin-left: 15px;
        }

        /* новое мобильное меню старт */
        .mobile_menu_container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all 200ms;
            -moz-transition: all 200ms;
            transition: all 200ms;
            -webkit-transform: translateX(-300%);
            transform: translateX(-300%);
            overflow: hidden;
            z-index: 102;
            background: #fff;
        }
        .mobile_menu_container ul li ul {
            -webkit-transition: all 200ms;
            -moz-transition: all 200ms;
            transition: all 200ms;
        }
        .mobile_menu_container.loaded {
            -webkit-transform: translateX(0px);
            transform: translateX(0px);
        }
        .mobile_menu_container .mobile_menu_content {
            overflow: auto;
            max-height: 100%;
            padding-bottom: 0px;
        }
        .mobile_menu_container .mobile_menu_content .block-login .text-top {
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            letter-spacing: 0.25px;
            padding: 0 75px 0px 0;
            margin-bottom: 15px;
            color: black;
        }
        .mobile_menu_container .sub-title {
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            letter-spacing: 0.2px;
            color: gray;
        }
        .mobile_menu_container .list-menu {
            margin: 0;
            padding: 0;
        }
        .mobile_menu_container .list-menu .item-menu {
            list-style: none;
            padding: 0px 5px;
        }
        .mobile_menu_container .list-menu .item-menu .link {
            display: block;
            font-size: 16px;
            font-style: normal;
            font-weight: 550;
            line-height: 20px;
            letter-spacing: 0.15px;
            color: black;
            margin-bottom: 30px;
        }
        .mobile_menu_container .list-menu .item-menu .link:hover {
            color: red;
        }
        .mobile_menu_container .list-menu .item-menu .link:hover .icon {
            background: red;
        }
        .mobile_menu_container .list-menu .item-menu .link.parent {
            padding-right: 50px;
            background: url("/front_assets/imgs/chevronRight.svg") right 20px center no-repeat;
            background-size: 12px !important;
        }
        .mobile_menu_container .list-menu .item-menu .link.back {
            padding-left: 50px;
            background: url("/front_assets/imgs/chevronLeft.svg") left 0px center no-repeat;
            background-size: 12px !important;
            box-sizing: border-box;
            min-height: 50px;
            z-index: 110;
            position: relative;
        }
        .mobile_menu_container .list-menu .item-menu .sub-categories {
            -webkit-transform: translateX(-300%);
            transform: translateX(-300%);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 110;
            padding: 0px 15px;
        }
        .mobile_menu_container .list-menu .item-menu .sub-categories.loaded {
            -webkit-transform: translateX(0px);
            transform: translateX(0px);
        }
        .mobile_menu_container .list-menu .item-menu .sub-categories.activity {
            overflow-y: auto;
            overflow-x: hidden;
        }
        .menu-close {
            width: 30px;
            height: 30px;
            display: none;
            cursor: pointer;
            z-index: 101;
        }

        .header-mobile {
            position: fixed;
            width: 100%;
            top: 0;
            background: #FFFFFF;
            z-index: 9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.07);
        }

        .header-mobile::-webkit-scrollbar {
            width: 0;
        }

        .header-mobile .icon-chevron-left {
            width: 21px;
            height: 20px;
        }

        .header-mobile .logotip {
            width: 190px;
            height: 25px;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .header-mobile .icon-menu {
            width: 30px;
            height: 30px;
        }

        .header-mobile .icon-chevron-right {
            width: 20px;
            height: 20px;
        }

        .header-mobile .search-form {
            background: #FFF;
            position: absolute;
            top: 7%;
            left: 0;
            width: 100vw;
            padding: 5px;
            z-index: 9;
            display: none;
        }

        .header-mobile .search-form input[type=search] {
            width: 100%;
            padding: 9px;
            padding-left: 15%;
            border: 1px solid #ADE453;
            border-radius: 32px;
            background: #F5F7FB;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.15px;
        }

        .header-mobile .search-form input[type=search]:focus {
            border-color: #ADE453;
        }

        .header-mobile .search-form button {
            padding: 0;
            width: max-content;
            background: transparent;
            position: absolute;
            top: 55%;
            left: 12%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            border: none;
            cursor: pointer;
            z-index: 99;
        }

        .header-mobile .search-formMenu {
            top: 0%;
            z-index: 99999;
        }

        .header-mobile .content-menu__block-profile .img-profile {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .header-mobile .content-menu__block-profile .name-profile {
            font-size: 19px;
            font-style: normal;
            font-weight: 550;
            line-height: 24px;
            letter-spacing: 0.15px;
            color: #3A3A3A;
        }

        .header-mobile .content-menu__block-profile .number-profile {
            font-size: 13px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            letter-spacing: 0.25px;
            color: #99A2AD;
        }
        /* новое мобильное меню конец */
    </style>
    @yield('header')
</head>

<body>
<!-- Header start -->
<header class="header-area header-style-1 header-height-2">
    <!-- <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="header-info">
                        <ul>

                            @foreach($topMenus as $topMenu)
                                <li>
                                    <a href="{{ $topMenu['link'] }}">{{ $topMenu['label'] }} </a>




                                </li>
                            @endforeach


                            @auth
                                <li><a href="{{ route('front.profile') }}">Личный кабинет</a></li>
                                <li><a href="javascript:document.getElementById('logout-form').submit();" class="text-danger">Выйти</a></li>
                            @else
                                <li><a href="{{ route('signin') }}">Войти</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li><strong class="text-brand">{!! getValue('full_address') !!}</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('front.index')}}">
                      <img src="/front_assets/logo/logo.png" alt="logo" />
                    </a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="/search" id="header-search">
													<select name="c" class="select-active search_select">
														<option value="0" {{ (request('c') == 0 ? 'selected' : '') }}>Все категории</option>
														@foreach($product_categories as $productCategory)
															<option value="{{ $productCategory->id }}" {{ (request('c')== $productCategory->id ? 'selected' : '') }}>{{ $productCategory->name }}</option>
														@endforeach
													</select>
													<input type="text" name="q" class="search_input" @if(request()->has('q')) value="{{ request()->get('q') }}" @endif placeholder="Поиск товаров..." />
                        </form>
                        <div class="search-results">
                            <p>Начните поиск...</p>
                        </div>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
													<div class="header-action-icon-2">
														@auth
															<a href="{{ route('front.profile.favorites') }}" id="favorite-total-header">
																<img class="svgInject" alt="Lime-market favorite icon" src="/front_assets/imgs/lime/icons/favorite.png" />
																<span class="pro-count blue">{{ auth()->user()->products()->where('status', '!=', 5)->count() }}</span>
																<span class="text">Избранное</span>
															</a>
															<a href="{{ route('front.profile') }}">
																<img class="svgInject" alt="Nest" src="/front_assets/imgs/lime/icons/contact.png" />
																<span class="text">Профиль</span>
															</a>
															<div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
																<ul>
																	<li>
																		<a href="{{ route('front.profile') }}"><i class="fi fi-rs-user mr-10"></i>Личный кабинет</a>
																	</li>
																	<li>
																		<a href="{{ route('front.profile.orders') }}"><i class="fi fi-rs-label mr-10"></i>Мои заказы</a>
																	</li>
																	<li>
																		<a href="{{ route('front.userAddresses.index') }}"><i class=" fi fi-rs-marker mr-10"></i>Адреса доставки</a>
																	</li>
																	<li>
																		<a href="{{ route('front.profile.favorites') }}"><i class="fi fi-rs-heart mr-10"></i>Избранное</a>
																	</li>
																	<li>
																		<a href="{{ route('front.profile.settings') }}"><i class="fi fi-rs-settings-sliders mr-10"></i>Настройки</a>
																	</li>
																	<li>
																		<a href="javascript:document.getElementById('logout-form').submit();"><i class="fi fi-rs-sign-out mr-10"></i>Выход</a>
																	</li>
																</ul>
															</div>
														@else
															<a href="{{ route('signin') }}">
																<img class="svgInject" alt="LOGIN" src="/front_assets/imgs/lime/icons/contact.png" />
																<span class="text">Войти</span>
															</a>
															<a href="#">
																<img class="svgInject" alt="addres" src="/front_assets/imgs/lime/icons/map.png" />
																<span class="text">Адрес</span>
															</a>
														@endauth

														<a class="mini-cart-icon" href="{{ route('front.cart.index') }}" id="cart-total-header">
															<img alt="Lime-market cart icon" src="/front_assets/imgs/lime/icons/cart.png" />
															<span class="pro-count blue">{{ getCartCountTotal() }}</span>
															<span class="text">Корзина</span>
														</a>
													</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar d-none d-lg-block">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
									<a href="{{route('front.index')}}">
										<img src="/front_assets/logo/logo.png" alt="LIME-MARKET LOGO" />
									</a>
                </div>
                <div class="header-nav d-none d-lg-flex">

                    <!-- catalog -->
                    <div class="menu-catalog">

                        <!-- Menu -->



                            <nav class="navbar navbar-expand-lg navbar-dark p-0">

                                <!-- Nav Toggle Button -->

                                <button class="navbar-toggler my-2" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"

                                        aria-expanded="false" aria-label="Toggle navigation">

                                    <span class="navbar-toggler-icon"></span>

                                </button>

                                <!-- Nav Links -->

                                <div class="collapse navbar-collapse justify-content-center lh-lg" id="main_nav">
                                    <ul class="navbar-nav p-3 p-md-0">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/catalog">Каталог</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        <!-- Ends -->
                    </div>
                    <!-- catalog end -->
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                <li class="hot-deals"><img src="/front_assets/imgs/theme/icons/icon-hot.svg"alt="hot deals" /><a href="shop-grid-right.html">Акции</a></li>
                                <li><a href="{{ route('front.blog') }}">Блог</a></li>
                                @foreach($mainMenus as $menu)
                                    <li>
                                        <a href="{{ $menu['link'] }}">{{ $menu['label'] }} </a>
                                        @if($menu['child'])
                                            <i class="fi-rs-angle-down"></i>
                                            <ul class="sub-menu">
                                                @foreach( $menu['child'] as $child )
                                                    <li>
                                                        <a href="{{ $child['link'] }}">{{ $child['label'] }} @if($child['child']) <i class="fi-rs-angle-right"></i>@endif</a>
                                                        @if($child['child'])
                                                            <ul class="level-menu">
                                                                @foreach($child['child'] as $subChild)
                                                                    <li><a href="{{ $subChild['link'] }}">{{ $subChild['label'] }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex">
                    <img src="/front_assets/imgs/theme/icons/icon-headphone.svg" alt="hotline" />
                    <a href="tel:{!! getSecondValue('phone') !!}" class="sales-department-number">{!! getValue('phone') !!}<span>{!! getValue('phone_desc') !!}</span></a>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="/profile/favorites">
                                <img alt="Nest" src="/front_assets/imgs/theme/icons/icon-heart.svg" />
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="/cart">
                                <img alt="Nest" src="/front_assets/imgs/theme/icons/icon-cart.svg" />
{{--                                <span class="pro-count white">2</span>--}}
                            </a>

{{--                            <div class="cart-dropdown-wrap cart-dropdown-hm2">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <div class="shopping-cart-img">--}}
{{--                                            <a href="shop-product-right.html"><img alt="Nest"--}}
{{--                                                                                   src="/front_assets/imgs/shop/thumbnail-3.jpg" /></a>--}}
{{--                                        </div>--}}
{{--                                        <div class="shopping-cart-title">--}}
{{--                                            <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>--}}
{{--                                            <h3><span>1 × </span>&#8381;800.00</h3>--}}
{{--                                        </div>--}}
{{--                                        <div class="shopping-cart-delete">--}}
{{--                                            <a href="#"><i class="fi-rs-cross-small"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="shopping-cart-img">--}}
{{--                                            <a href="shop-product-right.html"><img alt="Nest"--}}
{{--                                                                                   src="/front_assets/imgs/shop/thumbnail-4.jpg" /></a>--}}
{{--                                        </div>--}}
{{--                                        <div class="shopping-cart-title">--}}
{{--                                            <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>--}}
{{--                                            <h3><span>1 × </span>&#8381;3500.00</h3>--}}
{{--                                        </div>--}}
{{--                                        <div class="shopping-cart-delete">--}}
{{--                                            <a href="#"><i class="fi-rs-cross-small"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <div class="shopping-cart-footer">--}}
{{--                                    <div class="shopping-cart-total">--}}
{{--                                        <h4>Total <span>&#8381;383.00</span></h4>--}}
{{--                                    </div>--}}
{{--                                    <div class="shopping-cart-button">--}}
{{--                                        <a href="shop-cart.html">View cart</a>--}}
{{--                                        <a href="shop-checkout.html">Checkout</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
							<a href="{{route('front.index')}}"><img src="/front_assets/logo/logo.png" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Поиск товаров" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        @foreach($mobileMainMenus as $mobileMainMenu)
                            <li>
                                <a href="{{ $mobileMainMenu['link'] }}">{{ $mobileMainMenu['label'] }} </a>
                                @if($mobileMainMenu['child'])
                                    <i class="fi-rs-angle-down"></i>
                                    <ul class="sub-menu">
                                        @foreach( $mobileMainMenu['child'] as $child )
                                            <li>
                                                <a href="{{ $child['link'] }}">{{ $child['label'] }} @if($child['child']) <i class="fi-rs-angle-right"></i>@endif</a>
                                                @if($child['child'])
                                                    <ul class="level-menu">
                                                        @foreach($child['child'] as $subChild)
                                                            <li><a href="{{ $subChild['link'] }}">{{ $subChild['label'] }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="/contacts"><i class="fi-rs-marker"></i> г. Краснодар, улица Красных Партизан 2/4 </a>
                </div>

                @auth
                    <div class="single-mobile-header-info">
                        <a href="{{ route('front.profile') }}"><i class="fi-rs-user"></i>Личный кабинет </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="javascript:document.getElementById('logout-form').submit();" class="text-danger"><i class="fi-rs-user"></i>Выйти</a>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST">@csrf</form>
                    </div>
                @else
                    <div class="single-mobile-header-info">
                        <a href="{{ route('signin') }}"><i class="fi-rs-user"></i>Войти</a>
                    </div>
                @endauth
                <div class="single-mobile-header-info ">
                    <a class="sales-department-number" href="tel:{!! getSecondValue('phone') !!}"><i class="fi-rs-headphones"></i>{!! getValue('phone') !!} </a>
                </div>
            </div>
            <div class="site-copyright">Все права защищены © Lime-market {{ date('Y') }}.</div>
        </div>
    </div>
</div>

<!-- новое мобильное меню старт -->
 <div class="header-mobile d-block d-lg-none">
        <div class="menu_container d-flex align-items-center justify-content-between p-2">
            <a href="javascript:clickMenu();" class="mobile_menu icon icon-menu">
                <img src="/front_assets/imgs/menu.svg" alt="">
            </a>

            <a href="/" class="logo-mobile">
                <img src="/front_assets/logo/logo.png" alt="">
            </a>

            <div class="search-icon">
                <form action="#" method="get" class=" align-items-center gap-1 search-form">
                    <span href="#">
                        <img src="/front_assets/imgs/chevronLeft.svg" class="icon icon-chevron-left back" alt="">
                    </span>
                    <button type="submit">
                        <img src="/front_assets/imgs/search.svg" class="icon icon-search" alt="">
                    </button>
                    <input type="search" name="search" placeholder="Поиск">
                </form>

                <img src="/front_assets/imgs/search.svg" class="icon icon-search open-search" alt="">

            </div>
        </div>
        <!-- топбар конец -->

        <!-- контент меню старт -->
        <div class="mobile_menu_container p-2">
            <div class="mobile_menu_content">

                <!-- топбар внутри МЕНЮ старт -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-close">
<!--                        <i class="icon icon-close "></i>-->
                        <img src="/front_assets/imgs/close.svg" class="icon icon-close" style="width: 20px" alt="">
                    </div>
                    <a href="{{route('front.index')}}" class="logo-mobile">
											<img src="/front_assets/logo/logo.png" alt="">
                    </a>

                    <div class="search-iconMenu">
                        <form action="#" method="get" class=" align-items-center gap-1 search-form search-formMenu">
<!--                            <i class="icon icon-chevron-left backMenu"></i>-->
<!--                            <button type="submit"><i class="icon icon-search"></i></button>-->
<!--                            <input type="search" name="search" placeholder="Поиск">-->

                            <img src="/front_assets/imgs/chevronLeft.svg" class="icon icon-search backMenu" style="width: 18px; margin-right: 10px;" alt="">
                            <button type="submit">
                                <img src="/front_assets/imgs/search.svg" class="icon icon-search" alt="">
                            </button>
                            <input type="search" name="search" placeholder="Поиск">
                        </form>

<!--                        <i class="icon icon-search"></i>-->
                        <img src="/front_assets/imgs/search.svg" class="icon icon-search open-searchMenu" alt="">
                    </div>
                </div>
                <!-- топбар внутри МЕНЮ конец -->

                <div class="block-login justify-content-start mt-4 mb-4">
                    <p class="text-top">Чтобы делать покупки, оставлять отзывы, и пользоваться персональными скидками.</p>
                    <div class="block-login__btns d-flex align-items-center justify-content-between gap-2">
                        <a href="#" class="btn btn-main w-50" >Вход</a>
                        <a href="#" class="btn btn-outline-main w-50">Регистрация</a>
                    </div>
                </div>

                <ul class="list-menu">
                    <li class="item-menu">
											<a class="link d-flex align-items-center gap-2" href="{{route('front.index')}}">Главная</a>
                    </li>
                    @foreach($product_categories as $productCategory)
											<li class="item-menu">
												<a href="{{ route('front.page.show', $productCategory->slug) }}" class="link parent">   {{ $productCategory->name }}</a>
													@if($productCategory->subProductCategories->count() > 0)
														@include('front.layouts.item-menu', ['categories' => $productCategory->subProductCategories, 'current' => $productCategory])
													@else
													@endif
											</li>
                    @endforeach

                    <hr class="hr mb-3">


                    <li class="item-menu">
                        <a class="link d-flex align-items-center gap-2" href="#">Вопросы и ответы</a>
                    </li>

                    <li class="item-menu">
                        <a class="link d-flex align-items-center gap-2" href="#">Доставка и оплата</a>
                    </li>

                    <hr class="hr mb-3">

                    <p class="sub-title ms-3 mb-3">Наш адрес </p>

                    <li class="item-menu">
                        <a class="link d-flex align-items-center gap-2" href="#">
                            г. Краснодар, улица Красных Партизан 2/4
                        </a>
                    </li>

                    <hr class="hr mb-3">

                    <div class="all-rights text-center mb-3" style="position: absolute;bottom: 0;width: 100%;left:0;">
                        Все права защищены © Lime-market 2024.
                    </div>

                </ul>
            </div>
        </div>
        <!-- контент меню конец -->

        <!-- бэкграунд для фона мобильного меню если не на всю ширину -->
        <div class="mobile_menu_overlay"></div>
    </div>
<!-- новое мобильное меню конец -->
<!--Header end-->
<main class="main pages">

    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('flash::message')
                @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif
            </div>
        </div>
    </div>

    @if(Route::current() !== null && Route::current()->getName() != 'front.index')
    <div class="container">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    @yield('breadcrumbs')
                </ol>
            </nav>
        </div>
    </div>
@endif
