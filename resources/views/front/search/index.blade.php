@extends('front.layouts.app')
@section('page_title', 'Поиск товаров')
@section('header')
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Поиск</li>
@endsection
@section('content')
    <div class="container mb-30">

        <div class="archive-header mb-30">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15">Поиск товаров</h1>
                </div>
            </div>
        </div>


                <div class="row product-grid">
                    @foreach($products as $product)
                        <div class="col-6 col-md-3">
                            @include('front.products.card', $product)
                        </div>
                    @endforeach
                </div>

        <div class="row">
            <div class="col-12">
                {!! $products->links('pagination::bootstrap-5') !!}
            </div>
        </div>
            </div>



@endsection
@section('footer')

@endsection




