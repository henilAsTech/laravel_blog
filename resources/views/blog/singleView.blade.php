@extends('layouts.app')

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
                            {{ __('Blog Name ') }}
                        </div>
                        <div class="card-body">
                            {{ $data->title }}
                        </div>
                        <div class="card-header red">
                            {{ __('Blog Type') }}
                        </div>
                        <div class="card-body">
                            {{ $data->type }}
                        </div>
                        <div class="card-header red">
                            {{ __('Blog Description') }}
                        </div>
                        <div class="card-body">
                            {{ $data->description }}
                        </div>
                        <div class="card-header red">
                            {{ __('Blog Picture') }}
                        </div>
                        <div class="card-body">
                            <img src="{{ asset($data->picture) }}" alt="img" width="500" height="450">
                        </div>
                        
                        <div>
                            @auth
                                <form action="{{ route('blog.destroy', $data->id) }}" method="POST">
                                    <a href="{{ route('blog.edit', $data->id) }}" class="btn btn-primary">Edit</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @else
                                <a href="{{ route('blog.index') }}" class="btn btn-info">Back</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection()
