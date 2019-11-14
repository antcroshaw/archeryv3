@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit {{ ucfirst($Profile->location) }} profile for {{ $User->name  }}</div>
                    <div class="card-body">
                        <p><strong>Email: </strong> {{ $User->email }}</p>
                        <p><strong>Bow: </strong>{{ $Profile->bow }}</p>

                        <hr>
                        <form method="POST" action="{{ route('Profile.update' , ['Profile' => $Profile]) }}"  enctype="multipart/form-data">
                            @method('PATCH')
                            @include('profiles.form')
                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </form>

<hr>



                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
