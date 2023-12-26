@extends('admin.layouts.app')
@section('content')
    <div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('success')}}            
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="d-flex justify-content-end mb-4">
            <a href="{{route('news.index')}}" class="btn btn-sm btn-primary">Back</a>
        </div>
        @if ($comments->count() < 1)
        <p class="fw-bold mt-4 fs-5">No comment found !</p>
        @else
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $index => $comment)
                <tr>
                    <td>{{++ $index}}</td>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->text}}</td>
                    <td>
                        <form action="{{url('admin/comment/'.$comment->id.'/show_hide')}}" method="post"> @csrf
                            <button class="btn btn-sm {{$comment->status == 'show' ? 'btn-warning' : 'btn-success'}}">
                            {{$comment->status == 'hide' ? 'Show' : 'Hide'}}
                            </button>
                            <button formaction="{{route('deleteComment',$comment->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are u sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div> 
@endsection