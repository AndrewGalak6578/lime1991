@extends('admin.layouts.app')
@section('page_title', 'Страницы')
@section('page_name', 'Страницы')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Страницы</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Добавить страницу</a>
        </div>
        <div class="card-body">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->name }}</td>
                            <td>
                                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                                @if($page->type == 0)
                                <button onclick="destroy('#delete-page-', '{{ $page->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" id="delete-page-{{ $page->id }}">@csrf @method('delete')</form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')

@endsection
