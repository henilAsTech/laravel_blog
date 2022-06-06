@extends('layouts.adminLayout')

@section('content')
    <form action="{{ route('userstore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card center">
                        <div class="card-header red">
                            <h2>{{ __('Add New User') }}</h2>
                        </div>
                        @if (session('name'))
                            <h4 style="color: green">{{ session('name') }} user has been added</h4>
                        @endif
                        <div class="card-body">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"
                                value="">
                            <span class="red">*
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>

                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email"
                                value="">
                            <span class="red">*
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>

                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password"
                                value="">
                            <span class="red">*
                                @error('password')
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
@endsection()