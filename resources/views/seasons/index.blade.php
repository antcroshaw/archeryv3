
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
                        @foreach($Seasons as $Season)
                            <p>Season ID: {{ $Season->id }} | Name : {{ $Season->name }} | Start Date :  {{ $Season->start_date }}</p>
                            <form action="{{ route('Season.destroy', ['Season' => $Season]) }}" method="POST">
                                @method('DELETE')
                                @csrf

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>


                            @endforeach


<hr>
                        
                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



