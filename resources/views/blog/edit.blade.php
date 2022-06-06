@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header red center">
                        <h2>{{ __('Update Blog') }}</h2>
                        @if (session('title'))
                            <h3 style="color: green">{{ session('title') }} blog has been update</h3>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('blog.update', $data->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <input type="hidden" name="blog_id" id="blog_id" value="{{ $data->id }}">
                            <input type="hidden" name="old_picture" id="old_picture" value="{{ $data->picture }}">
                            <div class="form-group">
                                Title :
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Enter Blog Title" value="{{ $data->title }}" required> <br>
                            </div>
                            <div class="form-group">
                                Type : <br>
                                <input type="text" class="form-control" name="type" id="type" placeholder="Enter Blog Type"
                                    value="{{ $data->type }}" required> <br>
                            </div>

                            <div class="form-group">
                                Description : <br>
                                <textarea name="description" id="description" class="form-control" cols="60" rows="5"
                                    placeholder="Enter Blog Description">{{ $data->description }}</textarea> <br>
                            </div>

                            <div>
                                Picture : <br>
                                <input type="file" name="picture" id="picture" class="form-control">
                                <img src="{{ asset($data->picture) }}" alt="img" width="350" height="300"> <br><br>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="addBlog" name="addBlog"
                                    value="">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()