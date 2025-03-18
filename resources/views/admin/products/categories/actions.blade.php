{{--<a href="#" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>--}}
<a href="{{ route('admin.products.productCategories.edit', $productCategory) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
<button onclick="destroy('#delete-category-', '{{ $productCategory->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
<form action="{{ route('admin.products.productCategories.destroy', $productCategory) }}" method="POST" id="delete-category-{{ $productCategory->id }}">@csrf @method('delete')</form>
