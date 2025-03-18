@extends('admin.layouts.app')
@section('page_title', 'Редактировать раздел каталога')
@section('page_name', 'Редактировать раздел каталога')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.edit', 1) }}">Главная страница</a></li>
    <li class="breadcrumb-item active">Раздел каталога</li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $homeCatalog->name }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pages.homeCatalogs.update', $homeCatalog) }}" method="POST"> @csrf @method('put')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $homeCatalog->name }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" name="description" value="{{ $homeCatalog->description }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="bg">Фон</label>
                            <select name="bg" id="bg" class="form-control">
                                @for($i = 1; $i <= 15; $i++)
                                <option @selected($homeCatalog->bg == 'bg-'.$i) value="bg-{{ $i }}">bg-{{ $i }}</option>
                                @endfor
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
                            <input type="text" class="form-control" id="chooseCover_input" value="{{ $homeCatalog->icon }}" name="icon">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <div class="form-group">
                            <label for="link">Ссылка</label>
                            <input type="text" name="link" value="{{ $homeCatalog->link }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <div class="form-group">
                            <label for="position">Позиция</label>
                            <input type="text" name="position" value="{{ $homeCatalog->position }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-success">Сохранить</button>
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
