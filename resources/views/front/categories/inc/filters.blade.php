<div class="mb-3">

    <button class="accordion-button accordion-btn mb-2" type="button"
            data-bs-toggle="collapse" data-bs-target="#item-filter-price"
            aria-expanded="false">
        Цена
    </button>
    <div class=" collapse show">
                <div class="d-flex align-items-center justify-content-around">
                    <div class="price-filter">
                        <div class="price-filter-inner">
                            <div class="slider-range-price mb-20" data-min="0" data-max="{{$ranges['price']['max']}}"></div>
                            <div class="d-flex justify-content-around align-items-center">
                                <div class="caption box-value">
                                    <input id="slider-range-value-min" class="text-brand" data-min="{{$data['price']['min'] ?? 0}}" value="{{$data['price']['min'] ?? 0}}" name="price[min]">
                                </div>
                                <div class="dash"></div>
                                <div class="caption box-value">
                                    <input id="slider-range-value-max" class="text-brand" data-max="{{$data['price']['max'] ?? $ranges['price']['max']}}" value="{{$data['price']['max'] ?? $ranges['price']['max']}}" name="price[max]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<!--  элемент фильтра (range slider) конец  -->
<div class="mb-3">
    <button class="accordion-button accordion-btn mb-2"
            type="button" data-bs-toggle="collapse"
            data-bs-target="#item-brands" aria-expanded="false">
        Бренды
    </button>
    <div id="item-brands"
         class=" collapse">

        <div class="group-checkboxes ">
            @foreach($brands as $brand)
                <div class="form-check ml-25 w-100">
                    <input class="form-check-input" type="checkbox"
                           {{--                                   @dd($data['filters'][$char->slug], $char->slug, in_array($charValue->value, $data['filters'][$char->slug]))--}}
                           @checked(in_array($brand->id, $data['brands'][$brand->id] ?? []))
                           name="brands[]"
                          @checked(in_array($brand->id,$data['brands'] ?? []))  value="{{ $brand->id }}"
                           id="charValue-{{ $brand->id }}">
                    <label class="form-check-label"
                           for="charValue-{{ $brand->id }}">
                        {{ $brand->name }}
                    </label>
                </div>
            @endforeach

        </div>

    </div>
</div>
@foreach($productCategory->chars()->where('show_in_filter', 1)->orderBy('type', 'desc')->get() as $char)
    @if($char->values()->count() <= 0) @continue @endif
    @if($char->type == 1)
        <!--  элемент фильтра (range slider) старт  -->
        <div class="mb-3">
            <button class="accordion-button accordion-btn mb-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#item-filter-price"
                    aria-expanded="false">
                {{ $char->name }}
            </button>
            <div class=" collapse show">
                <div class="d-flex align-items-center justify-content-around">
                    <div class="price-filter mb-3">
                        <div class="price-filter-inner">
                            <div class="slider-range-price mb-20" data-min="{{$ranges['filters'][$char->slug]['min-value'] ?? 0}}" data-max="{{$ranges['filters'][$char->slug]['max-value'] ?? 5000}}"></div>
                            <div class="d-flex justify-content-around align-items-center">
                                <div class="caption box-value">

                                    <input id="slider-range-value-min" data-min="{{$data['filters'][$char->slug]['min-value'] ?? 0}}"  name="filters[{{ $char->slug }}][min-value]" class="text-brand">
                                </div>
                                <div class="dash"></div>
                                <div class="caption box-value">
                                    <input id="slider-range-value-max" data-max="{{$data['filters'][$char->slug]['max-value'] ?? 2000}}"  name="filters[{{ $char->slug }}][max-value]"  class="text-brand">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  элемент фильтра (range slider) конец  -->
    @else

        <!--  элемент фильтра (checkboxes) старт  -->
        <div class="mb-3">
            <button class="accordion-button accordion-btn @if(!request()->has($char->slug))  collapsed @endif  mb-2"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#item-char-{{ $char->id }}" aria-expanded="false">
                {{ $char->name }}
            </button>
            <div id="item-char-{{ $char->id }}"
                 class=" collapse @if(request()->has($char->slug))  show @endif">

                <div class="group-checkboxes ">
                    @foreach($char->values()->orderByDesc('value')->get() as $charValue)
                        <div class="form-check ml-25 w-100">
                            <input class="form-check-input" type="checkbox"
{{--                                   @dd($data['filters'][$char->slug], $char->slug, in_array($charValue->value, $data['filters'][$char->slug]))--}}
                                   @checked(in_array($charValue->value, $data['filters'][$char->slug] ?? []))
                                   name="filters[{{ $char->slug }}][]"
                                   @if(request()->has($char->slug)) @checked(in_array($charValue->value, request()->get($char->slug))) @endif value="{{ $charValue->value }}"
                                   id="charValue-{{ $charValue->id }}">
                            <label class="form-check-label"
                                   for="charValue-{{ $charValue->id }}">
                                {{ $charValue->value }}
                            </label>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
        <!--  элемент фильтра (checkboxes) конец  -->

    @endif
@endforeach
