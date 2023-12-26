@extends('ui-panel.master')
@section('content')

<div class="overflow-hidden">

    {{-- <div class="container">
        <h4 class="mt-4 mb-5 text-center">Latest News</h4>
        <div class="row">
            <div class="col-md-6">
                <form class="d-flex mb-4" method="get" action="{{route('searchNews')}}">@csrf
                    <input class="form-control me-2" name="search"  placeholder="Search ..." aria-label="Search">
                    <button class="btn btn-sm btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <h4 class="mt-4 mb-5 text-center">Latest News</h4>
        <div class="row">
            <div class="col-md-7">
                @if ($news->isEmpty())
                <p class="mt-3 fw-bold">No news available for this category.</p>
                @else
                @foreach($news as $new)
                <div class="card mb-5 border-0 shadow" style="height: auto">
                    <div class="card-header border-0 bg-transparent overflow-hidden p-0">
                        @if($new->image)
                            <img src="{{ asset('storage/news-images/'.$new->image)}}" class="mb-3" style="width: 100%; height:200px; object-fit:cover">
                        @endif
                        </div>
                    <div class="card-body">
                        <h5 class="card-title"><span>{{$new->category->name}}</span></h5>
                        <p class="card-text fw-bold">{{$new->title}}</p>
                        <p class="card-text" style="text-align: justify"> {{substr($new->description,0,120)}} <span class="fw-bold"><a href="{{route('newsDetail', $new->id)}}" style="text-decoration: none">See more ...</a></span> </p> 
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        {{-- <p class="text-success">{{ $new->created_at->format('M d, Y H:i A') }}</p> --}}
                        <p class="text-success fw-bold">{{ $new->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="col-md-4">
                <form class="d-flex mb-4 w-75" method="get" action="{{route('searchNews')}}">@csrf
                    <input class="form-control me-2" name="search"  placeholder="Search ..." aria-label="Search">
                    <button class="btn btn-sm btn-outline-success" type="submit">Search</button>
                </form>
                    <h6 class="fw-bold ms-4 mb-3">Category</h6>
                    <ul style="list-style: none">
                        <li class="mb-2">
                            <a href="{{ route('newsSearchById') }}" class="fw-bold">All</a>
                        </li>
                        @foreach ($newsCategories as $newsCategory)
                        <li class="mb-2">
                            <a href="{{route('newsSearchById', $newsCategory->id)}}" class="fw-bold">{{$newsCategory->name}}</a>
                        </li>
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection
