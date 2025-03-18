@extends('front.layouts.app')
@section('page_title', 'Оплата')
@section('page_desc', '')
@section('body_class', 'main-brands')
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Оплата</li>
@endsection
@section('header')
@endsection
@section('content')
  <div class="container">
		<div class="dynamic-content">
			{!! $page->html !!}
		</div>
	</div>
@endsection
@section('footer')

@endsection
