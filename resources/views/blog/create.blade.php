@extends('layouts.app')

@section('content')
    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card center">
                        <div class="card-header red">
                            <h2>{{ __('Add New Blog') }}</h2>
                        </div>
                        @if (session('title'))
                            <h4 style="color: green">{{ session('title') }} blog has been added</h4>
                        @endif
                        <div class="card-body">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Blog Title"
                                value="">
                            <span class="red">*
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </span>

                            <input type="text" class="form-control" name="type" id="type" placeholder="Enter Blog Type"
                                value="">
                            <span class="red">*
                                @error('type')
                                    {{ $message }}
                                @enderror
                            </span>

                            <textarea name="description" id="description" class="form-control" cols="60" rows="5"
                                placeholder="Enter Blog Description"></textarea>
                            <span class="red">*
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>

                            <input type="file" name="picture" id="picture" class="form-control">
                            <span class="red">*
                                @error('picture')
                                    {{ $message }}
                                @enderror
                            </span>
                            <br><br>

                            <button type="submit" class="btn btn-primary" id="addBlog" name="addBlog"
                                value="">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- <form id="blogForm" name="blogForm" class="form-horizontal"> --}}

    {{-- <input type="hidden" name="blog_id" id="blog_id" value="">
    <div class="form-group">
        Title : <br>

        <br>
    </div>
    <div class="form-group">
        Type : <br>

        <br>
    </div>

    <div class="form-group">
        Description : <br>

        <br>
    </div>

    <div>
        Picture : <br>

        <br>
    </div>


    </form> --}}
@endsection()
