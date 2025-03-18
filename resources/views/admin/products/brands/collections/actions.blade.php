{{--<a href="#" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>--}}
<a href="{{ route('admin.products.brandCollections.edit', $brandCollection) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
<button onclick="destroy('#delete-brand-', '{{ $brandCollection->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
<form action="{{ route('admin.products.brandCollections.destroy', $brandCollection) }}" method="POST" id="delete-brand-{{ $brandCollection->id }}">@csrf @method('delete')</form>
