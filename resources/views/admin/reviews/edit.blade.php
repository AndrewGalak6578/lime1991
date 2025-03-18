@extends('admin.layouts.app')
@section('page_title', 'Редактировать отзыв')
@section('page_name', 'Редактировать отзыв')
@section('header')

@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Отзывы</a></li>
    <li class="breadcrumb-item active">Редактировать</li>
    <li class="breadcrumb-item active">{{ $review->id }}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.reviews.update', $review) }}" method="POST">@csrf @method('put')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="rating">Оценка <span class="text-danger">*</span></label>
                            <select name="rating" id="rating" required class="form-control">
                                @for($i = 1;$i <= 5; $i++)
                                    <option @selected($review->rating == $i) value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="review">Отзыв <span class="text-danger">*</span></label>
                            <textarea name="review" id="review" required cols="30" rows="5" class="form-control">{{ $review->review }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="answer">Ответ</label>
                            <textarea name="answer" id="answer" cols="30" rows="5" class="form-control">{{ $review->answer }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select name="status" id="status" class="form-control">
                                <option @selected($review->status == 0) value="0">Не опубликовано</option>
                                <option @selected($review->status == 1) value="1">Опубликовано</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')

@endsection
