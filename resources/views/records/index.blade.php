
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Records Admin Menu</div>
                    <div class="card-body">
                        <p><a href={{ route('Record.create') }}>Create new record</a></p>
                        <h3>List of all Records</h3>
                        @forelse($Records as $Record)
                            <p>Record ID: {{ $Record->id }} | Season : {{ $Record->season->location }} | User Name: {{ $Record->user->name}} | Score: {{ $Record->score }}
                                 | Round: {{ $Record->round }} |
                                <a href="{{ route('Record.show', ['Record' => $Record]) }}">View</a></p>

                            <p><a href="{{ route('Record.edit', ['Record' => $Record]) }}">Edit</a></p>
                        @empty
                            <p>No Records added yet!</p>

                        @endforelse


                        <hr>
                        <div class="row">
                            {{ $Records->links() }}
                        </div>
                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





