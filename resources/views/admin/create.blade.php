@extends('layouts.master')

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.create') }}" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea type="text" class="form-control" id="content" name="content"></textarea>
                </div>
                @foreach($tags as $tag)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
                {{ csrf_field() }}
                <button type="submit" name="post-create" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

<br><hr>
{{--    <div class="row">--}}
{{--        <div class="col-md-6">--}}
{{--            <form action="{{ route('admin.tag.create') }}" method="post">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="name">Tag-Name</label>--}}
{{--                    <input type="text" class="form-control" id="name" name="name">--}}
{{--                </div>--}}
{{--                {{ csrf_field() }}--}}
{{--                <button type="submit" name="tag-create" class="btn btn-primary">Submit</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
