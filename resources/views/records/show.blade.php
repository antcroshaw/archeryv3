@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Record id: {{ $Record->id }} for {{ $Record->user->name  }}</div>
                    <div class="card-body">
                            <p>Round: {{ $Record->round }}</p>
                            <p>Score: {{ $Record->score}}</p>
                            <p>Handicap: {{ $Record->handicap }}</p>
                            <p>Date: {{ $Record->date }}</p>
                        <p>Season: {{ $Record->season->name }}</p>
                        <p>Classification: {{ $Record->classification }}</p>







                        <p><a href="/Record/{{ $Record->id }}/edit">Edit Record</a></p>
                            <p><form action="{{ route('Record.destroy', ['Record' => $Record]) }}" method="POST">
                                @method('DELETE')
                                @csrf

                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                            </form></p>
                            <hr>
                            <p><a href="{{ route('Record.index') }}" class="text-decoration-none"><button class="btn btn-primary" >Back to Records</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



