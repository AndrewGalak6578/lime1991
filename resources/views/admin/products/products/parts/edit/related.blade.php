<section>
    <table class="table">
        <thead>
            <tr>
                <th>Наименование</th>
                <th>Артикул</th>
                <th>Цена</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product->relatedProducts()->get() as $relatedProduct)
                <tr>
                    <td>{{ $relatedProduct->name }}</td>
                    <td>{{ $relatedProduct->code }}</td>
                    <td>{{ $relatedProduct->price }}</td>
                    <td>

                          <button onclick="javascript:document.getElementById('related-btn-{{ $relatedProduct->id }}').click();" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
