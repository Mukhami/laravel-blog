@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <p class="quote">{!! $post->title  !!} </p>
            <input type="hidden" name="post_id" value="{{ $post->id }}" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <p>{{ count($post->likes) }} Likes | <a href="{{route('blog.post.like', ['id'=> $post->id])}}"> Like :) </a> </p>
        </div>

        <div class="col-md-2">
            <p><a href="{{route('bookmark', ['id'=>$post->id])}}">Add to Bookmarks</a></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>{!! $post->content !!} </p>
        </div>
    </div>

    <p class="comment-title">{{ count($post->comments) }} Comments</p>


        @foreach($post->comments as $comment)
            <div class="comment">
                <div class="author-info">
                <img src="{{Voyager::image($comment->user->avatar)}}" class="author-image">
                </div>
                <div class="author-name">
                    <h5>{{ $comment->user->name }}</h5>
                    <p class="author-time">{{ date('F nS, Y - g:i' , strtotime($comment->created_at)) }}</p>
                </div>
                <div class="comment-content">
                    <p>{{ $comment->body }}</p>
                </div>
                <div class="comment-like">
                    <p style="font-weight: bold"> <p>{{ count($comment->comment_likes) }} | <a href="{{route('comment.like', ['id'=> $comment->id])}}"><i class="far fa-heart"></i> </a> </p>
                </div>
            </div>
         @endforeach


    <hr>

    <p><b>Add comment</b></p>
    <form method="post" action="{{route('comment', ['id'=>$comment_id->id])}}">
        @csrf
{{--        <input type="hidden" name="user_id" id="user_id" value="{{ $comment->id}}">--}}
        <input type="hidden" name="user_id" id="user_id" value="{{ $post->user_id}}">
        <div class="form-group">
            <div class="col-md-4">
                <textarea class="form-control" name="body" rows="5" cols="33" maxlength="150"></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-warning" value="Comment" />
        </div>
    </form>
@endsection