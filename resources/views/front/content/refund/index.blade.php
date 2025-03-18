@extends('front.layouts.app')
@section('page_title', 'Возврат')
@section('page_desc', '')
@section('body_class', 'main-brands')
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Возврат</li>
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
