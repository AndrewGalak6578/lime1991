{{--<a href="#" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>--}}
<a href="{{ route('admin.callmes.edit', $callme) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
<button onclick="destroy('#delete-callme-', '{{ $callme->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
<form action="{{ route('admin.callmes.destroy', $callme) }}" method="POST" id="delete-callme-{{ $callme->id }}">@csrf @method('delete')</form>
