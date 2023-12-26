@extends('admin.layouts.app')
@section('content')
<div class="d-flex justify-content-between">
    <h4>Category Create Form</h4>
    <a href="{{route('categories.index')}}" class="btn btn-sm btn-info mb-3">Back</a>
</div>
    <div class="card mt-3">
        <form action="{{route('categories.store')}}" method="POST">@csrf
            <div class="card-body">
                    <label for="name"><b>Name</b></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter category name">
                    @error('name')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
            </div>
            <div class="card-footer border-0">
                <button class="btn btn-sm btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection