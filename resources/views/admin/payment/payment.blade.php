@extends('admin.layouts.app')
@section('content')

@if(auth()->user()->payment && auth()->user()->active === 0)
    <div class="alert alert-success">Your request is submited, pls wait for the admin confirmation !!</div>
@elseif(auth()->user()->payment && auth()->user()->active === 1)
    <div class="alert alert-success">Your are authenticated, feel free to post your jobs</div>
@else
    <form action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data" class="mt-5"> @csrf
        <div class="card shadow">
            <div class="card-header  border-0">
                <h4 class="fw-bold">Payment Information</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="payment_method"><b>Payment Method</b></label>
                    <select name="payment_method_id" id="payment_method" class="form-control @error('payment_method_id') is-invalid @enderror">
                            <option class="fw-bold" disabled selected>Select payment methods</option>
                            @foreach ($paymentMethods as $paymentMethod)
                                <option value="{{$paymentMethod->id}}">{{$paymentMethod->name}}</option>
                            @endforeach
                    </select>
                </div>
                <input type="hidden" name="employerId" value="{{Auth::user()->id}}">
                <label for="" class="fw-bold">Screenshot</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endif
@endsection
