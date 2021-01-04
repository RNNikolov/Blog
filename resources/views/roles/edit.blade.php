@extends('layouts.second')

@section('content')
    <div class="container my-5" style="font-family: Montserrat">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit user {{ $user->name }} role:</div>

                    <div class="card-body">
                        <form action="{{ route('roles.update', $user) }}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input type="radio" name="role" value="{{ $role->id }}"
                                    @if($user->role_id == $role->id) checked @endif>
                                    <label>{{ $role->name }}</label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
