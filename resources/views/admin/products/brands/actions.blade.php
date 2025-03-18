{{--<a href="#" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>--}}
<a href="{{ route('admin.products.brands.edit', $brand) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
<button onclick="destroy('#delete-brand-', '{{ $brand->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
<form action="{{ route('admin.products.brands.destroy', $brand) }}" method="POST" id="delete-brand-{{ $brand->id }}">@csrf @method('delete')</form>
