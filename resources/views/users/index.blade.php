
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Admin Menu</div>
                    <div class="card-body">
                        <p><a href={{ route('User.create') }}>Create new user</a></p>
                        <h3>List of all Users</h3>
                        @foreach($users as $User)
                            <p>User ID: {{ $User->id }} |  User Name: {{ $User->name}}</p>
                        <p><a href="{{ route('User.edit', ['User' => $User]) }}">Edit User</a></p>
                            <form action="{{ route('User.destroy', ['User' => $User]) }}" method="POST">
                                @method('DELETE')
                                @csrf

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        @endforeach
                        <hr>
                        <div class="row">
                            {{ $users->links() }}
                        </div>


                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



