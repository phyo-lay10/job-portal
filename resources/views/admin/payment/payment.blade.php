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
                <label for="" class="fw-bold">Payment Method</label>
                <input type="text" class="form-control" placeholder="Enter your payment method" required>
                <input type="hidden" name="employerId" value="{{Auth::user()->id}}">
                <label for="" class="fw-bold">Screenshot</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endif 
@endsection