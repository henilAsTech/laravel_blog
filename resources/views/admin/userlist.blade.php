@extends('layouts.adminLayout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <title>User List</title>
    </head>

    <body>
        <form action="{{ route('userlist') }}" method="GET" role="search">
            <div class="input-group">
                <input type="text" name="search" id="search" placeholder="Search User">
                <button class="btn btn-success" type="submit" title="Search Users">
                    Search
                </button>

                <a href="{{ route('userlist') }}">
                    <button class="btn btn-danger" type="button" title="Refresh page">
                        Clear
                    </button>
                </a>
            </div>
        </form>

        <a class="btn btn-success" href="{{ route('usercreate') }}" id="createBlog" style="float: right;">AddUser</a>

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th width="5%">Id</th>
                    <th width="15%">Name</th>
                    <th width="10%">Email</th>
                    <th width="20%">Created At</th>
                    <th width="15%">Picture</th>
                    <th width="35%">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['created_at'] }}</td>
                        <td><img src="{{ asset($user['picture']) }}" width="100" height="100" /></td>
                        <td>
                            <form action="{{ route('userdestroy', $user->id) }}" method="POST">
                                <a href="{{ route('showuser', $user->id) }}" class="btn btn-info">Show</a>
                                <a href="{{ route('useredit', $user->id) }}" class="btn btn-primary">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $users->links() !!}
        <div class="w-5"></div>
    </body>

    </html>
@endsection()
