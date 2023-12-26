@extends('admin.layouts.app')
@section('content')
<div class="d-flex justify-content-between">
    <h4>Job Create Form</h4>
    <a href="{{route('jobs.index')}}" class="btn btn-sm btn-info mb-3">Back</a>
</div>
    <div class="card mt-3">
        <form action="{{url('admin/jobs')}}" method="POST">@csrf
            <div class="card-body">
                <div class="mb-3">
                    {{-- <h6>{{Auth::user()->name}}</h6> --}}
                    <label for="category"><b>Category</b></label>
                    <select name="category_id" id="category" class="form-control">
                            <option class="fw-bold">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                    </select>
                    @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                    <div class="mb-3">
                        <label for="title"><b>Title</b></label>
                        <input type="text" value="{{old('title')}}" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter job title">
                        @error('title')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>

                   <div class="mb-3">
                        <label for="description"><b>Description</b></label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter job description" rows="5">{{old('description')}}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                   </div>

                    <div>     
                        <label for="salary"><b>Salary</b></label>
                        <input type="text" name="salary" id="salary" value="{{old('salary')}}" class="form-control @error('salary') is-invalid @enderror" placeholder="Enter salary">
                        @error('salary')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="employer_id" value="{{Auth::user()->id}}">
            </div>
            <div class="card-footer border-0">
                <button class="btn btn-sm btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection