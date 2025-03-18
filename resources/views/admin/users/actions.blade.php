{{--<a href="#" class="btn btn-primary btn-xs sharp"><i class="fa fa-eye"></i></a>--}}
<a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
<button onclick="destroy('#delete-user-', '{{ $user->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
<form action="{{ route('admin.users.destroy', $user) }}" method="POST" id="delete-user-{{ $user->id }}">@csrf @method('delete')</form>
