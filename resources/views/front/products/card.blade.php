<div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
     data-wow-delay=".1s">
    <div class="product-img-action-wrap">
        <div class="product-img product-img-zoom">
            <a href="{{ route('front.products.show', $product) }}">
                <img class="default-img" src="{!! $product->getCoverUrl() !!}" onerror="{{ ($product->getMedia('photos')->first()?->getUrl()) ?? '/default-product.jpeg' }}" alt="" />
            </a>
        </div>
        @auth
            <div class="product-action-1">
                <a aria-label="Добавить в избранное" class="action-btn"
                   href="javascript:addToFavorite({{ $product->id }});"><i class="fi-rs-heart"></i></a>
            </div>
        @endauth
        @if($product->labels != null)
            @foreach($product->labels as $label)
                <div class="product-badges product-badges-position product-badges-mrg">
                    <span class="hot">{{ getLabel($label)['name'] }}</span>
                </div>
            @endforeach
        @endif
    </div>
    <div class="product-content-wrap">
        <div class="product-category">
            <a href="{{ route('front.page.show', $product->categories[0]['id']) }}">{{ $product->categories[0]['name'] }}</a>
        </div>
        <h2><a href="{{ route('front.products.show', $product) }}">{{ $product->name }}</a>
        </h2>
        {{--                                <div class="product-rate-cover">--}}
        {{--                                    <div class="product-rate d-inline-block">--}}
        {{--                                        <div class="product-rating" style="width: 90%"></div>--}}
        {{--                                    </div>--}}
        {{--                                    <span class="font-small ml-5 text-muted"> (4.0)</span>--}}
        {{--                                </div>--}}
        <div>
            @if($product->brand_id != 0)
                <span class="font-small text-muted">{{ $product->brand['name'] }}</span>
            @endif
        </div>
        <div class="product-card-bottom">
            <div class="product-price">
                @if($product->getPrice() > 0)
                <span>{{ $product->getPrice() }} &#8381;</span>
                @endif
                    @if($product->promotion)
                        <span class="old-price">&#8381;{{$product->price}} с</span>
                    @endif
            </div>
            <div class="add-cart">
                <a class="add" href="{{ route('front.products.show', $product) }}"><i
                        class="fi-rs-shopping-cart mr-5"></i>Купить </a>
            </div>
        </div>
    </div>
</div>
