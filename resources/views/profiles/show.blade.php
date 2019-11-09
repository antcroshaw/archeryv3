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
                        <p><strong>Email: </strong> {{ $User->email }}</p>
                        <p><strong>Bow: </strong>{{ $Profile->bow }}</p>




                        <p><a href="/Profile/{{ $Profile->id }}/edit">Edit Profile</a></p>
                        <p><a href="/home" class="text-decoration-none"><button class="btn-link" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



