@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User info for {{ $User->name  }}</div>
                    <div class="card-body">

                        <p><strong>Email: </strong> {{ $User->email }}</p>
                        <p><strong>Name: </strong>{{ $User->name }}</p>




                        <p><a href="/User/{{ $User->id }}/edit">Edit User</a></p>
                        <hr>
                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



