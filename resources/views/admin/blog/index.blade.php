@extends('admin.layouts.app')
@section('page_title', 'Блог')
@section('page_name', 'Блог')
@section('header')
@endsection
@section('breadcrumbs')
	<li class="breadcrumb-item active">Блог</li>
@endsection
@section('content')
	<div class="card">
		<div class="card-header">
			<a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Добавить статью</a>
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
					@foreach($articles as $article)
						<tr>
							<td>{{ $article->name }}</td>
							<td>
								<a href="{{ route('admin.blog.edit', $article) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
								<button onclick="destroy('#delete-article-', '{{ $article->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
								<form action="{{ route('admin.blog.destroy', $article) }}" method="POST" id="delete-article-{{ $article->id }}">@csrf @method('delete')</form>
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
