@extends('admin.layouts.app')
@section('page_title', 'Отзывы')
@section('page_name', 'Отзывы')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">Отзывы</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Товар</th>
                    <th>Пользователь</th>
                    <th>Оценка</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td><a href="{{ route('admin.products.products.edit', $review->product) }}">{{ $review->product->name }}</a></td>
                        <td><a href="{{ route('admin.users.edit', $review->user) }}">{{ $review->user->getFullName() }}</a></td>
                        <td>{{ $review->rating }}</td>
                        <td>
                            @if($review->status == 0)
                                <button class="btn btn-secondary btn-xs ">Не опубликован</button>
                            @else
                                <button class="btn btn-success btn-xs ">Опубликован</button>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                            <button onclick="destroy('#delete-page-', '{{ $review->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" id="delete-page-{{ $review->id }}">@csrf @method('delete')</form>
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
