@extends('front.layouts.app')
@section('page_title', $page->getMetaTitle())
@section('page_desc', $page->getMetaDesc())
@section('body_class', 'main-brands')
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">{{ $page->getBreadCrumbs() }}</li>
@endsection
@section('header')
    <style>
        .brand-item{
            border: 1px solid #eee;
            margin: 10px;
            text-align: center;
            padding: 5px;
        }
        .brand-item img{
            width: 100%;
            height: 100px;
            object-fit: contain;
        }

        .brand-item .name-brand{
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12">
            <h2 class="sub-title-brands pt-50 pb-50">Бренды</h2>
            </div>
            @php $currentLetter = ''; @endphp
            @foreach($brands as $brand)
                @php $firstLetter = mb_substr($brand->name, 0, 1); @endphp
                @if($firstLetter !== $currentLetter)
                <div class="col-12">
                    <span class="sort-properties">{{ strtoupper($firstLetter) }}</span>
                    @php $currentLetter = $firstLetter; @endphp
                </div>
                @endif
                <div class="col-6 col-md-2">
                    <div class="brand-item">
                        <a href="{{ route('front.brands.show', $brand) }}">
                            <picture>
                                <img src="{{ $brand->logo }}" onerror="this.src='https://png.pngtree.com/thumb_back/fh260/background/20200821/pngtree-simple-dark-red-solid-color-wallpaper-image_396557.jpg'" alt="{{ $brand->name }}">
                            </picture>
                            <span class="name-brand">{{ $brand->name }}</span>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
@section('footer')

@endsection
