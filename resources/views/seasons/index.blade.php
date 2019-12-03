
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Seasons Admin Menu</div>
                    <div class="card-body">
                        <p><a href={{ route('Season.create') }}>Create new season</a></p>
                        <h3>List of all Seasons</h3>
                        @forelse($Seasons as $Season)
                            <p>Name : {{ $Season->name }} | Active: {{ $Season->active }} | Location : {{ ucfirst($Season->location) }} | Start :  {{ $Season->start_date }} | End :  {{ $Season->end_date }}
                                <a href="{{ route('Season.show', ['Season' => $Season]) }}">View</a></p>
                            <div class="row col-12">


                                <a  href="{{ route('Season.start',['Season' => $Season]) }}">Start </a>&nbsp; |
                                <a  href="{{ route('Season.end',['Season' => $Season]) }}"> &nbsp;End</a>

                            </div>

                            @empty
                            <p>No seasons added yet!</p>

                            @endforelse

                        @if(Session::has('message'))
                            <hr>
                            <p class="alert-warning">{{ Session::get('message') }}</p>
                        @endif


<hr>

                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



