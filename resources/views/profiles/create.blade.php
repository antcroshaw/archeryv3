@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Profile</div>
                    <div class="card-body">


                        <hr>
                        <form method="POST" action="{{route('Profile.store')}}"  enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_id">User Id</label>
                              <p><select name="user_id" id="user_id">
                                   <option value="">User Id</option>
                                   @foreach($user as $users)
                                   <option value="{{ $users->id }}">Name: {{ $users->name }} | Id: {{$users->id}}</option>
                                       @endforeach
                                  </select></p>
                                <div>{{ $errors->first('user_id') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="name">Location</label>
                             <p><select name="location" id="location">
                                   <option value="">Select Location</option>
                                   <option value="outdoor">Outdoor</option>
                                   <option value="indoor">Indoor</option>
                                 </select></p>
                                <div>{{ $errors->first('location') }}</div>
                            </div>

                            <div class="form-group">
                                <label for="bow">Bow Type</label>
                               <p><select name="bow" id="bow">
                                       <option  value="">Select Bow Type</option>
                                       <option value="recurve">Recurve</option>
                                       <option value="barebow">Barebow</option>
                                       <option value="compound">Compound</option>
                                   </select></p>
                                <div>{{ $errors->first('bow') }}</div>
                            </div>

                            <div class="form-group d-flex flex-column">
                                <label for="image">Profile Image</label>
                                <input type="file" name="image" class="py-2">
                                <div>{{ $errors->first('image') }}</div>
                            </div>

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
