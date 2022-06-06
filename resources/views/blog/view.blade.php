@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
        
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">

        <title>Blog</title>

    </head>

    <body>
        <div class="container">
            <h1>Blog List</h1>
            <form action="{{ route('blog.index') }}" method="GET" role="search">

                <div class="input-group">
                    <input type="text" name="search" id="search" placeholder="Search Blog">
                    <button class="btn btn-success" type="submit" title="Search Blogs">
                        Search
                    </button>

                    <a href="{{ route('blog.index') }}">
                        <button class="btn btn-danger" type="button" title="Refresh page">
                            Clear
                        </button>
                    </a>
                </div>
            </form>
            @auth
                <a class="btn btn-success" href="{{ route('blog.create') }}" id="createBlog" style="float: right;">Add
                    Blog</a>
            @endauth

            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="5%">Id</th>
                        <th width="15%">Title</th>
                        <th width="10%">Type</th>
                        <th width="35%">Description</th>
                        <th width="15%">Picture</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $record)
                        <tr>
                            @guest
                                <td>{{ ++$i }}</td>
                                <td>{{ $record['title'] }}</td>
                                <td>{{ $record['type'] }}</td>
                                <td class="blog-text">
                                    <a href="{{ route('blog.show', $record->id) }}" id="description">
                                        <p>{{ $record->description }}</p>
                                    </a>
                                    <a href="{{ route('blog.show', $record->id) }}" id="readmore">
                                        <h2><span>Read more</span></h2>
                                    </a>
                                </td>
                                <td><img src="{{ $record['picture'] }}" width="100" height="100" /></td>
                                <td><a href="{{ route('blog.show', $record->id) }}" class="btn btn-info">Show</a></td>
                            </tr>
                        @else
                            @php
                                $current_user = auth()->user()->id;
                                $blog_user_id = $record->user_id;
                            @endphp

                            <td>{{ ++$i }}</td>
                            <td>{{ $record['title'] }}</td>
                            <td>{{ $record['type'] }}</td>

                            <td class="blog-text">
                                <a href="{{ route('blog.show', $record->id) }}" id="description">
                                    <p>{{ $record->description }}</p>
                                </a>
                                <a href="{{ route('blog.show', $record->id) }}" id="readmore">
                                    <h2><span>Read more</span></h2>
                                </a>
                            </td>
                            <td><img src="{{ $record['picture'] }}" width="100" height="100" /></td>
                            <td>
                                <form action="{{ route('blog.destroy', $record->id) }}" method="POST">
                                    <a href="{{ route('blog.show', $record->id) }}" class="btn btn-info">Show</a>
                                    @if ($current_user == $blog_user_id && $current_user)
                                        <a href="{{ route('blog.edit', $record->id) }}" class="btn btn-primary">Edit</a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    @endif
                                </form>
                            </td>


                        @endguest
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $data->links() !!}
            <div class="w-5"></div>

    </body>

    </html>
@endsection
