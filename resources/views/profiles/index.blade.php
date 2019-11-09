
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile Admin Menu</div>
                    <div class="card-body">
                        <p><a href={{ route('Profile.create') }}>Create new profile</a></p>
                        <h3>List of all Profiles</h3>
                        @foreach($profiles as $Profile)
                            <p>Profile ID: {{ $Profile->id }} | Location : {{ $Profile->location }} | User Name: {{ $Profile->user->name}}</p>
                            <form action="{{ route('Profile.destroy', ['Profile' => $Profile]) }}" method="POST">
                                @method('DELETE')
                                @csrf

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>


                            @endforeach



                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



