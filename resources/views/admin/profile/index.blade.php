@extends('admin.layouts.app')
@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>{{session('success')}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-7 mb-5">
            <h5 class="text-center text-secondary-emphasis text-decoration-underline fw-bold">Profile</h5>
            <div class="border pt-3 mt-5 rounded shadow">
                <ul class="list-group list-group-flush p-3">
                    <div class="mb-3 text-center">
                        @if($user->image)
                            <img src="{{ asset('storage/admin-images/'.$user->image) }}"  class="w-50 h-50 object-fit-cover rounded shadow-sm">
                        @else
                            <p class="text-primary"><b>No photo available !</b></p>
                        @endif
                    </div>

                    <li class="list-group-item bg-transparent"><b>Name :</b>&nbsp; {{$user->name}}</li>
                    <li class="list-group-item bg-transparent"><b>Email :</b>&nbsp; {{$user->email}}</li>
                    <li class="list-group-item bg-transparent"><b>Role :</b>&nbsp; {{$user->role}}</li>
                    <li class="list-group-item bg-transparent">
                        <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            @if($user->image)
                                Update
                            @else
                                Upload
                            @endif
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('profileUpdate', Auth::user()->id)}}" method="POST" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <input type="file" name="image" required class="form-control">
                    </div>
                    <div class="modal-footer border-0">     
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                   </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection