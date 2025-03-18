@extends('admin.layouts.app')
@section('page_title', 'Добавить значение')
@section('page_name', 'Добавить значение')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Товары</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.chars.index') }}">Характеристики</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.chars.index', ['category_id'=>$char->category_id]) }}">{{ $char->category->name }}</a></li>
    <li class="breadcrumb-item">Значения</li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')

@endsection
@section('footer')

@endsection
