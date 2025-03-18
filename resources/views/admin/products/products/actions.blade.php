<a href="{{ route('front.products.show', $product) }}" target="_blank" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>
<a href="{{ route('admin.products.products.edit', $product) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
<button onclick="destroy('#delete-product-', '{{ $product->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
<form action="{{ route('admin.products.products.destroy', $product) }}" method="POST" id="delete-product-{{ $product->id }}">@csrf @method('delete')</form>
