@extends('admin.layouts.app')
@section('page_title', 'Редактировать заказ #'.$order->id)
@section('page_name', 'Редактировать заказ #'.$order->id)
@section('header')
    <style>
        .pr_image img{
            height: 100px;
            width: 100px;
            object-fit: cover;
        }
        .card-header{
            display: block;
            width: 100%;
        }
        .modal-body{
            padding: 10px;
        }
    </style>
    <link rel="stylesheet" href="/admin_assets/vendor/select2/css/select2.min.css">
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $order->id }}</li>
@endsection
@section('content')
  <div class="row">
      <div class="col-12">
          <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addProductModal">Добавить товар в заказ</button>
      </div>
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="mb-0">Информация по заказу</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-12 col-md-4">
                          <b>Стоимость товаров</b>
                          <p>{{ $order->amount }}₽</p>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-group">
                              <label for="delivery_price">Стоимость доставки <span class="text-danger">*</span></label>
                              <input type="text" name="delivery_price" value="{{ $order->delivery_price }}" required class="form-control">
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <b>Общая стоимость</b>
                          <p>{{ $order->getAllTotal() }}₽</p>
                      </div>
                      <div class="col-12">
                          <div class="form-group">
                              <label for="status">Статус <span class="text-danger">*</span></label>
                              <select name="status" id="status" required class="form-control">
                                  @for($i = 0; $i <= 6; $i++)
                                      <option @selected($i == $order->status) value="{{ $i }}">{{ orderStatuses($i) }}</option>
                                  @endfor
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-12">

          <div class="card ">
              <div class="card-header">
                          <h4 class="mb-0 ">Контакты и доставка</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-12 col-md-6 mb-3">
                          <div class="form-group">
                              <label for="name">Имя <span class="text-danger">*</span></label>
                              <input type="text" required name="name" value="{{ old('name', $order->name) }}" class="form-control">
                          </div>
                      </div>
                      <div class="col-12 col-md-6 mb-3">
                          <div class="form-group">
                              <label for="last_name">Фамилия <span class="text-danger">*</span></label>
                              <input type="text" required name="last_name" value="{{ old('last_name', $order->last_name) }}" class="form-control">
                          </div>
                      </div>
                      <div class="col-12 col-md-6 mb-3">
                          <div class="form-group">
                              <label for="phone">Телефон <span class="text-danger">*</span></label>
                              <input type="text" required name="phone" value="{{ old('phone', $order->phone) }}" class="form-control">
                          </div>
                      </div>
                      <div class="col-12 col-md-6 mb-3">
                          <div class="form-group">
                              <label for="email">Email <span class="text-danger">*</span></label>
                              <input type="email" required name="email" value="{{ old('email', $order->email) }}" class="form-control">
                          </div>
                      </div>
                      <div class="col-12 mb-3">
                          <div class="form-group">
                              <label for="full_address">Адрес доставки <span class="text-danger">*</span></label>
                              <input type="text" required name="full_address" value="{{ old('full_address', $order->full_address) }}" class="form-control">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-12">
          <div class="card ">
              <div class="card-header">
                  <h4 class="mb-0">Товары в заказе</h4>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                          <tr>
                              <th>Товар</th>
                              <th>Цена за ед.</th>
                              <th>Количество</th>
                              <th>Общая цена</th>
                              <th>Удалить</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($order->products()->get() as $product)
                              <tr>
                                  <td class="image product-thumbnail">
                                      <a href="{{ route('front.products.show', $product->product) }}" target="_blank">
                                          <div class="d-flex  align-items-center">
                                              <div class="pr_image">
                                                  <img src="{{ $product->product->getCoverUrl() }}" alt="#" class="mr-2">
                                              </div>
                                              <div class="pr_info pl-5">
                                                  <h6 class="w-160"><span class="text-heading">{{ $product->product->name }}</span></h6>
                                                  <p>{{ $product->product->code }}</p>
                                              </div>
                                          </div>
                                      </a>
                                  </td>
                                  <td>{{ $product->price }}&#x20bd;</td>
                                  <td>
                                      <h6 class="text-muted pl-20 pr-20">{{ $product->quantity }}</h6>
                                  </td>
                                  <td>
                                      <h4 class="text-brand">{{ $product->quantity*$product->price }}&#x20bd;</h4>
                                  </td>
                                  <td>
                                      <button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-12">
          <div class="form-group">
              <button class="btn btn-success">Сохранить</button>
          </div>
      </div>
  </div>
@endsection
@section('footer')
    <!-- Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Добавить товар в заказ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.orders.products.add', $order) }}" method="POST"> @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product_id">Найти товар <span class="text-danger">*</span></label>
                            <select name="product_id" id="product_id" class="form-control search-products"></select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Количество <span class="text-danger">*</span></label>
                            <input type="text" name="quantity" required class="form-control">
                        </div>
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

    <script src="/admin_assets/js/jquery.autocomplete.min.js"></script>
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
