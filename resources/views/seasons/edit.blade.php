@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Season {{ $Season->name }}</div>
                    <div class="card-body">


                        <hr>
                        <form method="POST" action="{{route('Season.update', ['Season' => $Season])}}"  enctype="multipart/form-data">
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Name of Season</label>
                              <input name="name" class="input-sm" value="{{ $Season->name }}">

                            </div>

                            <div class="form-group">
                                <label for="name">Location</label>
                                <p><select name="location" id="location">
                                        <option value="">Select Location</option>
                                        <option value="outdoor" @if($Season->location == 'outdoor') selected @endif >Outdoor</option>
                                        <option value="indoor" @if($Season->location == 'indoor') selected @endif >Indoor</option>

                                    </select></p>
                                <div>{{ $errors->first('location') }}</div>
                            </div>



                            @csrf
                            <button type="submit" name="submit" class="btn btn-primary">Update Season</button>
                        <hr>
                        </form>


                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
