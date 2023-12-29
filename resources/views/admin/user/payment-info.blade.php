@extends('admin.layouts.app')
@section('content')
    <div class="row d-flex flex-column">
        @if(isset($payment))
        <div class="col-md-8">
            <div class="border mt-5 rounded shadow">
                <ul class="list-group list-group-flush p-3">
                    <li class="list-group-item bg-transparent"><b>Name :</b>&nbsp; {{$user->name}}</li>
                    <div class="my-3 text-center">
                        <img src="{{asset('/storage/voucher-images/'.$payment->voucher_image)}}" class="rounded" style="width: 300px; height:300px; object-fit:cover;">
                    </div>
                </ul>
            </div>
        </div>
        @else
        <p>No payment yet.</p>
        @endif

        <div class="col-md-8 mt-3">
            <a href="{{route('userList')}}" class="btn btn-sm btn-info float-end" title="back">
                <i class="fa-solid fa-backward"></i> 
            </a>
        </div>
    </div>
@endsection