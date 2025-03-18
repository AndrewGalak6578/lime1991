@extends('front.layouts.app')
@section('page_title', $page->getMetaTitle())
@section('meta_description', $page->getMetaDesc())
@section('header')
    <style>
        .warranty{
            border: 1px solid #F0F0F0;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: flex-start;
            height: 50%;
            width: 60%;

            padding-left: 20px;
        }
    </style>
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
                                <div class="single-content">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <h3>Условия возврата</h3>
                                            <p>От товара ненадлежащего качества – разбитых, недоукомплектованных изделий или товаров, не соответствующих описанию на сайте, – вы можете отказаться
                                                при приеме заказа.</p>

                                            <p>Если вы купили товар онлайн, его можно вернуть в течение 7 дней с момента получения.
                                                Мы примем у вас и товар надлежащего качества, если он не был подключен к коммуникациям
                                                и все его товарные свойства сохранены.
                                                Отлично, если вы сохранили сопроводительные документы, в том числе товарный и кассовый чеки. </p>


                                                <p>Для возврата товара позвоните  мы примем вашу заявку и подскажем, что делать дальше.
                                                 по телефону <a href="tel:{!! getSecondValue('phone') !!}" class="number-contact-waranty">{!! getValue('phone') !!}</a>
                                                мы примем вашу заявку и подскажем, что делать дальше.</p>

                                        </div>

                                        <div class="col-12 col-md-6">
                                            <h3>Гарантия</h3>
                                           <p> Товары на гарантии обслуживают сервисные центры производителей.
                                               Гарантийный срок на изделия устанавливают производители,
                                               и он отмечен в гарантийном талоне или инструкции.</p>

                                            <p>Перед отправкой товара мы всегда проверяем, есть ли в заказе сопроводительные документы.</p>


                                                <p>Если после покупки вы обнаружили дефект товара,
                                                    обратитесь к нам по номеру <a href="tel:{!! getSecondValue('phone') !!}" class="number-contact-waranty ">{!! getValue('phone') !!}</a> или
                                                    в сервисный центр производителя.</p>


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

