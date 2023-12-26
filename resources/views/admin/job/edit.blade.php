@extends('admin.layouts.app')
@section('content')
<div class="d-flex justify-content-between">
    <h4>Job Edit Form</h4>
    <a href="{{route('jobs.index')}}" class="btn btn-sm btn-info mb-3">Back</a>
</div>
    <div class="card mt-3">
        <form action="{{route('jobs.update', $job->id)}}" method="POST">@csrf @method('put')
            <div class="card-body">
                <div class="mb-3">
                    <label for="category"><b>Category</b></label>
                    <select name="category_id" id="category" class="form-control">
                        <optgroup label="Select Category">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$job->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                    @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                    <div class="mb-3">
                        <label for="title"><b>Title</b></label>
                        <input type="text" value="{{old('title') ?? $job->title}}" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter job title">
                        @error('title')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>

                   <div class="mb-3">
                        <label for="description"><b>Description</b></label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter job description" rows="5">{{old('description') ?? $job->description}}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                   </div>

                    <div>     
                        <label for="salary"><b>Salary</b></label>
                        <input type="text" name="salary" id="salary" value="{{old('salary') ?? $job->salary}}" class="form-control @error('salary') is-invalid @enderror" placeholder="Enter salary">
                        @error('salary')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <input type="hidden" name='employer_id' value="{{Auth::user()->id}}">
            </div>
            <div class="card-footer border-0">
                <button class="btn btn-sm btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection