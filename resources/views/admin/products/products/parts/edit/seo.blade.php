<section>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="seo_title">Meta title</label>
                <input type="text" name="seo_title" value="{{ old('seo_title', $product->seo_title) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="seo_description">Meta description</label>
                <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control">{{ old('seo_description', $product->seo_description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="seo_breadcrumb">Название в хлебных крошках</label>
                <input type="text" name="breadcrumb_name" value="{{ old('breadcrumb_name', $product->breadcrumb_name) }}" class="form-control">
            </div>
        </div>
    </div>
</section>
