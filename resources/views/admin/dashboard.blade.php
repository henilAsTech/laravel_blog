@extends('layouts.adminLayout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">

    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="text-align: center">
                        <div class="card-header red">
                            {{ __('Number of Users ') }}
                        </div>
                        <div class="card-body">
                            <a href="{{ route('userlist') }}">
                                <button class="btn btn-success" title="Gogo User List">{{ $total_user }}</button>
                            </a>
                        </div>
                        <div class="card-header red">
                            {{ __('Number of Blogs ') }}
                        </div>
                        <div class="card-body">
                        <a href="{{ route('bloglist') }}">
                            <button class="btn btn-success" type="button" title="Goto Blog List">{{ $total_blog}}</button>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
@endsection()