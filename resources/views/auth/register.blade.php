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
            <h4 class="mt-5 mb-4"><b>Register Form</b></h4>
            <div class="card card-body mt-3 p-4 shadow border-0" style="background-color: white">
                <div class="mb-3">
                    <label for="name" class="mb-2"><b>Name</b></label>
                    <input type="text" name="name" class="form-control border-0 shadow @error('name') is-invalid @enderror" id="name" placeholder="Enter your name">
                    @error('name')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="mb-2"><b>Email</b></label>
                    <input type="text" name="email" class="form-control border-0 shadow @error('email') is-invalid @enderror" id="email" placeholder="Enter your email">
                    @error('email')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="mb-2"><b>Password</b></label>
                    <input type="password" name="password" class="form-control border-0 shadow @error('password') is-invalid @enderror" id="password" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="mb-2 fw-bold">Role</label>
                    <div class="d-flex gap-3 shadow p-1 border-0 rounded">
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
                </div>
                <div class="my-2">
                    <button class="btn btn-sm btn-primary shadow mb-3">Submit</button>
                    <div>Already have an account? <a href="{{route('loginForm')}}"><b> Login here</b></a></div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
