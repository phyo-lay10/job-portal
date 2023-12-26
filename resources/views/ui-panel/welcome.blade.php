@extends('ui-panel.master')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6">
                <form class="d-flex" method="get" action="{{route('search')}}">@csrf
                    <input class="form-control me-2" name="search"  placeholder="Search ..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                @if ($jobs->isEmpty())
                <p class="mt-3 fw-bold fs-5">No jobs available for this category.</p>
                @else
                @foreach ($jobs as $job)
                <div class="card shadow mb-4 pt-2 border-0">
                    <div class="card-header d-flex justify-content-between bg-transparent border-0">
                        <h3 class="mb-3">{{$job->title}}</h3>
                        {{-- <h6 class="text-info">{{$job->employer->name}}</h6> --}}
                        <h6 class="text-info">{{ optional($job->employer)->name }}</h6>
                    </div>
                    <div class="card-body">
                        <p>{{$job->description}}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 clearfix">
                        <p class="float-start text-success fw-bold ">$ {{$job->salary}}</p>
                        <a href="{{route('apply', $job->id)}}" class="btn btn-sm btn-info float-end">Apply</a>
                    </div>
                </div>
                @endforeach  
                @endif
            </div>

            <div class="col-md-4">
                <h5 class="ms-4 mb-4 fw-bold">Category</h5>
                <ul style="list-style: none">
                    <li class="mb-2">
                        <a href="{{ route('searchById') }}" class="fw-bold">All</a>
                    </li>
                    @foreach ($categories as $category)
                    <li class="mb-2">
                        <a href="{{route('searchById' , $category->id)}}" class="fw-bold">{{$category->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div> 
@endsection