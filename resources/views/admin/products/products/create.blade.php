@extends('admin.layouts.app')
@section('page_title', 'Добавить товар')
@section('page_name', 'Добавить товар')
@section('header')
    <link rel="stylesheet" href="/admin_assets/vendor/select2/css/select2.min.css">
    <link href="/admin_assets/vendor/jquery-steps/css/jquery.steps.css" rel="stylesheet">
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
{{--    <form action="{{ route('admin.products.products.store') }}" method="POST"> @csrf--}}
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data" action="{{ route('admin.products.products.store') }}" method="POST" id="add-product-form" class="step-form-horizontal"> @csrf
                                    <div>
                                        <h4>Основная информация</h4>
                                        @include('admin.products.products.parts.store.info')
                                        <h4>Бренд, категория и теги</h4>
                                        @include('admin.products.products.parts.store.brand_and_categories')
                                        <h4>Характеристики</h4>
                                        @include('admin.products.products.parts.store.chars')
                                        <h4>Медия</h4>
                                        @include('admin.products.products.parts.store.media')
                                        <h4>SEO</h4>
                                        @include('admin.products.products.parts.store.seo')
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


@endsection
@section('footer')
    <script src="/admin_assets/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="/admin_assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/admin_assets/js/plugins-init/jquery-steps-init.js"></script>
    <script src="/admin_assets/js/jquery.autocomplete.min.js"></script>
    <script src="/admin_assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="/admin_assets/js/plugins-init/select2-init.js"></script>
    <script>
       
        $('body').on('change', '#status', function(){
           if($(this).val() == 1){
               $('#amount').removeAttr('disabled');
           }else{
               $('#amount').attr('disabled', 'true');
           }
        });
    </script>
@endsection
