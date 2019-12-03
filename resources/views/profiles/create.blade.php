@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Profile</div>
                    <div class="card-body">



                        <form method="POST" action="{{route('Profile.store')}}"  enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_id">User Id</label>
                              <p><select name="user_id" id="user_id">
                                   <option value="">User Id</option>
                                   @foreach($User as $users)
                                   <option value="{{ $users->id }}">Name: {{ $users->name }} | Id: {{$users->id}}</option>
                                       @endforeach
                                  </select></p>
                                <div>{{ $errors->first('user_id') }}</div>
                            </div>
                            @include('profiles.form')



                            @csrf
                            <button type="submit" name="submit" class="btn btn-primary">Create New Profile</button>
                        <hr>
                        </form>


                        <p><a href="/home" class="text-decoration-none"><button class="btn btn-primary" >Back to home</button></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
