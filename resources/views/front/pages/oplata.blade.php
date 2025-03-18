@extends('front.layouts.app')
@section('page_title', $page->getMetaTitle())
@section('meta_description', $page->getMetaDesc())
@section('header')
    <style>
        .payments{
            border: 1px solid #F0F0F0;
        }
        .oplata-item{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            height: 300px;
            border-right: 1px solid #F0F0F0;
            padding-left: 20px;
        }
        .oplata-item b{
            font-weight: 700;
            font-size: 22px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .oplata-item p{
            margin-bottom: 80px;
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
                            <div class="single-page pr-30 mb-lg-0 mb-sm-5">
                                <div class="single-header style-2">
                                    <h2>{{ $page->name }}</h2>
                                </div>
                                <div class="single-content mb-30 payments">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="oplata-item">
                                                <b>Онлайн</b>
                                                <p>Безопасная оплата в личном<br>кабинете<br><br></p>
                                                <svg width="28" height="32" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7126 15.238C17.9205 15.238 21.3317 11.827 21.3317 7.61915C21.3317 3.41127 17.9205 0 13.7126 0C9.50473 0 6.09345 3.41127 6.09345 7.61915C6.09345 11.827 9.50473 15.238 13.7126 15.238ZM7.23801 18.2857H20.1906C24.1814 18.2857 27.4286 21.5329 27.4286 25.5237V30.8571C27.4286 31.488 26.9166 32 26.2857 32H1.14286C0.511998 32 0 31.488 0 30.8571V25.5237C0 21.5329 3.24721 18.2857 7.23801 18.2857Z" fill="black"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="oplata-item">
                                                <b>При получении</b>
                                                <p>Оплата наличными <br>или банковской картой <br>после осмотра товара</p>
                                                <img class="payment-services" src="/front_assets/imgs/theme/payment-services.jpg" alt="" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="oplata-item">
                                                <b>Рассчетный счет</b>
                                                <p>Для предпринимателей –<br>оплата на рассчетный счет <br>С НДС или без – на ваш выбор</p>
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28 25.9999H3.99997C1.79394 25.9999 0 27.7939 0 30V32H31.9999V30C31.9999 27.7939 30.206 25.9999 28 25.9999Z" fill="black"/>
                                                    <path d="M16 0L0 10V14H3.99997V24H9.99995V14H12.9999V24H18.9999V14H21.9999V24H27.9999V14H31.9999V10L16 0ZM16 5.99998C17.1046 5.99998 18 6.8954 18 8C18 9.10448 17.1046 10 16 10C14.8954 10 14 9.10448 14 8C14 6.8954 14.8953 5.99998 16 5.99998Z" fill="black"/>
                                                </svg>
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
    </div>
@endsection
@section('footer')

@endsection

