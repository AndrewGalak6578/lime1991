@extends('front.layouts.app')
@section('page_title', $page->getMetaTitle())
@section('meta_description', $page->getMetaDesc())
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">{{ $page->getBreadCrumbs() }}</li>
@endsection
@section('content')
    <div class="page-content pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single-page pr-30 mb-lg-0">
                                <div class="single-header style-2">
                                    <h2>{{ $page->name }}</h2>
                                </div>
                                <div class="single-content payments">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="contacts-item">
                                                <b>Адрес:</b>
                                                <p>г. Краснодар, улица Красных Партизан 2/4</p>

                                                <b>Режим работы:</b>
                                                <p>пн-вс: 9.00-20.00</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="contacts-item">
                                                <b>Телефон:</b>
                                                <a href="tel:{!! getSecondValue('phone') !!}" class="number-contact mt-1">{!! getValue('phone') !!}</a>

                                                <b>E-mail:</b>
                                                <p><a href="mailto:{!! getValue('email') !!}" class="number-contact">{!! getValue('email') !!}</a></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="contacts-item">
                                                <p>  <b> ИП Иванькова Елена Геннадьевна</b></p>


                                                <p> ИНН: 233907705228</p>
                                                <p> ОГРНИП: 321237500102502</p>

                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="contacts-item">
                                                <p>БИК Банка: 046015207</p>
                                                <p>р/с: 40802810226020011743</p>
                                                <p> Банк: АО "АЛЬФА-БАНК" Филиал "Ростовский"</p>






                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <iframe class="map-navigation-lg"
                                                    src="https://yandex.ru/map-widget/v1/?um=constructor%3Aa0428c215a68f764f3d67f2ae73f97f45df0eb907e6e8d6db9158a184971e492&source=constructor"
                                                    width="100%" height="400" frameborder="0">

                                            </iframe>

                                            <iframe class="map-navigation-mobile"
                                                    src="https://yandex.ru/map-widget/v1/?um=constructor%3Ad16616564ece4009bd5f608cc75f1328b2414877525bf961e05668a48d00658c&source=constructor"
                                                    width="100%" height="400" frameborder="0">

                                            </iframe>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection

