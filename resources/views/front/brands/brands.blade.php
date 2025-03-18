@extends('front.layouts.app')
@section('page_title', $brand->getMetaTitle())
@section('meta_description', $brand->getMetaDesc())
@section('header')

@endsection
@section('content')
    <div class="container mb-30">

        <div class="archive-header-3 mt-30 mb-80" style="background-image: url(assets/imgs/vendor/vendor-header-bg.png)">
            <div class="archive-header-3-inner">
                <div class="vendor-logo vendor-logo-h1 mr-50">
                    <img class="vendor-logo-brand" src="{{ $brand->getCoverUrl() }}" alt="" />
                </div>
                <div class="vendor-content">
                    <h3 class="mb-5 text-white"><a href="vendor-details-1.html" class="text-white">{{ $brand->name }}</a></h3>
                    <div class="product-rate-cover mb-15">
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width: 90%"></div>
                        </div>
                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="vendor-des mb-15">
                                <p class="font-sm text-white">{!! $brand->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                @if($brand->collections()->count() > 0)
                <ul class="tags-list tags-list-btn">
                    @foreach($brand->collections()->get() as $collection)
                    <li class="hover-up">
                        <a href="#">{{ $collection->name }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p><strong class="text-brand">Найдено товаров: 16126</strong></p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Показать:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">Все</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Сортировка по:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Умолчанию <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Популярные</a></li>
                                    <li><a href="#">Новинки</a></li>
                                    <li><a href="#">Сначала дешевые</a></li>
                                    <li><a href="#">Сначала дорогие</a></li>
                                    <li><a href="#">По размеру скидки</a></li>
                                    <li><a href="#">Высокий рейтинг</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                             data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/dush.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Горящее</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Ванна</a>
                                </div>
                                <h2><a href="shop-product-right.html">Вместительная, удобная, элегантная.</a>
                                </h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                        <span class="font-small text-muted"><a
                                                href="vendor-details-1.html">Бренд</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;43 000</span>
                                        <span class="old-price">&#8381;32 800 </span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                             data-wow-delay=".2s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/vanna.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="sale">Распродажа</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Отопление</a>
                                </div>
                                <h2><a href="shop-product-right.html">Самые тёплые в вашем доме</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 80%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (3.5)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"><a
                                                    href="vendor-details-1.html">Бренд</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;52 085</span>
                                        <span class="old-price">&#8381;55 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 2-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                             data-wow-delay=".3s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="new">Новинка</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Смеситель</a>
                                </div>
                                <h2><a href="shop-product-right.html">Лучшие смесители</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 85%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Бренд</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;48 085</span>
                                        <span class="old-price">&#8381;52 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 3-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                             data-wow-delay=".4s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/wash-basin.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Климат</a>
                                </div>
                                <h2><a href="shop-product-right.html">Всё для климата </a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Бренд</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;17 085</span>
                                        <span class="old-price">&#8381;19 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 4 -->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/vanna.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Для дачи</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a>
                                </h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;54 085</span>
                                        <span class="old-price">&#8381;55 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 5-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".2s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/wash-basin.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Для бани</a>
                                </div>
                                <h2><a href="shop-product-right.html">Сантехника</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;32 085</span>
                                        <span class="old-price">&#8381;33 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 6-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".3s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/dush.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="sale">Распродажа</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Ванна</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая Ravak ХХХХХ</a>
                                </h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;35 085</span>
                                        <span class="old-price">&#8381;37 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 7-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".4s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/vanna.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Горящее</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted"> <a href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;23 085</span>
                                        <span class="old-price">&#8381;25 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 8-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 9-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card 10-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-none d-xl-block">
                        <div class="product-cart-wrap wow animate__animated animate__fadeIn"
                             data-wow-delay=".5s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="assets/imgs/lime/zerkalo.png" alt="" />
                                        <img class="hover-img" src="assets/imgs/lime/vanna2.png" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Добавить в избранное" class="action-btn"
                                       href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Быстрый просмотр" class="action-btn" data-bs-toggle="modal"
                                       data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Сантехника</a>
                                </div>
                                <h2><a href="shop-product-right.html">Акриловая ванна угловая
                                        Ravak ХХХХХ</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (2.0)</span>
                                </div>
                                <div>
                                            <span class="font-small text-muted"> <a
                                                    href="vendor-details-1.html">Ravak</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>&#8381;22 000</span>
                                        <span class="old-price">&#8381;24 008</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Купить </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                </div>
                <!--product grid-->
                @include('front.layouts.pagination')
                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar">
                <!-- Product sidebar Widget -->
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Каталог</h5>
                    <ul>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/santexnika.png"
                                                                 alt="" />Сантехника</a><span class="count">30</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/bathroom.png" alt="" />Мебель для
                                ванной</a><span class="count">35</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/accessories.png"
                                                                 alt="" />Аксессуары для ванной </a><span class="count">42</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/plitka.png"
                                                                 alt="" />Плитка</a><span class="count">68</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/ingener-santexnika.png"
                                                                 alt="" />Инженерная сантехника</a><span class="count">87</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/heating.svg"
                                                                 alt="" />Отопление</a><span class="count">87</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/climate.png"
                                                                 alt="" />Климат</a><span class="count">87</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/clear-water.png" alt="" />Очистка
                                воды</a><span class="count">87</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/for-giving.png" alt="" />Для
                                дачи</a><span class="count">87</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/for-bath.png" alt="" />Для
                                бани</a><span class="count">87</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets/icons/for-invalids.png" alt="" />Для
                                инвалидов</a><span class="count">87</span>
                        </li>
                    </ul>
                </div>
                <!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Подбор изделий по параметрам</h5>
                    <div class="price-filter">
                        <div class="price-filter-inner">
                            <div id="slider-range" class="mb-20"></div>
                            <div class="d-flex justify-content-between">
                                <div class="caption">От: &#x20bd;<strong id="slider-range-value1"
                                                                         class="text-brand"></strong></div>
                                <div class="caption">До: &#x20bd;
                                    <strong id="slider-range-value2"class="text-brand"></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group">
                        <div class="list-group-item mb-10 mt-10">
                            <label class="fw-900">Тип элемента</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox1" value="" />
                                <label class="form-check-label" for="exampleCheckbox1"><span>Комплект мебели (245)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox2" value="" />
                                <label class="form-check-label" for="exampleCheckbox2"><span>Тумба с раковиной (6785)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox3" value="" />
                                <label class="form-check-label" for="exampleCheckbox3"><span>Тумбы с раковиной-чашей(547)</span></label>
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox3" value="" />
                                <label class="form-check-label" for="exampleCheckbox3"><span>Зеркало(547)</span></label>
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox3" value="" />
                                <label class="form-check-label" for="exampleCheckbox3"><span>Зеркальный шкаф(547)</span></label>
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox3" value="" />
                                <label class="form-check-label" for="exampleCheckbox3"><span>Пенал(547)</span></label>
                            </div>
                            <label class="fw-900 mt-15">Способ установки</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox11" value="" />
                                <label class="form-check-label" for="exampleCheckbox11"><span>Напольная (1506)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox21" value="" />
                                <label class="form-check-label" for="exampleCheckbox21"><span>Подвесная (27)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                       id="exampleCheckbox31" value="" />
                                <label class="form-check-label" for="exampleCheckbox31"><span>Комбинированная (45)</span></label>
                            </div>
                        </div>
                    </div>
                    <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>Фильтр </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection

