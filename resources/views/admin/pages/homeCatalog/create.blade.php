@extends('admin.layouts.app')
@section('page_title', 'Добавить раздел каталога')
@section('page_name', 'Добавить раздел каталога')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.edit', 1) }}">Главная страница</a></li>
    <li class="breadcrumb-item active">Раздел каталога</li>
    <li class="breadcrumb-item active">Добавить</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pages.homeCatalogs.store') }}" method="POST"> @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="bg">Фон</label>
                            <select name="bg" id="bg" class="form-control">
                                <option value="bg-1">bg-1</option>
                                <option value="bg-2">bg-2</option>
                                <option value="bg-3">bg-3</option>
                                <option value="bg-4">bg-4</option>
                                <option value="bg-5">bg-5</option>
                                <option value="bg-6">bg-6</option>
                                <option value="bg-7">bg-7</option>
                                <option value="bg-8">bg-8</option>
                                <option value="bg-9">bg-9</option>
                                <option value="bg-10">bg-10</option>
                                <option value="bg-11">bg-11</option>
                                <option value="bg-12">bg-12</option>
                                <option value="bg-13">bg-13</option>
                                <option value="bg-14">bg-14</option>
                                <option value="bg-15">bg-15</option>
                            </select>
                        </div>
                        @for($i = 1; $i <= 15; $i++)
                            <span class="bg-{{$i}}">bg-{{$i}}</span>
                        @endfor
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            <button class="btn btn-outline-secondary btn-block mb-2" type="button" id="chooseCover">Выберите иконку</button>
                            <input type="text" class="form-control d-none" id="chooseCover_input" name="icon">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <div class="form-group">
                            <label for="link">Ссылка</label>
                            <input type="text" name="link"  class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <div class="form-group">
                            <label for="position">Позиция</label>
                            <input type="text" name="position" value="100" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Добавить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        fileManager('chooseCover', 'file', {prefix: '/admin/laravel-filemanager'}, 'chooseCover_input');
    </script>
@endsection
