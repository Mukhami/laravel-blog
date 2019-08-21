@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="row justify-content-end">
        <br>
        <div class="col-md-8">
            <br>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">New Post</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    My Profile
                </div>
                <div class="card-body">

                    <div class="img-responsive">
                        <img class="profile-image" src="{!! Voyager::image($user->avatar) !!}" height="100" width="100">
                    </div>
                    <div class="author-name"><h5 class="card-title">{{$user->name}}</h5></div>
                    <div class="profile-email"><p class="card-text">Email: {{$user->email}}</p></div>

                    <form action="{{ route('edit') }}" method="post">
                        @csrf()
                        <input name="id" type="hidden" value="{!! $user->id !!}">
                        <button href="#" class="btn btn-primary">Edit</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-8"><hr>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><strong>{{ $post->title }}</strong></td>
                        <td>{!! str_limit($post->content, 90) !!}</td>
                        <td><a href="{{ route('admin.edit', ['id' => $post->id]) }}">Edit</a>
                            <a href="{{ route('admin.delete', ['slug' => $post->slug]) }}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>



    </div>

@endsection