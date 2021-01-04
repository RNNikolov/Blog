@extends('layouts.second')

@section('content')
    <div class="row justify-content-center mt-3" style="font-family: Montserrat">
        <div class="col-md-8">
            <h1>My Account</h1>
        </div>

        <div class="col-md-8">
            <hr>
        </div>
    </div>

    <div class="row justify-content-center" style="font-family: Montserrat">
        <div class="col-md-8 col-md-offset-2">
            <form class="form" method="POST" action="{{ route('profile.update', $user->id) }}"
                  enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <img src="{{ asset($user->profile->image->url) }}"
                             style="width:100px; height:100px; float:left; border-radius:50%; margin-right:25px;">
                        <label for="avatar">Update Profile Image</label>
                        <input type="file" id="avatar" name="avatar">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="bio">Bio</label>
                        <textarea type="bio" class="form-control" id="bio" name="bio"
                                  rows="5">{{ $user->profile->bio }}</textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="age">Age:</label>
                        <input class="form-control" type="text" id="age" name="age" value="{{ $user->profile->age }}">
                    </div>

                </div>

                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address"
                           value="{{ $user->profile->address }}">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity" name="city"
                               value="{{ $user->profile->city }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip" name="zip"
                               value="{{ $user->profile->zip }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update</button>

            </form>
        </div>
    </div>


@endsection
