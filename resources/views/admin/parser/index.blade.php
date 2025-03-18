@extends('admin.layouts.app')
@section('page_title', 'Парсер')
@section('page_name', 'Парсер')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item">Парсер</li>
@endsection
@section('content')
    <div class="card">
        <!-- <div class="card-header">
            <a href="{{ route('admin.parser.parsing') }}" class="btn btn-primary">Начать парсинг</a>
        </div> -->
        <div class="card-body">
            <a href="{{ route('admin.parser.parsing') }}" class="btn btn-primary">Начать парсинг</a>
        </div>
    </div>
@endsection
@section('footer')
@endsection
