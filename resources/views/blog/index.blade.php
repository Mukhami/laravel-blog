@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="quote">Wamloleeez</p>
            </div>
        </div>

        <div class="row  justify-content-end">
            <div class="col-md-4">
                <a class="btn btn-primary" href="{{ route('admin.create')}}">Write Something...</a><br>
                <br>
            </div>
            <br>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Notifications
                    </div>
                    <div class="card-body" style="overflow-y: scroll; height:200px;">
                        <ul class="list-group list-group-flush">

                            @guest()
                                Log in to view notifications
                            @else
                            @foreach (Auth::user()->notifications as $notification)
                                        <p style="font-size: small"><b>{{$notification->data['user_name']}}</b> liked your post <b> "{{$notification->data['post_title']}}" </b></p> <p style="font-style: italic; font-size: small">{{$notification->created_at->diffForHumans()}}</p>
                                    @endforeach
                            @endguest
                        </ul>
                    </div>
                </div>
                <hr>
            </div>

            <div class="col-md-8">
                @if(Session::has('info'))
                    <div class="row">
                        <div class="col-md-12">
                            <p class="alert alert-info">{{ Session::get('info') }}</p>
                        </div>
                    </div>
                @endif
                @if($posts->isEmpty())
                    {{--        @if(Auth::guest)--}}
                    No Posts to display
                    {{--            @endif--}}
                @else
                    @foreach($posts as $post)
{{--                        <input type="hidden" name="user" id="user" value="{{ $post->user}}">--}}
                        <div class="card">
                            <div class="card-body">
                                <div class="author-info">
                                    <img src="{{Voyager::image($post->user->avatar)}}" class="author-image">
                                </div>
                                <div class="author-name">
                                    <a href="" ><h5>{{ $post->user->name }}</h5></a>
                                </div>


                                <div class="row">
                                    <div class="col-md-4 offset-md-8"><p class="tags" style="font-weight: bold"> <p>{{ count($post->likes) }} | <a href="{{route('blog.post.like', ['id'=> $post->id, 'user_id'=>$post->user_id])}}"><i class="far fa-heart"></i> </a> </p></div>
                                </div>

                                <h4 class="post-title">{{ $post->title }}</h4>
                                <p class="card-text">{!! str_limit($post->content, 250) !!}</p>
                                <p class="post-author-time">{{ $post->created_at->diffForHumans() }}</p>
                                <a class="btn btn-primary" href="{{ route('blog.post', ['slug' => $post->slug]) }}">Read more...</a>
                            </div>
                        </div>
                        <hr>

                    @endforeach
                @endif

            </div>

            <div class="container align-content-center">
                {{ $posts->links() }}
            </div>
        </div>

    </div>


@endsection