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
                    <option @selected(0 == $product->brand_id) value="0">Без бренда</option>
                    @foreach($brands as $brand)
                        <option @selected($brand->id == $product->brand_id) value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label class="text-label">Коллекция <span class="text-danger">*</span></label>
                <select name="collection_id"  class="brand-collection">
                    <option @selected(0 == $product->collection_id) value="0">Без коллекции</option>
                    @if($product->brand_id != 0)
                        @foreach($product->getBrand->collections()->get() as $collection)
                            <option @selected($collection->id == $product->collection_id) value="{{ $collection->id }}">{{ $collection->name }}</option>
                        @endforeach
                    @endif
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
                        <option @selected($product->hasCategory($category->id)) value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-12 col-md-6">
            <div class="form-group">
                <label class="text-label">Теги товара <span class="text-danger">*</span></label>
                <select name="tags[]" multiple class="js-data-example-ajax">
                    @foreach($product->getCategoriesTags() as $productTag)
                        <option @selected($product->hasTag($productTag->id)) value="{{ $productTag->id }}">{{ $productTag->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
</section>
