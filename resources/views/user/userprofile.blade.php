@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="text-align: center">
                    <div class="card-header red">
                        {{ __('User Name ') }}
                    </div>
                    <div class="card-body">
                        {{ $user->name }}
                    </div>
                    <div class="card-header red">
                        {{ __('User Email Address') }}
                    </div>
                    <div class="card-body">
                        {{ $user->email }}
                    </div>
                    <div class="card-header red">
                        {{ __('Profile Picture') }}
                    </div>
                    <div class="card-body">
                        <img src="{{ asset($user->picture) }}" alt="img" width="500" height="450">
                    </div>
                    <div>
                        <form action="{{ route('destroy', $user->id) }}" method="POST">
                        <a href="{{ route('blog.index') }}" class="btn btn-info">Back</a>    
                        <a href="{{ route('edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection