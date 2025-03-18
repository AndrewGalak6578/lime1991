@extends('front.layouts.app')
@section('page_title', 'Блог')
@section('meta_description', 'Блог')
@section('breadcrumbs')
	<li class="breadcrumb-item active">Блог</li>
@endsection
@section('header')

@endsection
@section('content')
    <div class="container mb-30">
			<div class="row">
				@foreach ($articles as $article)
					@php
						$htmlAsText = html_entity_decode(strip_tags($article->html));
					@endphp
					<div class="col-12 mb-20">
						<div class='row'>
							<h3>{{ $article->name }}</h3>
							<span>{{ date('d-m-Y', strtotime($article->created_at)) }}</span>
						</div>
						<p>{{ mb_substr($htmlAsText, 0, 500) . (mb_strlen($htmlAsText) > 500 ? '...' : '') }}</p>
						<a href="{{ route('front.blog.article', $article) }}">Читать дальше</a>
					</div>
				@endforeach
			</div>
    </div>
@endsection
@section('footer')

@endsection

