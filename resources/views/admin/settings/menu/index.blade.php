@extends('admin.layouts.app')
@section('page_title', 'Настройки меню')
@section('page_name', 'Настройки меню')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="javascript:void(0)">Настройки</a></li>
    <li class="breadcrumb-item active">Меню</li>
@endsection
@section('content')
    {!! Menu::render() !!}
@endsection
@section('footer')
    {!! Menu::scripts() !!}
@endsection
