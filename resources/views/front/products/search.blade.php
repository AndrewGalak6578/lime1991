@foreach($products as $product)
<a href="{{ route('front.products.show', $product) }}" class="search-product">
    <div class="d-flex align-items-center">
            <img src="{{ $product->getCoverUrl() }}" class="search-product-img">
            <div class="product-details">
                <p class="mb-0 pb-0">{{ $product->name }}</p>
                <p>Артикул: {{ $product->code }}</p>
                <span>{{ $product->getPrice() }} ₽</span>
            </div>
    </div>
</a>
@endforeach

