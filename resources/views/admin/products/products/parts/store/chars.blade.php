<section>
    <div class="row">
{{--        <div class="col-12 ">--}}
{{--            <b class="text-primary">Общие характеристики</b>--}}
{{--            <hr class="border-primary">--}}
{{--        </div>--}}
{{--        @foreach($chars as $char)--}}
{{--            <div class="col-4">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="char-{{ $char->id }}">{{ $char->name }}</label>--}}
{{--                    <input type="text" name="char_value_{{ $char->id }}" data-charID="{{ $char->id }}" class="form-control findChar">--}}
{{--                    <input type="text" name="char_id_{{ $char->id }}" value="{{ $char->id }}" class="d-none">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
        <div class="col-12 ">
            <b class="text-primary">Характеристики выбранных категорий</b>
            <hr class="border-primary">
        </div>
    </div>
    <div class="row" id="selected_category_chars">

    </div>
</section>
