@extends('ui-panel.master')
@section('content')
<div class="overflow-hidden">
  <div class="d-flex justify-content-end me-4 ">    
    <a href="{{route('news')}}" class="my-3 btn btn-sm btn-primary">Back</a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-7 post-details mt-5 m-auto">
        <div class="card mb-3 border-0 shadow" style="height: auto">
          <div class="card-header border-0 bg-transparent overflow-hidden p-0">
              @if($new->image)
                  <img src="{{ asset('storage/news-images/'.$new->image)}}" class="mb-3" style="width: 100%; height:200px; object-fit:cover">
              @endif
          </div>
          <div class="card-body">
              <h5 class="card-title"><span>{{$new->category->name}}</span></h5>
              <p class="card-text fw-bold">{{$new->title}}</p>
              <p class="card-text">{{$new->description}}</p>
          </div>
          <div class="card-footer border-0 bg-transparent">
              <div class="d-flex justify-content-between align-items-center">
                <p class="text-success fw-bold">{{ $new->created_at->diffForHumans() }}</p>
                <button class="btn btn-success btn-sm mb-3" type="button" 
                        @auth
                            data-bs-toggle="collapse" data-bs-target="#collapseExample" 
                            aria-expanded="false" aria-controls="collapseExample"
                        @else
                            onclick="location.href='{{ route('loginForm') }}';"
                        @endauth>
                   <b>View Comment ~ <span>{{$comments->count()}}</span></b>
                </button>
              </div>            
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <div class="collapse w-50 mb-5" id="collapseExample">
            <form action="{{route('comment',$new->id)}}" method="POST">@csrf
              <div class="mb-2 rounded shadow">
                <textarea name="text" class="form-control rounded" rows="3" placeholder="Leave your comment here"></textarea>
              </div>
              <button class="btn btn-sm btn-primary float-end shadow">Submit</button>
            </form>
            @foreach($comments as $comment)
            <div class="border rounded mb-3 mt-5 shadow d-flex flex-column px-2 pb-2 pt-3">
              <p style="color: blueviolet" class="fw-bold">Name : {{$comment->user->name}}</p>
              <p class="ms-3">{{ $comment->text }}</p>
              <p class="text-end text-success">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
