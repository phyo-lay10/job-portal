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
              <div class="d-flex mb-2 justify-content-between align-items-center align-items-center">
                <div>
                  <form method="POST"> @csrf
                    <div>  
                      <button formaction="{{route('like', $new->id)}}" class="btn btn-sm mb-2 btn-success like 
                          @if($likeStatus) 
                              @if($likeStatus->type == 'like') disabled  @endif
                          @endif">
                          <i class="far fa-thumbs-up"></i> Like <span class="ms-1 badge bg-dark">{{count($likes)}}</span>
                      </button>
                      <button formaction="{{route('dislike', $new->id)}}" class="btn btn-sm btn-danger mb-2  dislike
                          @if($likeStatus)
                              @if($likeStatus->type == 'dislike') disabled @endif
                          @endif">
                          <i class="far fa-thumbs-down"></i> Dislike <span class="ms-1 badge bg-dark">{{count($dislikes)}}</span>
                      </button>  
                    </div>
                  </form>
                </div>
                <button class="btn btn-success btn-sm mb-3" type="button" 
                        @auth
                            data-bs-toggle="collapse" data-bs-target="#collapseExample" 
                            aria-expanded="false" aria-controls="collapseExample"
                        @else
                            onclick="location.href='{{ route('loginForm') }}';"
                        @endauth>
                   <b>View Comment ~ 
                    @php
                          $visibleComments = $comments->filter(function ($comment) {
                              return $comment->status == 'show';
                          });
  
                          $visibleCommentCount = $visibleComments->count();
                          $visibleRepliesCount = $replies->whereIn('comment_id', $visibleComments->pluck('id'))->count();
                    @endphp
  
                      <span>
                          @if ($visibleCommentCount > 0)
                              {{$visibleCommentCount + $visibleRepliesCount}}
                          @else
                              {{$comments->count()}}
                          @endif
                      </span>
                   </b>
                </button>
              </div>
              <p class="text-success fw-bold float-end">{{ $new->created_at->diffForHumans() }}</p>          
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <div class="collapse w-50 mb-5" id="collapseExample">
            <form action="{{route('comment',$new->id)}}" method="POST">@csrf
              <div class="mb-2 rounded shadow">
                <textarea name="text" class="form-control rounded" required rows="3" placeholder="Leave your comment here"></textarea>
              </div>
              <button class="btn btn-sm btn-primary float-end shadow">Submit</button>
            </form>
            @foreach($comments as $comment)
            <div class="border rounded mb-3 mt-5 shadow d-flex flex-column px-2 pb-2 pt-3">
              <div>
                <p style="color: blueviolet" class="fw-bold">Name : {{$comment->user->name}}</p>
              <p class="ms-3">{{ $comment->text }}</p>
              <div class="d-flex justify-content-between">
                <div><a href="javascript::void(0)" class="btn btn-sm btn-outline-primary" data-CommentId="{{$comment->id}}" onclick="reply(this)">Reply</a></div>
                <p class="text-end text-success">{{ $comment->created_at->diffForHumans() }}</p>
              </div>
              </div>

              <div>
                @foreach ($replies as $reply)
                @if ($reply->comment_id === $comment->id) 
                  <div class="mb-2 mt-1 p-2 rounded border">
                      <p class="m-1"><b>{{$reply->user->name}}</b></p>
                      <p class="m-1">{{$reply->reply}}</p>
                      <div class="d-flex justify-content-between m-1">
                        <a href="javascript::void(0)" class="text-primary" data-CommentId="{{$comment->id}}" onclick="reply(this)">Reply</a>
                        <p class="text-success">{{ $reply->created_at->diffForHumans() }}</p>
                      </div>
                  </div>   
                @endif 
               @endforeach
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="text-center mt-4 replyDiv" style="display: none;">
          <form action="{{route('reply',$new->id)}}" method="POST"> @csrf
             <div class="text-start">
                <input type="hidden" id="commentId" name="commentId">
                <textarea name="reply" rows="3" class="form-control mb-2" placeholder="Reply here" required></textarea>
                <div class="d-flex justify-content-start">
                   <button class="btn btn-sm btn-primary" style="margin-right: 10px">Reply</button>
                   <button onclick="replyClose(this)" class="btn btn-sm btn-secondary">Close</button>
                </div>
             </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
<script>
  function reply(caller) {
     document.getElementById('commentId').value = $(caller).attr('data-CommentId');
     $('.replyDiv').insertAfter($(caller));
     $('.replyDiv').show();
  }

  function replyClose(caller) {
     $('.replyDiv').hide();
  }
</script>

<script>
  document.addEventListener("DOMContentLoaded", function(event) { 
      var scrollpos = localStorage.getItem('scrollpos');
      if (scrollpos) window.scrollTo(0, scrollpos);
  });

  window.onbeforeunload = function(e) {
      localStorage.setItem('scrollpos', window.scrollY);
  };
</script>
@endsection
