
@if($status == 1)
    <span class="stock-status in-stock mb-0"> В наличии </span>
@elseif($status == 2)
    <span class="stock-status out-stock mb-0"> Под заказ </span>
@elseif($status == 3)
    <span class="stock-status out-stock mb-0"> Нет в наличии </span>
@elseif($status == 4)
    <span class="stock-status out-stock mb-0"> Снят с продажи </span>
@elseif($status == 5)
    <span class="stock-status out-stock mb-0"> Нет в наличии </span>
@endif
