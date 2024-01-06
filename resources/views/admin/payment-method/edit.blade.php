@extends('admin.layouts.app')
@section('content')
<div class="d-flex justify-content-between">
    <h4>Payment Method Edit Form</h4>
    <a href="{{route('payment-methods.index')}}" class="btn btn-sm btn-info mb-3">Back</a>
</div>
    <div class="card mt-3">
        <form action="{{url('admin/payment-methods/'.$paymentMethod->id)}}" method="POST">@csrf @method('put')
            <div class="card-body">
                    <label for="name"><b>Name</b></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$paymentMethod->name}}">
                    @error('name')
                     <span class="invalid-feedback">{{$message}}</span>
                    @enderror
            </div>
            <div class="card-footer border-0">
                <button class="btn btn-sm btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
