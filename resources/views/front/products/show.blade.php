@extends('front.layouts.app')
@section('page_title', $product->getMetaTitle())
@section('meta_description', $product->getMetaDesc())
@section('header')
    <link rel="stylesheet" href="/front_assets/libs/fontawesome-free-6.3.0-web/css/all.min.css">

    <style>
        .modal-content .img-product .img-product_item {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /*слайдер старт*/
        .related-products .slider-products {
            position: relative;
        }

        .btn-slider {
            position: absolute;
            top: 50%;
            background: #efefef90;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            padding: 0;
            z-index: 99;
            border: none;
            color: #7E7E7E;
        }

        .btn-slider:hover {
            background: #efefef90 !important;
            border: none;
        }

        .related-products .slider-products .prev-arrow {
            left: 0;
        }

        .related-products .slider-products .next-arrow {
            right: 0;
        }

        /*слайдер конец*/

        /* подзаголовок с полосой по сторонам старт*/
        .sub-category {
            position: relative;
            margin: 0px;
            font-size: 12px;
            text-align: center;
            z-index: 1;
            padding: 10px !important;
            color: #161616;
        }

        .sub-category .sub-category_title {
            position: relative;
            padding: 0px 15px;
            z-index: 1;
            background-color: #ffffff;
            font-size: 17px;
            line-height: 100%;
            font-weight: 600;
        }

        .sub-category:before {
            content: "";
            display: block;
            width: 100%;
            height: 1px;
            position: absolute;
            bottom: 50%;
            left: 0;
            right: 0;
            z-index: 1;
            background: #d6d6d6;
        }

        /* подзаголовок с полосой по сторонам конец*/

        .product-cart-wrap .product-card-bottom .add-cart .add {
            width: 100%;
        }

        @media (max-width: 767px) {
            .related-products .product-cart-wrap .product-content-wrap {
                min-height: 240px !important;
            }
        }

        /*   строка fixed при прокрутке аксессуаров старт */
        #fixedDiv {
            display: none;
        }

        #scrollUp {
            bottom: 15px;
        }

        .fixed-line-product {
            display: flex !important;
            align-content: center;
            justify-content: space-between;
            height: 70px;
            width: 100%;
            background: #f3ffdf;
            padding: 10px;
            padding-right: 100px;
            position: fixed;
            bottom: 0px;
            z-index: 99;
            display: none;
        }

        .fixed-line-product .image-name {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .fixed-line-product .image-name .image-name_img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            padding-top: 10px;
        }

        .fixed-line-product .image-name .image-name_name {
            font-size: 16px;
            line-height: 100%;
        }

        .fixed-line-product .button-line {
            display: flex;
            align-items: center;
        }

        .fixed-line-product .button-line .btn-add {
            padding: 0px 10px;
            height: 40px;
            width: max-content;
        }

        @media (max-width: 991px) {
            #fixedDiv {
                display: none !important;
            }
        }

        @media (max-width: 767px) {
            .fixed-line-product {
                padding-right: 70px;
            }

            .fixed-line-product .image-name .image-name_name {
                font-size: 12px;
                line-height: 100%;
            }
        }

        /*   строка fixed при прокрутке аксессуаров конец */

        /*  кнопки с размерами (длина см:) tooltip с картинкой и ценой  */
        .product-dimensions .product-dimensions__name {
            margin-bottom: 10px;
        }

        .product-dimensions .product-dimensions__items_item {
            border: 1px solid #f5f7fa;
            padding: 10px;
            border-radius: 10px;
            position: relative;
        }

        .product-dimensions .item-active {
            border: 1px solid #FDC040;
            color: #FDC040;
        }

        .product-dimensions .product-dimensions__items_item:hover {
            border-color: #f6e0b1;
        }

        .product-dimensions .tooltip-item {
            display: none;
            position: absolute;
            top: -230px;
            left: -65px;
            width: 175px;
            height: 216px;
            padding: 15px;
            z-index: 99999;
            box-shadow: 2px 5px 10px 5px #f2f7ea;
            background: white;
            border-radius: 5px;
        }

        .product-dimensions .tooltip-item .product-img {
            width: 145px;
            height: 120px;
            object-fit: cover;
        }

        .product-dimensions .tooltip-item .fa-sort-down {
            font-size: 20px;
            color: #FFFFFF;

        }

        .product-dimensions .product-dimensions__items_item:hover .tooltip-item {
            display: block;
        }

        @media (max-width: 991px) {
            .product-dimensions {
                padding-left: 0 !important;
            }
        }

        @media (max-width: 767px) {
            .product-dimensions {
                text-align: center;
            }
        }

        /*  кнопки с размерами (длина см:) tooltip с картинкой и ценой конец  */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .radio-input {
            position: fixed;
            opacity: 0;
            pointer-events: none;
        }

        .radio-label {
            cursor: pointer;
            font-size: 0;
            color: rgba(0, 0, 0, 0.2);
            transition: color 0.1s ease-in-out;
        }

        .radio-label:before {
            content: "★";
            display: inline-block;
            font-size: 32px;
        }

        .radio-input:checked ~ .radio-label {
            color: #ffc700;
            color: gold;
        }

        .radio-label:hover,
        .radio-label:hover ~ .radio-label {
            color: goldenrod;
        }

        .radio-input:checked + .radio-label:hover,
        .radio-input:checked + .radio-label:hover ~ .radio-label,
        .radio-input:checked ~ .radio-label:hover,
        .radio-input:checked ~ .radio-label:hover ~ .radio-label,
        .radio-label:hover ~ .radio-input:checked ~ .radio-label {
            color: darkgoldenrod;
        }

        .average-rating {
            position: relative;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            color: transparent;
            width: auto;
            display: inline-block;
            vertical-align: baseline;
            font-size: 25px;
        }

        .average-rating::before {
            --percent: calc(4.3 / 5 * 100%);
            content: "★★★★★";
            position: absolute;
            top: 0;
            left: 0;
            color: rgba(0, 0, 0, 0.2);
            background: linear-gradient(90deg, gold var(--percent), rgba(0, 0, 0, 0.2) var(--percent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }


    </style>

@endsection
@section('breadcrumbs')
    @foreach($product->getCategoriesB() as $category)
        <li class="breadcrumb-item"><a href="{{route('front.page.show', $category->slug )}}">{{ $category->name }}</a>
        </li>
    @endforeach
    {{--    @foreach($product->getCategories() as $category)--}}

    {{--    <li class="breadcrumb-item"><a href="{{route('front.page.show', getCategory($category->id)->slug )}}">{{ $category->name }}</a></li>--}}
    {{--    @endforeach--}}
    <li class="breadcrumb-item active" aria-current="page">{{ $product->getBreadCrumbs() }}</li>
@endsection
@section('content')
    <div class="container">
        <div class="title-card-product">
            <div class="row">
                <div class="col-12">
                    <h2 class="title-detail">{{ $product->name }}</h2>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="product-detail-rating pt-5">
                        <div class="product-rate-cover text-end">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <a class="title-card-product__description" href="#">(0 отзыва)</a>

                            <div class="question d-inline-block">
                                <a class="title-card-product__description"
                                   href="#"><i class="fa-regular fa-comment-dots" style="color: #005bff;"></i>
                                    Отзывы</a>
                            </div>
                            @auth
                                <a class="title-card-product__description"
                                   href="javascript:addToFavorite({{ $product->id }});"><i class="fa-regular fa-heart"
                                                                                           style="color: #005bff;"></i>
                                    Избранное</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-right d-flex align-items-center justify-content-end flex-content-start">
                    <p class="product-code pb-10">Код товара: {{ $product->code }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-12 col-lg-12 m-auto">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-30 mt-30" style="transform:none;">

                                <div class="col-12 col-md-6">

                                    <div class="detail-gallery">


                                        <!-- MAIN SLIDES слайдер главный-->
                                        <div class="product-image-slider">

                                            <a href="{{ $product->getCoverUrl() }}">
                                                <figure class="border-radius-10 img-slider">
                                                    <img onerror="this.src='/default-product.jpeg'"
                                                         src="{{ $product->getCoverUrl() }}"
                                                         alt="{{ $product->getCoverAlt() }}"/>
                                                </figure>
                                            </a>


                                            @foreach($product->getMedia('photos') as $photo)
                                                <a href="{{ $photo->getUrl() }}">
                                                    <figure class="border-radius-10 img-slider">
                                                        <img onerror="this.src='/default-product.jpeg'"
                                                             src="{{ $photo->getUrl() }}" alt="{{ $product->name }}"/>
                                                    </figure>
                                                </a>
                                            @endforeach

                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div id="targetBlock" class="slider-nav-thumbnails">
                                            <div>
                                                <img 
                                                     src="{{ $product->getCoverUrl() }}"
                                                     alt="{{ $product->getCoverAlt() }}"/>
                                            </div>

                                            @foreach($product->getMedia('photos') as $photo)
                                                <div>
                                                    <img onerror="this.src='/default-product.jpeg'"
                                                         src="{{ $photo->getUrl() }}" alt="{{ $product->name }}"/>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>


                                </div>

                                <!-- End Gallery -->


                                <!-- centr block card product  -->


                                <div class="col-12 col-md-6">
                                    <div class="col-xl-3 primary-sidebar sticky-sidebar mt-30 d-lg-none">
                                        <div class="sidebar-widget widget-delivery mb-30 bg-grey-9 box-shadow-none">
                                            <div class="clearfix product-price-cover">
                                                <div class="product-price primary-color float-left">
                                                    <span class="current-price text-brand text-brand-standart-price">{{ $product->getPrice() }}&#x20bd;</span>

                                                </div>

                                            </div>
                                            <div class="detail-extralink detail-extralink-1">
                                                {{--                                                <div class="detail-qty border radius">--}}
                                                {{--                                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>--}}
                                                {{--                                                    <span class="qty-val">1</span>--}}
                                                {{--                                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>--}}
                                                {{--                                                </div>--}}
                                                <div class="product-extra-link2">
                                                    <button class="button button-add-to-cart  addToCart"
                                                            data-productID="{{ $product->id }}"><i
                                                                class="fi-rs-shopping-cart"></i>В корзину
                                                    </button>
                                                    @auth
                                                        <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                           href="javascript:addToFavorite({{ $product->id }});"><i
                                                                    class="fi-rs-heart"></i></a>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($product->brand_id != 0)
                                        <a href="{{ route('front.brands.show', $product->getBrand) }}"
                                           class="vendor-logo d-flex mb-20 vendor-logo-mb">
                                            <img onerror="this.src='/default-product.jpeg'"
                                                 src="{{ $product->getBrand->getLogoUrl() }}" class="brand-logo-img"
                                                 alt="{{ $product->getBrand->name }}"/>
                                            <p style="margin: 10px;"> {{ $product->getBrand->name }}</p>
                                        </a>
                                    @endif


                                    @if($product->hasLengthVariation() AND $product->collection_id != 0)
																			@php
																				$other = [];
																				foreach($product->getCollection->products()->where('product_type', 0)->get() as $collectionProduct) {
																					if ($collectionProduct->brand_id != $product->brand_id) continue;

																					if ($collectionProduct->hasCategory($product->getCategories()->first()->id)) {

																						$results = array_filter($collectionProduct->chars, function($char){return $char['name'] == 'Длина, см'|| $char['name'] == 'Длина';});
																						$results_2 = array_filter($collectionProduct->chars, function($char){return $char['name'] == 'Ширина, см'|| $char['name'] == 'Ширина';});
																						$results_3 = array_filter($collectionProduct->chars, function($char){return $char['name'] == 'Глубина, см'|| $char['name'] == 'Глубина';});
																						$results_4 = array_filter($collectionProduct->chars, function($char){return $char['name'] == 'Ориентация';});

																						$column_1 = array_column($results, 'value');
																						$column_2 = array_column($results_2, 'value');
																						$column_3 = array_column($results_3, 'value');
																						$column_4 = array_column($results_4, 'value');

																						if ((isset($column_1) || isset($column_2) || isset($column_3))) {
																							if (!isset($other['demention'])) $other['demention'] = [
																								'name' => 'Размеры, см',
																								'items' => [],
																							];
																							$other['demention']['items'][] = [
																								'product' => $collectionProduct,
																								'value' => implode('x', array_filter([reset($column_1), reset($column_2), reset($column_3)], function($val) {
																									return !empty($val);
																								})),
																							];
																						}
																						if (isset($column_4)) {
																							if (!isset($other['orientation'])) $other['orientation'] = [
																								'name' => 'Ориентация',
																								'items' => [],
																							];
																							$other['orientation']['items'][] = [
																								'product' => $collectionProduct,
																								'value' => reset($column_4),
																							];
																						}

																					}

																				}
																			@endphp
                                    <!-- кнопки с размерами (длина см:) tooltip с картинкой и ценой старт   -->
                                        <div class="product-dimensions mb-3 pl-30 w-100">
																					@foreach($other as $type)

                                            <p class="product-dimensions__name">{{$type['name']}}:</p>

                                            <div class="product-dimensions__items">

																							@foreach($type['items'] as $item)
																								<a href="{{ route('front.products.show', ['product'=>$item['product']]) }}"
																									 class="product-dimensions__items_item  d-inline-block mr-10 @if($product->id == $item['product']->id) item-active @endif">
																									{{ $item['value'] }}
																									<div class="tooltip-item text-center">
																											<div class="image">
																													<picture>
																															<img onerror="this.src='/default-product.jpeg'"
																																	 class="product-img"
																																	 src="{{ $item['product']->getCoverUrl() }}"
																																	 alt="">
																													</picture>
																											</div>

																											<hr class="attr-color">

																											<p>{{ $item['product']->getPrice() }} ₽</p>

																											<i class="fa-solid fa-sort-down "></i>

																									</div>
																								</a>
																							@endforeach

                                            </div>

																					@endforeach

                                        </div>
                                        <!-- кнопки с размерами (длина см:) tooltip с картинкой и ценой конец   -->
                                    @endif

                                    <div class="detail-info pr-30 pl-30">
                                        <div class="font-xs">
                                            @if($product->chars != null)
                                                <ul class="float-start ">
                                                    @foreach($product->chars as $char)
                                                        <li class="mb-5 characteristics">{{ $char['name'] }}
                                                            <div class="dotted"></div>
                                                            <span>{{ $char['value'] }}</span></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <div class="in-description-link mt-30">
                                                <a class="in-description-item" href="#Description-tab">Перейти к
                                                    описанию</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Detail Info -->
                                </div>


                            </div>
                            <div class="product-info">
                                <div class="tab-style3">
                                    <ul class="nav nav-tabs text-uppercase">
                                        <li class="nav-item @if($product->blockProducts()->count() == 0) active @endif">
                                            <a class="nav-link" id="Description-tab" data-bs-toggle="tab"
                                               href="#Description">Описание</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                               href="#Additional-info">Характеристики</a>
                                        </li>

                                        @if($product->blockProducts()->count() >= 1)
                                            <li class="nav-item">
                                                <a class="nav-link active" id="accessories-info-tab"
                                                   data-bs-toggle="tab"
                                                   href="#accessories-info">Аксессуары и доп. оборудование</a>
                                            </li>
                                        @endif

                                        <li class="nav-item">
                                            <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                               href="#Reviews">Отзывы</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <!-- контент таба description start -->
                                        <div class="tab-pane fade @if($product->blockProducts()->count() == 0) show active @endif"
                                             id="Description">
                                            <div id="just-for-description-block">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                        <!-- контент таба description end -->

                                        <!-- контент таба характеристики start -->
                                        <div class="tab-pane fade" id="Additional-info">
                                            @if($product->chars != null)
                                                <table class="font-md">
                                                    <tbody>
                                                    @foreach($product['chars'] as $char)
                                                        <tr class="folded-wo-wheels">
                                                            <th>{{ $char['name'] }}</th>
                                                            <td>
                                                                <p>{{ $char['value'] }}</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                        <!-- контент таба характеристики end -->

                                    @if($product->blockProducts()->count() >= 1)
                                        <!-- контент таба аксессуаров старт -->
                                            <div class="tab-pane fade show active" id="accessories-info">
                                                <div class="row mt-60">
                                                    <div class="col-12">
                                                        <div class="row related-products">

                                                            @foreach($groupedProducts as $m => $groups)

                                                                <p class="sub-category">
                                                                    <span class="sub-category_title">{{ $m }}</span>
                                                                </p>

                                                                <div class="slider-products">
                                                                    <button class="btn-slider prev-arrow prev-arrow-1">
                                                                        <i class="fa-solid fa-chevron-left"></i>
                                                                    </button>

                                                                    <div class="slick-accessories">
                                                                        @foreach($groups as $moreProudct)


                                                                            {{--                                                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6 d-flex align-items-stretch m-2 slick-slide slick-current slick-active">--}}
                                                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6 d-flex align-items-stretch m-2">

                                                                                <div class="product-cart-wrap mb-30">
                                                                                    <div class="product-img-action-wrap">
                                                                                        <div class="product-img product-img-zoom showMoreProductBtn"
                                                                                             data-moreProductID="{{ $moreProudct->id }}">
                                                                                <span>
                                                                                    <img onerror="this.src='/default-product.jpeg'"
                                                                                         class="default-img"
                                                                                         style="width:100%; height:150px; object-fit:contain;"
                                                                                         src="{{ $moreProudct->getCoverUrl() }}"
                                                                                         alt="">
                                                                                </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="product-content-wrap">
                                                                                        <div class="product-category showMoreProductBtn"
                                                                                             data-moreProductID="{{ $moreProudct->id }}">
                                                                                            <span>Арт.: {{ $moreProudct->code }}</span>
                                                                                        </div>
                                                                                        <h2 class="showMoreProductBtn"
                                                                                            data-moreProductID="{{ $moreProudct->id }}">
                                                                                            <span>{{ $moreProudct->name }}</span>
                                                                                        </h2>


                                                                                        <div class="d-none"
                                                                                             id="more-product-description-{{ $moreProudct->id  }}">
                                                                                            {!!  $moreProudct->description  !!}
                                                                                        </div>


                                                                                        <div class="product-card-bottom d-block">
                                                                                            <div class="product-price mb-2">
                                                                                                <span>{{ $moreProudct->getPrice() }} ₽</span>
                                                                                            </div>
                                                                                            <div class="add-cart">
                                                                                                <button class="button button-add-to-cart add border-0 addToCart"
                                                                                                        data-productID="{{ $moreProudct->id }}">
                                                                                                    Выбрать
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <!-- карточка продукта конец-->
                                                                        @endforeach
                                                                    </div>

                                                                    <button class="btn-slider next-arrow next-arrow-1">
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>

                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- контент таба аксессуаров конец -->
                                    @endif

                                    <!-- контент таба отзывов start -->
                                        <div class="tab-pane fade" id="Reviews">
                                            <!--Отзывы start-->
                                            <div class="comments-area">
                                                <div class="row">
                                                    @if($product->reviews()->where('status', 1)->count() > 0)
                                                        <div class="col-lg-8">
                                                            <h4 class="mb-30">Вопросы и ответы клиентов</h4>
                                                            <div class="comment-list">
                                                                @foreach($product->reviews()->where('status', 1)->get() as $review)
                                                                    <div
                                                                            class="single-comment justify-content-between d-flex mb-30">
                                                                        <div class="user justify-content-between d-flex">

                                                                            <div class="desc">
                                                                                <div
                                                                                        class="d-flex justify-content-between mb-10">
                                                                                    <div class="d-block">
                                                                                        <p class="font-heading text-brand">{{ $review->user->getFullName() }}</p>
                                                                                        <p
                                                                                                class="font-xs text-muted">{{ date('d-m-Y', strtotime($review->created_at)) }}</p>
                                                                                    </div>
                                                                                    <div
                                                                                            class="product-rate d-inline-block">
                                                                                        <div class="product-rating"
                                                                                             style="width: {{ $review->getReviewPercent() }}%"></div>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="mb-10">
                                                                                    {{ $review->review }}
                                                                                </p>
                                                                                @if($review->answer != null)
                                                                                    <div style="margin-left: 20px;">
                                                                                        <b>Ответ продавца</b>
                                                                                        <p>{{ $review->answer }}</p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h4 class="mb-30">Отзывы клиентов</h4>


                                                            {!! $product->rating() !!}

                                                        </div>
                                                    @else
                                                        <p>У данного товара пока нет отзывов на сайте.</p>
                                                    @endif
                                                </div>
                                                <!-- вопросы ответы отзывы конец -->
                                            </div>
                                            <!--comment form-->
                                            @if(auth()->check() AND auth()->user()->hasBoughtProduct($product->id) AND auth()->user()->hasNoReview($product->id))
                                                <div class="comment-form">
                                                    <h4 class="mb-15">Оставить отзыв</h4>
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12">
                                                            <form class="form-contact comment_form"
                                                                  action="{{ route('front.reviews.store') }}"
                                                                  id="commentForm" method="POST"> @csrf
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="star-rating">
                                                                            <input class="radio-input" type="radio"
                                                                                   required id="star5" name="rating"
                                                                                   value="5"/>
                                                                            <label class="radio-label" class for="star5"
                                                                                   title="5 stars">5 stars</label>

                                                                            <input class="radio-input" type="radio"
                                                                                   required id="star4" name="rating"
                                                                                   value="4"/>
                                                                            <label class="radio-label" for="star4"
                                                                                   title="4 stars">4 stars</label>

                                                                            <input class="radio-input" type="radio"
                                                                                   required id="star3" name="rating"
                                                                                   value="3"/>
                                                                            <label class="radio-label" for="star3"
                                                                                   title="3 stars">3 stars</label>

                                                                            <input class="radio-input" type="radio"
                                                                                   required id="star2" name="rating"
                                                                                   value="2"/>
                                                                            <label class="radio-label" for="star2"
                                                                                   title="2 stars">2 stars</label>

                                                                            <input class="radio-input" type="radio"
                                                                                   required id="star1" name="rating"
                                                                                   value="1"/>
                                                                            <label class="radio-label" for="star1"
                                                                                   title="1 star">1 star</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <textarea class="form-control w-100"
                                                                                      name="review" required id="rating"
                                                                                      cols="30"
                                                                                      rows="9"
                                                                                      placeholder="Ваш отзыв"></textarea>
                                                                            <input type="text" name="product_id"
                                                                                   value="{{ $product->id }}"
                                                                                   class="d-none">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                            class="button button-contactForm">Отправить
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- контент таба отзывов end -->
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-12">
                                    <h2 class="section-title style-1 mb-30">Похожие товары</h2>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @foreach($products as $similarProduct)
                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6 d-flex align-items-stretch">
                                                @include('front.products.card', ['product'=>$similarProduct])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 primary-sidebar sticky-sidebar mt-30 d-none d-lg-block">
                        <div class="sidebar-widget widget-delivery mb-35 bg-grey-9 box-shadow-none">
                            @if($product->status == 1 AND $product->getPrice() > 0)
                                <div class="clearfix product-price-cover mb-30">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand text-brand-standart-price">{{ $product->getPrice() }}&#x20bd;</span>
                                        {{--                                    <span class="old-price font-md ml-15 text-brand-old-price">45 390--}}
                                        {{--                                            &#x20bd;</span> //text-brand-new-price--}}
                                    </div>
                                    <!-- <div class="in-card-button">
                                        <a class="in-card-button-btn" href="#">Добавить в корзину</a>
                                    </div> -->

                                </div>
                            @endif
                            <div class="detail-extralink detail-extralink-1">
                                @if($product->getPrice() > 0)
                                    @if($product->status == 1)
                                        <div class="detail-qty border radius" id="main-qty">
                                            <a href="#" class="qty-down" data-productId="{{ $product->id }}"><i
                                                        class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val quantity-{{ $product->id }}">1</span>
                                            <a href="#" class="qty-up" data-productId="{{ $product->id }}"><i
                                                        class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button class="button button-add-to-cart addToCart main-text"
                                                    data-productID="{{ $product->id }}"><i
                                                        class="fi-rs-shopping-cart"></i>В корзину
                                            </button>
                                            <button onclick="goToCart()"
                                                    class="button button-add-to-cart d-none main-link"
                                                    data-productID="{{ $product->id }}"><i
                                                        class="fi-rs-shopping-cart"></i>Оформить
                                            </button>
                                            @auth
                                                <a aria-label="Добавить в избранное" class="action-btn hover-up"
                                                   href="javascript:addToFavorite({{ $product->id }});"><i
                                                            class="fi-rs-heart"></i></a>
                                            @endauth
                                        </div>
                                    @elseif($product->status == 2)
                                        <p class="font-size-20 text-warning">Под заказ</p>
                                    @elseif($product->status == 3)
                                        <p class="font-size-20 text-danger">Нет в наличии</p>
                                    @elseif($product->status == 4)
                                        <p class="font-size-20 text-danger">Товар снят с продажи</p>
                                    @endif
                                @else
                                    <p class="font-size-20 text-warning">Под заказ</p>
                                @endif

                            </div>
                        </div>


                    @if($product->relatedProducts()->where('status', '!=', 5)->count() > 0)
                        <!-- Product sidebar Widget -->
                            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                                <h5 class="section-title style-1 mb-30">Товары из комплекта</h5>
                                @foreach($product->relatedProducts()->where('status', '!=', 5)->get() as $relatedProduct)
                                    <div class="single-post clearfix">
                                        <div class="image">
                                            <img onerror="this.src='/default-product.jpeg'"
                                                 src="{{ $relatedProduct->getCoverUrl() }}"
                                                 alt="{{ $relatedProduct->getCoverAlt() }}"/>
                                        </div>
                                        <div class="content pt-10">
                                            <h6><a class="new-product-link"
                                                   href="{{ route('front.products.show', $relatedProduct) }}">{{ $relatedProduct->name }}</a>
                                            </h6>
                                            <p class="price mb-0 mt-5">&#x20bd; {{ $relatedProduct->getPrice() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('footer')
    @if($product->status == 1 AND $product->getPrice() > 0)
    <!--  строка при прокрутке аксессуаров старт -->
    <div id="fixedDiv">
        <div class="fixed-line-product">
            <div class="image-name ">
                <picture>

                    <a href="{{ $product->getCoverUrl() }}">

                        <img onerror="this.src='/default-product.jpeg'" class="image-name_img"
                             src="{{ $product->getCoverUrl() }}" alt="{{ $product->getCoverAlt() }}"/>

                    </a>
                </picture>
                <span class="image-name_name">
                   {{ $product->name }} на сумму: <strong
                            style="font-weight: 800;"> {{ $product->getPrice() }}&#x20bd;</strong>
            </span>

            </div>
            <div class="button-line">
                <button class="button button-add-to-cart addToCart" data-productID="{{ $product->id }}"><i
                            class="fi-rs-shopping-cart"></i>В корзину
                </button>
                {{--            <button  onclick="addToCart({{ $product->id }})" name="cart-button" type="button" class="btn-add"> В корзину</button>--}}

            </div>

        </div>
    </div>
    @endif
    <!--  строка при прокрутке аксессуаров конец -->

    <!-- Modal for card product start-->
    <div class="modal fade" id="modal-descr-product" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Просмотр</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-product-body">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal for card product end-->

    <script>


        $(document).ready(function () {

            $('.showMoreProductBtn').on('click', function () {

                let id = $(this).attr('data-moreProductID');


                const myModal = new bootstrap.Modal(document.getElementById('modal-descr-product'), options = null)

                $('#modal-product-body').empty();
                $('#modal-product-body').append($('#more-product-description-' + id).html());


                // const myModal = new bootstrap.Modal('#modal-descr-product', {})
                myModal.show();

            });

            $('.slick-accessories').slick({
                autoplay: false,
                slidesToShow: 4,
                arrows: true,
                prevArrow: '.prev-arrow-1',
                nextArrow: '.next-arrow-1',
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });

        });

        //     строка при прокрутке аксессуаров старт
        window.addEventListener("scroll", function () {
            // фиксированный блок (изначально скрыт)
            var fixedDiv = document.getElementById("fixedDiv");
            // блок с которого начнёт появляться скрытый див
            var block = document.getElementById("targetBlock");
            var blockOffset = block.offsetTop;

            if (window.pageYOffset >= blockOffset) {
                fixedDiv.style.display = "block";
            } else {
                fixedDiv.style.display = "none";
            }
        });
        //     строка при прокрутке аксессуаров конец

        // $('.addToCart').on('click', function (event) {
        //     // Get the product/service ID.
        //     var item = $(this).attr('data-productID');
        //
        //     $.post('/addToCart', {
        //         action: 'add',
        //         data: item
        //     }, 'json').done(function (response) {
        //         // Hide .add-to-cart and show .go-to-checkout
        //     });
        // });

        const starRatingForm = document.querySelector(".star-rating")

        const handleFormChange = (e) => {
            console.log(e.target.value)
            return e.target.value
        }

        starRatingForm.addEventListener("change", handleFormChange)
    </script>

@endsection



