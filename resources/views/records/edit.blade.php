@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Record</div>
                    <div class="card-body">



                        <form method="POST" action="{{ route('Record.update' , ['Record' => $Record]) }} "  enctype="multipart/form-data">
                            @method('PATCH')
                           @include('records.form')

                            @csrf
                            <button type="submit" name="submit" class="btn btn-primary">Update Record</button>
                        <hr>
                        </form>


                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
