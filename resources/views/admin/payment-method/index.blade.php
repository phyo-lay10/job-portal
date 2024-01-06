@extends('admin.layouts.app')
@section('content')

<a href="{{route('payment-methods.create')}}" class="btn btn-sm btn-info mb-3">Add</a>


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
            <th>Name</th>
            <th>Actions</th>
        </tr>
       </thead>
       <tbody>
        @foreach ($paymentMethods as $index => $paymentMethod)
        <tr>
            <td>{{ $index + 1}}</td>
            <td>{{ $paymentMethod->name}}</td>
            <td>
                <form action="{{url('admin/payment-methods/'.$paymentMethod->id)}}" method="POST"> @csrf @method('delete')
                    <a href="{{url('admin/payment-methods/'. $paymentMethod->id .'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are u sure to delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
       </tbody>
    </table>
@endsection
