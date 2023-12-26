@extends('admin.layouts.app')
@section('content')

<div class="d-flex justify-content-between">
    <h4>News Create Form</h4>
    <a href="{{route('news.index')}}" class="btn btn-sm btn-info mb-3">Back</a>
</div>

    <div class="card mt-3">
        <form action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="title"><b>Title</b></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter news title">
                    @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description"><b>Description</b></label>
                    <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Enter news description"></textarea>
                    @error('description')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category"><b>News Category</b></label>
                    <select name="news_category_id" id="category" class="form-control">
                            <option>Select news category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label><b>Image</b></label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <input type="hidden" value="{{}}">
            </div>
            <div class="card-footer border-0">
                <button class="btn btn-sm btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection