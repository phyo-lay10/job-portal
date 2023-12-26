@extends('admin.layouts.app')
@section('content')
<h6 class="my-4 fw-bold ">User List</h6>
<table class="table  table-bordered table-hover">
    <thead>
        <tr>
            {{-- <th>ID</th> --}}
            <th>Name</th>
            <th>Role</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->role}}</td>
            <td>{{$user->active}}</td>
            <td>
                @if($user->role === 'employer')
                <form action="{{route('paymentConfirm', $user->id)}}" method="post">
                    @csrf                    
                    <a href="{{route('paymentDetail', $user->id)}}" class="btn btn-sm btn-info">Payment Info</a>
                    @if($user->active == 0 && $user->payment)
                        <button class="btn btn-primary btn-sm">Confirm</button>
                    @endif                   
                </form>
                @endif
            </td>
        </tr> 
        @endforeach
    </tbody>
</table>
@endsection