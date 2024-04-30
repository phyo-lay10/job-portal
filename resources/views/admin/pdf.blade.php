@extends('admin.layouts.app')
@section('content')
<h6 class="my-4 fw-bold ">{{$title}}</h6>
<h6 class="my-4 fw-bold ">{{$date}}</h6>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Voucher</th>
        </tr>
    </thead>
    <tbody>
        @if($payment)
            <tr>
                <td>{{$payment->id}}</td>
                <td>{{$payment->user->name}}</td>
                <td>{{$payment->user->role}}</td>
                {{-- <td>{{$payment->voucher_image}}</td> --}}
            </tr>
        @else
            <tr>
                <td colspan="4">No payment details found for the user.</td>
            </tr>
        @endif
    </tbody>
</table>
@endsection
