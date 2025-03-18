@extends('admin.layouts.app')
@section('page_title', 'Страницы')
@section('page_name', 'Страницы')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pages.store') }}" method="POST">@csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Описание <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" cols="30" rows="10" class="editor"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary">Добавить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')

@endsection
