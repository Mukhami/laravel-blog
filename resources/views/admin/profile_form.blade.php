@extends('layouts.master')

@section('content')

    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="container">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Update User Profile</div>
                    <div class="card-body">
                        <form action="{{route('profile.update')}}" method="post">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="id" value=" {!! $user->id !!}">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter preferred User Name" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter preferred Email-Address" required>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection