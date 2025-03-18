@extends('front.layouts.app')
@section('page_title', $article->name)
@section('meta_description', $article->name)
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('front.blog')}}">Блог</a></li>
	<li class="breadcrumb-item active" aria-current="page">{{ $article->name }}</li>
@endsection
@section('header')

@endsection
@section('content')
    <div class="container mb-30">
			{!! $article->html !!}
    </div>
@endsection
@section('footer')

@endsection

