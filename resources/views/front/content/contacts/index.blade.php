@extends('front.layouts.app')
@section('page_title', 'Контакты')
@section('page_desc', '')
@section('body_class', 'main-brands')
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Контакты</li>
@endsection
@section('header')
@endsection
@section('content')
  <div class="container">
		<div class="dynamic-content">
			{!! $page->html !!}
		</div>
		<div class="row">
			<div class="col-12 map-container" id="contacts-map" data-coords="{{ (isset($page->values['coordinates']) ? implode(',', $page->values['coordinates']) : '0,0') }}"></div>
		</div>
	</div>
@endsection
@section('footer')

@endsection
