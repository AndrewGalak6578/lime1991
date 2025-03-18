@extends('admin.layouts.app')
@section('page_title', 'Добавить акции')
@section('page_name', 'Добавить акции')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.actions.index') }}">Акции</a></li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <form action="{{ route('admin.actions.store') }}" method="POST"> @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="short_description">Краткое описание</label>
                            <textarea name="short_description"  class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="long_description">Полное описание</label>
                            <textarea name="long_description"  class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-4 ">
                        <div class="form-group">
                            <label for="type">Тип</label>
                            <select name="type" id="type" class="form-control">
                                <option value="0">Скидка % по товарам</option>
                                <option value="1">Скидка по брендам</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="available_to">Доступен до <span class="text-danger">*</span></label>
                            <input type="datetime-local" required name="available_to" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Действительная</option>
                                <option value="2">Закрытая</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('footer')

@endsection
