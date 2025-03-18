@extends('front.layouts.app')
@section('page_title', '')
@section('meta_description', '')
@section('header')

@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Акции</li>
@endsection
@section('content')


    <div class="container mb-30">

        <div class="archive-header mb-30">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15">Товары акции</h1>
                </div>
            </div>
        </div>

        <div class="row product-grid">
            @foreach($promotion->products as $product)
                <div class="col-6 col-md-3">
                    @include('front.products.card', $product)
                </div>
            @endforeach
        </div>

    </div>

@endsection
@section('footer')

@endsection

