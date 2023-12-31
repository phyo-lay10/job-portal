@extends('auth.master')
@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-4">
        <form action="" method="post"> @csrf
            <h4 class="mt-5 mb-4"><b>Login Form</b></h4>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session()->get('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card card-body mt-3 p-4 border-0 shadow" style="background-color: white">
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
                <div class="my-2">
                    <button class="btn btn-sm btn-primary mb-3 shadow">Submit</button>
                    <div>You have no account yet? <a href="{{route('registerForm')}}"><b>Register here</b></a></div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection