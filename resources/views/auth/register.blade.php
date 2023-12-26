@extends('auth.master')
@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-4">
        {{-- @if (session()->has('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}

        <form action="{{route('registerForm')}}" method="post"> @csrf
            <h4 class="mt-5"><b>Register Form</b></h4>
            <div class="card card-body mt-3 bg-dark-subtle border-0">
                <div class="mb-3">
                    <label for="name" class="mb-1"><b>Name</b></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter your name">
                    @error('name')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="mb-1"><b>Email</b></label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter your email">
                    @error('email')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="mb-1"><b>Password</b></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1" value="employer">
                        <label class="form-check-label" for="flexRadioDefault1">
                          employer
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role"  checked id="flexRadioDefault2" value="employee">
                        <label class="form-check-label" for="flexRadioDefault2">
                          employee
                        </label>
                    </div>
                </div>
                <div class="my-2">
                    <button class="btn btn-sm btn-info mb-3">Submit</button>
                    <div>Already have an account? <a href="{{route('loginForm')}}"> Login here</a></div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
