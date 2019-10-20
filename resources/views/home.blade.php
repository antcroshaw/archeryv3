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
                        @endcan
                        <p><a href="" >User Admin</a></p>

                        <p> Here are the profiles for this user</p>
                    @foreach($profiles as $profile)

                            <p><a href="/Profile/{{ $profile->id }}">Location : {{ $profile->location }}</a></p>
                        @endforeach




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
