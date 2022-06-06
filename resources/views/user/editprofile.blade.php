@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header red center">
                        <h2>{{ __('Update Profile') }}</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="old_picture" id="old_picture" value="{{ $user->picture }}">
                            <div class="form-group">
                                Name :
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter Name" value="{{ $user->name }}" required> <br>
                            </div>
                            <div class="form-group">
                                Email : <br>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Address"
                                    value="{{ $user->email }}" required> <br>
                            </div>

                            <div>
                                Picture : <br>
                                <input type="file" name="picture" id="picture" class="form-control">
                                <img src="{{ asset($user->picture) }}" alt="img" width="350" height="300"> <br><br>
                            </div>
                            <div class="center">
                                <a href="{{ route('profile', $user->id) }}" class="btn btn-info">Back</a>    
                                <button type="submit" class="btn btn-primary" id="updateprofile" name="updateprofile"
                                    value="">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()