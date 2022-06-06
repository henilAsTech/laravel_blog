@extends('layouts.adminLayout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
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
                            {{ __('User Profile Picture') }}
                        </div>
                        <div class="card-body">
                            <img src="{{ asset($user->picture) }}" alt="img" width="500" height="450">
                        </div>
                        
                        <div>
                            <form action="{{ route('userdestroy', $user->id) }}" method="POST">
                                <a href="{{ route('userlist') }}" class="btn btn-info">Back</a>
                                <a href="{{ route('useredit', $user->id) }}" class="btn btn-success">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection()
