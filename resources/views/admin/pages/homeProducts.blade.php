@extends('admin.layouts.app')
@section('page_title', 'Товары на главной')
@section('page_name', 'Товары на главной')
@section('header')
    <link rel="stylesheet" href="/admin_assets/vendor/select2/css/select2.min.css">
    <link href="/admin_assets/vendor/jquery-steps/css/jquery.steps.css" rel="stylesheet">
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.edit', 1) }}">Главная страница</a></li>
    <li class="breadcrumb-item active">Товары</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary"  data-toggle="modal" data-target="#addProductForBlock">Добавить товар</button>
        </div>
        <div class="card-body">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($blocks as $block)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($loop->first) active @endif" id="block-{{ $block->id }}-tab" data-toggle="tab" data-target="#block-{{ $block->id }}" type="button" role="tab" aria-controls="block-{{ $block->id }}" aria-selected="true">{{ $block->name }}</button>
                </li>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                @foreach($blocks as $block)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="block-{{ $block->id }}" role="tabpanel" aria-labelledby="block-{{ $block->id }}-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($block->products()->get() as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.home.products.detach', $product) }}" method="POST"> @csrf
                                        <button class="btn btn-danger sharp btn-xs"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <!-- Modal -->
    <div class="modal fade" id="addProductForBlock" tabindex="-1" aria-labelledby="addProductForBlockLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить товар</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.home.products.store') }}" method="POST"> @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="block_id">Выберите блок <span class="text-danger">*</span></label>
                        <select name="block_id" id="block_id" class="form-control">
                            @foreach($blocks as $block)
                                <option value="{{ $block->id }}">{{ $block->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_id">Найти товар <span class="text-danger">*</span></label>
                        <select name="product_id" id="product_id" class="select2-products"></select>
{{--                        <input type="text" name="product_name" class="form-control select2-products">--}}
{{--                        <input type="text" name="product_id" id="add_related_product_id" class="form-control d-none">--}}
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
{{--    <script src="/admin_assets/js/plugins-init/select2-init.js"></script>--}}
    <script>

        $('.select2-products').select2({
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

        // $('.select2-products').autocomplete({
        //     serviceUrl: '/api/products',
        //     data: function (params) {
        //         return {
        //             q: $.trim(params.term)
        //         };
        //     },
        //     transformResult: function(response) {
        //         console.log(response);
        //         return {
        //             suggestions: $.map(JSON.parse(response), function(dataItem) {
        //
        //                 return { value: dataItem.name, data: dataItem.id };
        //             })
        //         };
        //     },
        //     onSelect: function (suggestion) {
        //         // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        //         $('#add_related_product_id').val(suggestion.data);
        //     }
        // });
    </script>

@endsection
