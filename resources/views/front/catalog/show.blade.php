@extends('front.layouts.app')
@section('page_title', 'Каталог')
@section('meta_description', 'Страница каталога')
@section('header')
@endsection
@section('breadcrumbs')
	<li class="breadcrumb-item active" aria-current="page">Каталог</li>
@endsection
@section('content')
	<div class="catalog">
		<div class="container">
			<div class="row">
				<h2 class="catalog__title" >Каталог</h2>

				@foreach ($categories as $category)
					<div class="col-12 col-md-6 col-lg-3">
						<div class="catalog__card">
							<div class="image-catalog">
								<a href="{{ route('front.page.show', $category->slug) }}">
									<img class="image-catalog-item" src="{{($category->cover !== null ? $category->cover : '/front_assets/imgs/lime/no-image.jpeg')}}" alt="">
								</a>
							</div>
							<div class="catalog__category_title">
								<a class="catalog__category_title-item" href="{{ route('front.page.show', $category->slug) }}">{{$category->name}}</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
@section('footer')

@endsection

