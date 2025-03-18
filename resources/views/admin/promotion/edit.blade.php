@extends('admin.layouts.app')
@section('page_title', 'Редактировать акцию')
@section('page_name', 'Редактировать акцию')
@section('header')
    <link rel="stylesheet" href="/admin_assets/vendor/select2/css/select2.min.css">
    <link href="/admin_assets/vendor/jquery-steps/css/jquery.steps.css" rel="stylesheet">
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.promotion.index') }}">Акции</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $promotion->id }}</li>
@endsection
@section('content')
    <form action="{{ route('admin.promotion.update', $promotion) }}" enctype="multipart/form-data" method="POST"> @csrf @method('put')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{$promotion->name}}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="coupon_amount">Номинал в %</label>
                            <input type="number" name="discount" value="{{$promotion->discount}}" id="coupon_amount" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_id">Продукты </label>
                            <select name="product_ids[]" id="user_id" multiple class="form-control select2-userID">
                                @foreach($products as $key => $product)
                                    <option @selected($promotionProducts->find($key) ) value="{{$key}}">{{$product}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="img">Картинка</label>
                            <input type="file" name="img" id="img" class="form-control">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="available_until">Доступен до</label>
                            <input type="datetime-local" value="{{$promotion->available_until}}" name="available_until" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select name="status" id="status" class="form-control">
                                <option @selected($promotion->status == 1) value="1">Действительный</option>
                                <option @selected($promotion->status == 2) value="2">Не действительный</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="code">Описание <span class="text-danger">*</span></label>
                            <textarea name="description" required class="form-control">{{$promotion->description}}</textarea>
                        </div>
                    </div>


                    <div class="col-12">
                        <button class="btn btn-primary">Применить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('footer')
    <script src="/admin_assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="/admin_assets/js/plugins-init/select2-init.js"></script>

@endsection
