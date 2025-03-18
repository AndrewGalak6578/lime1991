@extends('front.layouts.app')
@section('page_title', $productCategory->getMetaTitle())
@section('meta_description', $productCategory->getMetaDesc())
@section('header')
@endsection
@section('breadcrumbs')

    @foreach ($productCategory->breadcrumbs() ?? [] as $breadcrumb)
        @if(!$loop->last)
            <li class="breadcrumb-item"><a href="{{ route('front.page.show', $breadcrumb->slug) }}">{{ $breadcrumb->name }}</a></li>
        @else
            <li class="breadcrumb-item active" aria-current="page">{{ $productCategory->name }}</li>
        @endif
    @endforeach

{{--    @if($productCategory->parent_id != 0)--}}
{{--        <li class="breadcrumb-item"><a--}}
{{--                    href="{{ route('front.page.show', $productCategory->parentCategory->slug) }}">{{ $productCategory->parentCategory->name }}</a>--}}
{{--        </li>--}}
{{--    @endif--}}
{{--    <li class="breadcrumb-item active" aria-current="page">{{ $productCategory->name }}</li>--}}
@endsection
@section('content')
    <div class="container mb-30">

        <div class="archive-header mb-30">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15">{{ $productCategory->name }}</h1>
                </div>
                <div class="col-xl-9 d-none d-xl-block">
                    <ul class="tags-list">
                        @foreach($productCategory->subProductCategories()->get() as $subProductCategory)
                            <li class="hover-up">
                                <a href="{{ route('front.page.show', ['slug'=>$subProductCategory->slug]) }}">{{ $subProductCategory->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <!-- кнопка модалки фильтров старт-->
                <button type="button" class="btn mb-3 mobile-button-filter w-100" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                    Показать фильтры
                </button>
                <!-- кнопка модалки фильтров конец-->
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p><strong class="text-brand">Найдено товаров: {{ $products->total() }}</strong></p>
                    </div>
                    <div class="sort-by-product-area">

                    </div>
                </div>
                <div class="row product-grid">
                    @foreach($products as $product)
                        <div class="col-6 col-md-3">
                            @include('front.products.card', $product)
                        </div>
                    @endforeach
                </div>
                <!--product grid-->
                <div class="row">
                    <div class="col-12">
                        {!! $products->appends(request()->all())->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar">
                <!-- Product sidebar Widget -->
            {{--                <div class="sidebar-widget widget-category-2 mb-30">--}}
            {{--                    <h5 class="section-title style-1 mb-30">Каталог</h5>--}}
            {{--                    <ul>--}}
            {{--                        @foreach($product_categories as $productCategory)--}}
            {{--                            <li>--}}
            {{--                                <a href="#"> <img src="{{ $productCategory->icon }}" alt="" />{{ $productCategory->name }}</a>--}}
            {{--                            </li>--}}
            {{--                        @endforeach--}}
            {{--                    </ul>--}}
            {{--                </div>--}}



            <!-- фильтр товаров ПК старт -->
                <div class="sidebar-widget price_range range mb-30 filter-desktop">
                    <form action="" method="GET">
                        <h5 class="section-title style-1 mb-30">Подбор изделий по параметрам</h5>

                        <div class="accordion" id="accordion-filter-desktop">
                            <!--  элемент фильтра (range slider) старт  -->
                            @include('front.categories.inc.filters')

                        </div>

                        <button type="submit" class="btn btn-sm mb-2 w-100"><i class="fi-rs-filter mr-5"></i>Применить
                            фильтры
                        </button>

                        <button type="reset" class="btn btn-sm btn-reset w-100">Сбросить фильтры</button>
                    </form>

                </div>
                <!-- фильтр товаров ПК конец -->


            <!-- <div class="sidebar-widget price_range range mb-30">
                <h5 class="section-title style-1">Подбор изделий по параметрам</h5>
                <form action="">
                <div class="list-group">
                    <div class="list-group-item mb-10">
                        @foreach($productCategory->chars()->where('show_in_filter', 1)->get() as $char)
                <label class="fw-900">{{ $char->name }}</label>
                        <div class="custome-checkbox">
                            @foreach($char->values()->get() as $charValue)
                    <input class="form-check-input" @checked((request()->has($char->slug) ? in_array($charValue->value, request()->get($char->slug, [])) : false )) id="char-value-{{ $charValue->id }}" type="checkbox" name="{{ $char->slug }}[]"  value="{{ $charValue->value }}" />
                            <label class="form-check-label" for="char-value-{{ $charValue->id }}"><span>{{ $charValue->value }}</span></label>
                            <br />
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>Фильтр </button>
                </form>
            </div> -->
            </div>
        </div>
    </div>

    <!--  модалка с фильтрами старт  -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5 " id="staticBackdropLabel">Подбор изделий по параметрам</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- фильтр товаров MOBILE старт -->
                    <div class="sidebar-widget price_range range mb-30 filter-mobile">

                        <form action="#">
                            <div class="accordion" id="accordion-filters-mobile">
                               @include('front.categories.inc.filters')
                            </div>


                            <button type="submit" class="btn btn-sm mb-2 w-100"><i class="fi-rs-filter mr-5"></i>Применить
                                фильтры
                            </button>

                            <button type="reset" class="btn btn-sm btn-reset w-100">Сбросить фильтры</button>
                        </form>


                    </div>
                    <!-- фильтр товаров MOBILE конец -->
                </div>
            </div>
        </div>
    </div>
    <!--  модалка с фильтрами конец  -->
@endsection
@section('footer')

    <script>
        $(".slider-range-price").each(function (key, item) {
           let itemJQ = $(item);
            var rangeSlider = this;
            var moneyFormat = wNumb({
                decimals: 0,
                thousand: ",",
                prefix: ""
            });
            console.log( $(rangeSlider).closest(".price-filter-inner").find("#slider-range-value-min").data('min') ?? 0)
            noUiSlider.create(rangeSlider, {
                start: [$(rangeSlider).closest(".price-filter-inner").find("#slider-range-value-min").data('min') ?? 0, $(rangeSlider).closest(".price-filter-inner").find("#slider-range-value-max").data('max') ?? 2000],
                step: 1,
                range: {
                    min: [itemJQ.data('min') ?? 0],
                    max: [itemJQ.data('max') ?? 5000]
                },
                format: moneyFormat,
                connect: true
            });

            // Set visual min and max values and also update value hidden form inputs
            rangeSlider.noUiSlider.on("update", function (values, handle) {
                $(rangeSlider).closest(".price-filter-inner").find("#slider-range-value-min").val(values[0]);
                $(rangeSlider).closest(".price-filter-inner").find("#slider-range-value-max").val(values[1]);
                // $(rangeSlider).closest(".price-filter-inner").find("input[name='min-value']").val(moneyFormat.from(values[0]));
                // $(rangeSlider).closest(".price-filter-inner").find("input[name='max-value']").val(moneyFormat.from(values[1]));
            });
        });
    </script>
@endsection




