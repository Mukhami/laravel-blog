@extends('layouts.master')
@section('title', 'Bookmarked Events')
@section('content')

    <div class="container-fluid" style="margin-top: 5px">
        <div class="align-content-right border-0">
            @if(Session::has('info'))
                <div class="row">
                    <div class="col-md-12">
                        <p class="alert alert-info">{{ Session::get('info') }}</p>
                    </div>
                </div>
            @endif

            <div class="container">
                @if ($bookmarks->isEmpty())
                    <div class="container text-center">
                        <p><b>You have not bookmarked any post</b></p>
                    </div>
                @else
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>POST TITLE</th>
                        <th>CONTENT</th>
                        <th>DATE ADDED</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($bookmarks as $bookmark)
                        <tr>
                            <td><b><a href="{{ route('blog.post', ['slug' => $bookmark->post->slug]) }}">{!! $bookmark->post->title !!}</a></b></td>
                            <td><b>{!! str_limit($bookmark->post->content, 40) !!}</b></td>
                            <td><b>{!! \Carbon\Carbon::parse($bookmark->post->created_at)->format('d M Y')!!}</b></td>
                            <td> <a href="{{ route('delete_bookmark', ['id'=>$bookmark->id]) }}">Delete</a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                @endif
            </div>
        </div>
    </div>
    <br>
@endsection
