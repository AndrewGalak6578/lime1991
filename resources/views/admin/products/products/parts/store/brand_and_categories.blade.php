<section>
    <div class="row">

        <div class="col-12 ">
            <b class="text-primary">Бренд и коллекция</b>
            <hr class="border-primary">
        </div>


        <div class="col-12 col-md-6">
            <div class="form-group">
                <label class="text-label">Бренд <span class="text-danger">*</span></label>
                <select name="brand_id" id="brand" class="multi-select">
                    <option value="0">Без бренда</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label class="text-label">Коллеция <span class="text-danger">*</span></label>
                <select name="collection_id"  class="brand-collection">
                    <option value="0">Без коллекции</option>
                </select>
            </div>
        </div>


        <div class="col-12 ">
            <b class="text-primary">Категория и теги</b>
            <hr class="border-primary">
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label class="text-label">Категории товара <span class="text-danger">*</span></label>
                <select name="categories[]" multiple id="categories" class="multi-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-12 col-md-6">
            <div class="form-group">
                <label class="text-label">Теги товара <span class="text-danger">*</span></label>
                <select name="tags[]" multiple class="js-data-example-ajax">
                    @foreach($categories->first()->tags()->get() as $productTag)
                        <option value="{{ $productTag->id }}">{{ $productTag->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
</section>
