@extends('admin.layouts.app')
@section('page_title', 'Редактировать страницу')
@section('page_name', 'Редактировать страницу')
@section('header')
    <style>
        .t-pc{
            height: 150px;
            width: 350px;
            object-fit: cover;
        }
        .t-mb{
            height: 150px;
            width: 150px;
            object-fit: cover;
        }
    </style>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $page->id }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pages.update', $page) }}" method="POST">@csrf @method('put')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" required value="{{ $page->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="slug">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" value="{{ $page->slug }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="view">View</label>
                            <input type="text" name="view" value="{{ $page->view }}"  class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Описание <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" cols="30" rows="10" class="editor">{!! $page->description !!}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="seo_title">Meta title</label>
                            <input type="text" name="seo_title" value="{{ old('seo_title', $page->seo_title) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="seo_description">Meta description</label>
                            <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control">{{ old('seo_description', $page->seo_description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="seo_breadcrumb">Название в хлебных крошках</label>
                            <input type="text" name="breadcrumb_name" value="{{ old('breadcrumb_name', $page->breadcrumb_name) }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if($page->slug == '/')
        @include('admin.pages.home')
    @endif


    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.pages.pageKeyValues.create', ['page_id'=>$page->id]) }}" class="btn btn-primary">Добавить ключ/значение</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Ключ</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($page->keyValues()->get() as $pageKeyValue)
                        <tr>
                            <td>{{ $pageKeyValue->name }}</td>
                            <td>{{ $pageKeyValue->key }}</td>
                            <td>
                                <a href="{{ route('admin.pages.pageKeyValues.edit', $pageKeyValue) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                                <button onclick="destroy('#delete-pageKeyValues-', '{{ $pageKeyValue->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.pages.pageKeyValues.destroy', $pageKeyValue) }}" method="POST" id="delete-pageKeyValues-{{ $pageKeyValue->id }}">@csrf @method('delete')</form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('footer')

@endsection
