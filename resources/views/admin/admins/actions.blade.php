{{--<a href="#" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>--}}
<a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
<button onclick="destroy('#delete-user-', '{{ $admin->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
<form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" id="delete-user-{{ $admin->id }}">@csrf @method('delete')</form>
