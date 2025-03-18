@extends('front.layouts.app')

@if (isset($brand))
	@section('page_title', $brand->getMetaTitle())
	@section('meta_description', $brand->getMetaDesc())
@else
	@section('page_title', 'Бренды')
	@section('meta_description', '')
@endif

@php
$collection = null;
$collection = $brands;
@endphp

@section('breadcrumbs')
	@if (isset($brand))
		<li class="breadcrumb-item"><a href="/brands">Бренды</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ $brand->getBreadCrumbs() }}</li>
	@else
		<li class="breadcrumb-item active">Бренды</li>
	@endif
@endsection
@section('header')

@endsection
@section('content')
    <div class="container mb-30">

				@if (isset($brand))
					<div class="archive-header-3 mt-30 mb-30" style="background-image: url('{{ $brand->getCoverUrl() }}'); background-size: cover">
							<div class="archive-header-3-inner">
									<div class="vendor-logo vendor-logo-h1 mr-50">
											<img class="vendor-logo-brand" src="{{ $brand->logo }}" alt="" />
									</div>
									<div class="vendor-content">
											<h3 class="mb-5 text-white"><a href="#" class="text-white">{{ $brand->name }}</a></h3>
	{{--                    <div class="product-rate-cover mb-15">--}}
	{{--                        <div class="product-rate d-inline-block">--}}
	{{--                            <div class="product-rating" style="width: 90%"></div>--}}
	{{--                        </div>--}}
	{{--                        <span class="font-small ml-5 text-muted"> (4.0)</span>--}}
	{{--                    </div>--}}
											<div class="row">
													<div class="col-lg-6">
															<div class="vendor-des mb-15">
																	<p class="font-sm text-white">{!! $brand->description_3 !!}</p>
															</div>
													</div>
											</div>
									</div>
							</div>
					</div>
				@endif
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
							@if($brands->count() > 0)
								<ul class="tags-list tags-list-btn">
									@php
									$activeElement = null;
									if (isset($brand)) {
										foreach ($brands as $key => $_brand) {
											if ($_brand->name == $brand->name) {
												$activeElement = $brands->splice($key, 1)->first();
												break;
											}
										}
									}
									@endphp
									@if ($activeElement)
										<li class="hover-up active">
											<a href="{{ route('front.brand.show', $activeElement) }}">{{ $activeElement->name }}</a>
										</li>
									@endif
									@foreach($brands->take(10) as $collection)
										<li class="hover-up">
											<a href="{{ route('front.brand.show', $collection) }}">{{ $collection->name }}</a>
										</li>
									@endforeach
								</ul>
								@if($brands->count() > 10)
									<div class="accordion" id="accordionExample">
										<div class="accordion-item">
											<div id="collapse-brands" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
												<ul class="tags-list tags-list-btn">
													@foreach($brands->skip(10) as $collection)
														<li class="hover-up">
															<a href="{{ route('front.brand.show', $collection) }}">{{ $collection->name }}</a>
														</li>
													@endforeach
												</ul>
											</div>
											<button id="btn-more-brands" class="btn-more-brands collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-brands" aria-expanded="false" aria-controls="collapse-brands">
													Показать больше
											</button>
										</div>
									</div>
								@endif
							@endif

							@if (isset($brand))
								@php
									$brand_categories = $brand->getCategories();
								@endphp
								@if(count($brand_categories) > 0)
									<ul class="top-category-list">
										@php
											$category_id = request('category');
											$activeElement = null;
											foreach ($brand_categories as $key => $category) {
												if ($category['id'] == $category_id) {
													$activeElement = current(array_splice($brand_categories, $key, 1));
													break;
												}
											}
										@endphp
										@if ($activeElement)
											<li class="active">
												<a href="?{{http_build_query(["category" => $activeElement['id']])}}">{{$activeElement['name']}}</a><span class="count">{{$activeElement['count']}}</span>
											</li>
										@endif
										@foreach (array_slice($brand_categories, 0, 9) as $category)
											<li>
												<a href="?{{http_build_query(["category" => $category['id']])}}">{{$category['name']}}</a><span class="count">{{$category['count']}}</span>
											</li>
										@endforeach
									</ul>
									@if(count($brand_categories) > 10)
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<div id="collapse-categories" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
													<ul class="top-category-list">
														@foreach (array_slice($brand_categories, 10) as $category)
															<li>
																<a href="?{{http_build_query(["category" => $category['id']])}}">{{$category['name']}}</a><span class="count">{{$category['count']}}</span>
															</li>
														@endforeach
													</ul>
												</div>
												<button id="btn-more-categories" class="btn-more-brands collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-categories" aria-expanded="false" aria-controls="collapse-categories">
														Показать больше
												</button>
											</div>
										</div>
									@endif
								@endif
							@endif

                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p><strong class="text-brand">Найдено товаров: {{ $products->total() }}</strong></p>
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
                    @foreach($products as $product)
                    <div class="col-6 col-md-3">
                        @include('front.products.card', $product)
                    </div>
                    @endforeach
                    <!--end product card-->
                </div>
                <!--product grid-->
            <div class="row">
                <div class="col-12">
                    {!! $products->links('pagination::bootstrap-5') !!}
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
                <!-- Fillter By Price -->
                <!-- <div class="sidebar-widget price_range range mb-30">
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
                </div> -->
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection

