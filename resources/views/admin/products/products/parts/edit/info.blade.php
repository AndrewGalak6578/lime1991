<section>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="text-label">Название товара <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ $product->name }}" required class="form-control" >
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="text-label">SLUG <span class="text-danger">*</span></label>
                <input type="text" name="slug" value="{{ $product->slug }}" required class="form-control" >
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="code">Артикул</label>
                <input type="text" name="code" value="{{ $product->code }}" class="form-control">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="price">Цена <span class="text-danger">*</span></label>
                <input type="text" name="price" value="{{ $product->price }}" required class="form-control">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="status">Статус товара <span class="text-danger">*</span></label>
                <select name="status" id="status" required class="form-control">
                    <option @selected($product->status == 1) value="1">В наличии</option>
                    <option @selected($product->status == 2) value="2">Под заказа</option>
                    <option @selected($product->status == 3) value="3">Нет в наличии</option>
                    <option @selected($product->status == 4) value="4">Снят с продажи</option>
                    <option @selected($product->status == 5) value="5">Скрыть</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="amount">Количество на складе </label>
                <input type="text" @disabled($product->status != 1) name="amount" value="{{ $product->amount }}" id="amount" class="form-control">
            </div>
        </div>
        <div class="col-12">
            <input type="checkbox" @checked($product->product_type ==1) name="product_type" id="product_type">
            <label for="product_type">Товар является дополнением</label>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description" cols="30" rows="10" class="editor">{!! $product->description !!}</textarea>
            </div>
        </div>
    </div>
</section>
