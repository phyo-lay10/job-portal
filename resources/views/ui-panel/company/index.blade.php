@extends('ui-panel.master')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4><a href="{{route('company')}}" class="text-dark">Recommended Companies</a></h4>
            <div>
                <form class="d-flex" method="get" action="{{route('searchCompany')}}">@csrf
                    <input class="form-control me-2" name="search"  placeholder="Search company ..." aria-label="Search">
                    <button class="btn btn-outline-info" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="row my-5">
            @if ($users->isEmpty())
                <p class="mt-3 fw-bold fs-6">Sry we couldn't find that company.</p>
            @else
                @foreach ($users as $user)
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-0">
                        <div class="card-header p-0 overflow-hidden border-0 bg-transparent">
                            @if($user->image)
                                <img src="{{asset('storage/admin-images/'. $user->image)}}" class="mb-3"  style="width: 100%; height:150px; object-fit:cover" alt="404">
                            @else
                                <p class="text-primary text-center mt-2"><b>No photo available !</b></p>
                            @endif
                        </div>
                        <div class="card-body pt-0 text-center fw-bold">{{$user->name}}</div>
                        <div class="card-footer border-0 bg-transparent">
                            <div>                        
                                <i class="fa-regular fa-folder me-3"></i><span>Premium</span>
                            </div>
                                <i class="fa-regular fa-envelope me-2"></i>
                                <span>{{ $user->jobs_count > 0 ? $user->jobs_count . ' Open jobs' : 'No open job' }}</span>
                            </div>
                    </div>
                </div>
                @endforeach
            @endif
            {{-- <div class="col-md-4"></div>
            <div class="col-md-4"></div> --}}
        </div>
    </div>
@endsection