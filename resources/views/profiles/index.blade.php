
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
                        @forelse($profiles as $Profile)
                            <p>Profile ID: {{ $Profile->id }} | Location : {{ $Profile->location }} | User Name: {{ $Profile->user->name}}</p>
                            <form action="{{ route('Profile.destroy', ['Profile' => $Profile]) }}" method="POST">
                                @method('UPDATE')
                                @csrf

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            <form action="{{ route('Profile.edit', ['Profile' => $Profile]) }}" method="POST">
                                @method('PATCH')
                                @csrf

                                <button class="btn btn-primary" type="submit">Edit</button>
                            </form>
                            @empty
                            <p>No profiles added yet!</p>

                            @endforelse


<hr>
                        <div class="row">
                            {{ $profiles->links() }}
                        </div>
                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



