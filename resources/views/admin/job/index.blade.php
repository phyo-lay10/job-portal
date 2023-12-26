@extends('admin.layouts.app')
@section('content')

<div class="">
    <a href="{{url('admin/jobs/create')}}" class="btn btn-sm btn-info  mb-3">Add</a>

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
            <th>Category</th>
            <th>Title</th>
            <th>Description</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
       </thead>
       <tbody>
        @foreach ($jobs as $index => $job)
        <tr>
            <td>{{$index + 1}}</td>
            @if ($job->category)
            <td>{{$job->category->name}}</td>
            @endif
            {{-- <td>
                @foreach ($categories as $category)
                    @if ($category->id == $job->category_id)
                        {{$category->name}}
                    @endif
                @endforeach
            </td> --}}
            <td>{{$job->title}}</td>
            <td>
                <textarea name="" class="form-control text-black bg-white" readonly cols="30" rows="2" >{{$job->description}}</textarea>
            </td>
            <td>$ {{$job->salary}}</td>
            <td> 
                <form action="{{route('jobs.destroy', $job->id)}}" method="POST"> @csrf @method('delete')
                    <a href="{{url('admin/jobs/'.$job->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are u sure to delete?')">Delete</button>
                    {{-- url('admin/jobs/'.$job->id.'/applications') --}}
                    <a href="{{ route('jobs.applications', $job->id) }}" class="btn btn-info btn-sm">CV</a>
                </form>
            </td>
        </tr>
        @endforeach
       </tbody>
    </table>
</div>
@endsection