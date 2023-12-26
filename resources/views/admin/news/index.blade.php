@extends('admin.layouts.app')
@section('content')

<a href="{{route('news.create')}}" class="btn btn-sm btn-info mb-3">Add</a>


    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('success')}}            
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-hover">
       <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>News Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
       </thead>       
       <tbody>
        @foreach ($news as $index => $new)
        <tr>
            <td>{{ $index + 1}}</td>
            <td>{{ $new->title}}</td>
            <td>
                <textarea name="" class="form-control text-black bg-white" readonly cols="30" rows="2" >{{$new->description}}</textarea>
            </td>
            <td>{{ $new->category->name}}</td>
            <td>
                <img src="{{asset('storage/news-images/'.$new->image)}}" class="rounded-circle" style="width: 80px; height:80px; object-fit:cover">
            </td>
            <td>
                <form action="{{route('news.destroy', $new->id)}}" method="POST"> @csrf @method('delete')
                    <a href="{{url('admin/news/'. $new->id .'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are u sure to delete?')">Delete</button>
                    <a href="{{route('news.show',$new->id)}}" class="btn btn-sm btn-info">Comment</a>
                </form>
            </td>
        </tr>
        @endforeach
       </tbody>

    </table>
@endsection