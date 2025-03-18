@extends('admin.layouts.app')
@section('page_title', 'Редактировать акцию')
@section('page_name', 'Редактировать акцию')
@section('header')
    <link rel="stylesheet" href="/admin_assets/vendor/select2/css/select2.min.css">
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.actions.index') }}">Акции</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $action->id }}</li>
@endsection
@section('content')

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="action-product" data-toggle="tab" data-target="#product" type="button" role="tab" aria-controls="product" aria-selected="true">Товары</button>
                    </li>
                    @if($action->type == 1)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="action-brands" data-toggle="tab" data-target="#brands" type="button" role="tab" aria-controls="brands" aria-selected="false">Бренды</button>
                        </li>
                    @endif
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="action-info" data-toggle="tab" data-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">Информация</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="products-tab">

                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRelated">
                                    Добавить товар</button>
                            </div>
                            <div class="col-12 mt-3">
                                <table class="table datatable">
                                    <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Артикул</th>
                                        <th>Цена</th>
                                        <th>Цена со скидкой</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($actionProducts as $actionProduct)
                                        <tr>
                                            <td>{{ $actionProduct->name }}</td>
                                            <td>{{ $actionProduct->code }}</td>
                                            <td>{{ $actionProduct->price }}</td>
                                            <td></td>
                                            <td>
                                                <form action="{{ route('admin.detachProduct') }}" method="POST" >@csrf
                                                    <input name="action_id" value="{{ $action->id }}" class="d-none">
                                                    <input name="product_id" value="{{ $actionProduct->id }}" class="d-none">
                                                    <button class="btn btn-danger btn-xs sharp"><i class="fa fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($action->type == 1)
                    <div class="tab-pane fade" id="brands" role="tabpanel" aria-labelledby="brands-tab">
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addbrands">
                                    Добавить бренд
                                </button>
                            </div>
                            <div class="col-12 mt-3">
                                <table class="table datatable">
                                    <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Размер скидки</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($actionBrands as $actionBrand)
                                        <tr>
                                            <td>{{ $actionBrand->brands->name }}</td>
                                            <td>{{ $actionBrand->value }}</td>
                                            <td>
                                                <button onclick="destroy('#delete-actionBrand-', '{{ $actionBrand->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                <form action="{{ route('admin.actionBrands.destroy', $actionBrand) }}" method="POST" id="delete-actionBrand-{{ $actionBrand->id }}">@csrf @method('delete')</form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    @endif
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <form action="{{ route('admin.actions.update', $action) }}" method="POST"> @csrf @method('put')
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <label for="name">Название <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $action->name }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="slug">Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" value="{{ $action->slug }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="short_description">Краткое описание</label>
                                    <textarea name="short_description" id="short_description" class="form-control">{{ $action->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="long_description">Полное описание</label>
                                    <textarea name="long_description" id="long_description" class="form-control">{{ $action->long_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="type">Тип <span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-control">
                                        <option @selected($action->type == 0)  value="0">Скидка % по товарам</option>
                                        <option @selected($action->type == 1)  value="1">Скидка по брендам</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="available_to">Доступен до</label>
                                    <input type="datetime-local" name="available_to" value="{{ $action->available_to }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">Статус</label>
                                    <select name="status" id="status" class="form-control">
                                        <option @selected($action->status == 1) value="1">Действительная</option>
                                        <option @selected($action->status == 2) value="2">Закрытая</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success">Сохранить</button>
                            </div>
                        </div>
                        </form>
                    </div>



                </div>

            </div>
        </div>

@endsection
@section('footer')
{{--    модальное окно добавление бренда начало--}}
    <div class="modal fade" id="addbrands" tabindex="-1" aria-labelledby="addbrandsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addbrandsLabel">Добавить бренд</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.actionBrands.store') }}" method="POST"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brand_id">Бренд <span class="text-danger">*</span></label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="value">Значение <span class="text-danger">*</span></label>
                            <input type="text" name="value" required class="form-control">
                        </div>
                        <div class="form-group d-none">
                            <label for="action_id">Акция</label>
                            <input type="text" name="action_id" value="{{ $action->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--модальное окно добавление бренда конец--}}
<div class="modal fade" id="addRelated" tabindex="-1" aria-labelledby="addRelatedLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRelatedLabel">Добавить товар в акцию</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.actions-attach-products') }}" method="POST"> @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_id">Найти товар <span class="text-danger">*</span></label>
                        <select name="product_id" id="product_id" class="form-control search-products"></select>
                        <input name="action_id" value="{{ $action->id }}" class="d-none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{--    модальное окно добавление товара начало--}}
{{--модальное окно добавление товара конец--}}
<script src="/admin_assets/vendor/select2/js/select2.full.min.js"></script>
<script src="/admin_assets/js/plugins-init/select2-init.js"></script>


<script>
    $('.search-products').select2({
        ajax: {
            url: '/api/products',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
        }
    });
</script>

@endsection
