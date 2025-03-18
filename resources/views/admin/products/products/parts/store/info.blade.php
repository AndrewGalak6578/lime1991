<section>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="text-label">Название товара <span class="text-danger">*</span></label>
                <input type="text" name="name" required class="form-control" >
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="code">Артикул <span class="text-danger">*</span></label>
                <input type="text" name="code" required class="form-control">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="price">Цена <span class="text-danger">*</span></label>
                <input type="text" name="price" required class="form-control">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="status">Статус товара <span class="text-danger">*</span></label>
                <select name="status" id="status" required class="form-control">
                    <option value="1">В наличии</option>
                    <option value="2">Под заказа</option>
                    <option value="3">Нет в наличии</option>
                    <option value="4">Снят с продажи</option>
                    <option value="5">Скрыть</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="amount">Количество на складе </label>
                <input type="text" name="amount" id="amount" class="form-control">
            </div>
        </div>
        <div class="col-12">
            <input type="checkbox" name="product_type" id="product_type">
            <label for="product_type">Товар является дополнением</label>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description" cols="30" rows="10" class="editor"></textarea>
            </div>
        </div>
    </div>
</section>
