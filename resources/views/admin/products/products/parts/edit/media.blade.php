<section>
    <div class="row">
        <div class="col-12 ">
            <b class="text-primary">Метки</b>
            <hr class="border-primary">
        </div>
        <div class="col-2">
            <div class="form-group">
                <input type="checkbox" id="sale" value="1" @checked(old('labels[]', $product->hasLabel(1))) name="labels[]">
                <label for="sale">Распродажа</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <input type="checkbox" id="hit" value="2" @checked(old('labels[]', $product->hasLabel(2))) name="labels[]">
                <label for="hit">Хит</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <input type="checkbox" id="new" value="3" @checked(old('labels[]', $product->hasLabel(3))) name="labels[]">
                <label for="new">Новинка</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <input type="checkbox" id="free_delivery" value="4" @checked(old('labels[]', $product->hasLabel(4))) name="labels[]">
                <label for="free_delivery">Бесплатная доставка</label>
            </div>
        </div>
        <div class="col-12 ">
            <b class="text-primary">Медия</b>
            <hr class="border-primary">
        </div>

        <div class="col-3">
            <img src="{{ $product->getCoverUrl() }}" class="media-img img-fluid">
        </div>
        <div class="col-5">
            <div class="form-group ">
                <label for="cover">Изменить обложку</label>
                <input type="file" name="cover"  class="form-control">
            </div>
            <div class="form-group ">
                <label for="cover">Добавить доп. фото</label>
                <input type="file" name="photos[]" multiple  class="form-control">
            </div>
        </div>
        <div class="col-12">
            <hr>
        </div>
        @foreach($product->getMedia('photos') as $photo)
            <div class="col-12 col-md-3" id="photo-block-{{ $photo->id }}">
                <div class="for-img">
                    <img src="{{ $photo->getUrl() }}" class="media-img img-fluid">
                </div>
                <div class="d-grid gap-1 mt-1">
                    <button type="button" data-photoId="{{ $photo->id }}" class="btn btn-danger w-100 deletePhoto">Удалить фото</button>
                </div>
            </div>
        @endforeach

    </div>

</section>
