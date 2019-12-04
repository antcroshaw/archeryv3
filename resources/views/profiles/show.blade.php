@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ ucfirst($Profile->location) }} profile for {{ $Profile->user->name  }}</div>
                    <div class="card-body">
                        @if($Profile->image)
                            <div class="row">
                                <div class="col-12"><img src="{{ asset('storage/' . $Profile->image) }}" alt="" class="img-thumbnail"></div>
                            </div>
                        @endif
                        <p><strong>Email: </strong> {{ $Profile->user->email }}</p>
                        <p><strong>Bow: </strong>{{ $Profile->bow }}</p>




                        <p><a href="/Profile/{{ $Profile->id }}/edit">Edit Profile</a></p>
                            <p><form action="{{ route('Profile.destroy', ['Profile' => $Profile]) }}" method="POST">
                                @method('DELETE')
                                @csrf

                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                            </form></p>
                            <hr>
                            <p><a href="{{ route('Profile.index') }}" class="text-decoration-none"><button class="btn btn-primary" >Back to Profiles</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



