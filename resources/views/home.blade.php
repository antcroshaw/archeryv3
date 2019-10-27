@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @can('viewAny',App\Record::class)
                        <p><a href="{{ route('Record.index') }}" >Records Admin</a></p>
                       <p><a href="{{ route('Profile.index' ) }}">Profiles Admin</a></p>
                        @endcan
                        <p><a href="" >User Admin</a></p>
<hr>
                        <p> Here are the profiles for <strong>{{ auth()->user()->name }}</strong></p>
                    @foreach($profiles as $profile)

                            <p>Location : {{ $profile->location }} | Bow Type : {{ $profile->bow }}<a href="/Profile/{{ $profile->id }}"> View </a></p>
                        @endforeach




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
