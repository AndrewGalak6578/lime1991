@extends('front.layouts.app')
@section('page_title', '')
@section('meta_description', '')
@section('header')

@endsection
@section('content')
    <main class="main page-404">
        <div class="page-content pt-30 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">
                        <p class="mb-20"><img src="front_assets/imgs/page/page-404.png" alt="" class="hover-up" /></p>
                        <h1 class="display-2 mb-30">Страница не найдена!</h1>
                        <p class="font-lg text-grey-700 mb-30">
                            Возможно вы ввели не правильный адрес или ссылка была удалена. <br>
                            Воспользуйтесь поиском или перейдите на
                            <a href="index.html"> <span> Главную.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('footer')

@endsection

