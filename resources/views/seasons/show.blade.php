@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Details for Season {{ $Season->name  }}</div>
                    <div class="card-body">

                        @if($Season->start_date)<p><strong>Start Date: </strong> {{ $Season->start_date}} @else Not Started</p>@endif
                        @if($Season->end_date)<p><strong>End Date: </strong>{{ $Season->end_date }} @else Not Ended</p>@endif
                        @if($Season->start_date)<p><strong>Length of Season: </strong>{{ $diff }}</p>@endif
                            <p><strong>Active : @if($Season->active == 1) Yes @else No @endif</strong></p>
                            <p><strong>Location : {{ $Season->location }}</strong></p>




                        <p><a href="{{ route('Season.edit', ['Season' => $Season]) }}">Edit Season</a></p>
                        <div class="row col-12"><form action="{{ route('Season.destroy', ['Season' => $Season]) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <button class="btn btn-group-sm btn-block btn-danger x-2 " onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                        </form></div>
                        <hr>
                        <p><a href="{{ route ('Season.index') }}" class="text-decoration-none"><button class="btn btn-primary" >Back to Seasons</button></a></p>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



