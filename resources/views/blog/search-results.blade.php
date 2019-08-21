@extends('layouts.master')

@section('content')
    @foreach($posts as $post)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="author-info">
                        <img src="{{Voyager::image($post->user->avatar)}}" class="author-image">
                    </div>
                    <div class="author-name">
                        <h5>{{ $post->user->name }}</h5>
                    </div>


                    <div class="row">
                        <div class="col-md-4 offset-md-8"><p class="tags" style="font-weight: bold"> <p>{{ count($post->likes) }} Likes | <a href="{{route('blog.post.like', ['id'=> $post->id])}}"> Like :) </a> </p></div>
                    </div>

                    <h4 class="post-title">{{ $post->title }}</h4>
                    <p class="card-text">{{ str_limit($post->content, 250) }}!</p>
                    <p class="post-author-time">{{ date('F nS, Y - g:i' , strtotime($post->created_at)) }}</p>
                    <a class="btn btn-primary" href="{{ route('blog.post', ['slug' => $post->slug]) }}">Read more...</a>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
@endsection