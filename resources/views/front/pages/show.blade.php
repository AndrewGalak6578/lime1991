@extends('front.layouts.app')
@section('page_title', $page->getMetaTitle())
@section('meta_description', $page->getMetaDesc())
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">{{ $page->getBreadCrumbs() }}</li>
@endsection
@section('content')
    <div class="page-content pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single-page pr-30 mb-lg-0 mb-sm-5">
                                <div class="single-header style-2">
                                    <h2>{{ $page->name }}</h2>
                                </div>
                                <div class="single-content mb-50">
                                    {!! $page->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection

