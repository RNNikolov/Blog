@extends('layouts.main')

@section('content')
    <div class="row justify-content-center mt-3" style="font-family: Montserrat">
        <div class="col-md-8">
            <h1>All Users</h1>
        </div>

        <div class="col-md-8">
            <hr>
        </div>
    </div>

    <div class="row justify-content-center" style="font-family: Montserrat">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                <th>#</th>
                <th>User</th>
                <th></th>
                </thead>

                <tbody>

                @foreach ($users as $user)
                    <tr>
                        <td clphpass="table-text">
                            <div>{{ $user->id }}</div>
                        </td>
                        <td clphpass="table-text">
                            <div>{{ $user->name }}</div>
                        </td>
                        @if (auth()->user()->isFollowing($user->id))
                            <td>
                                <form action="{{route('unfollow', $user->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-follow-{{ $user->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Unfollow
                                    </button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{route('follow', $user->id)}}" method="POST">
                                    @csrf

                                    <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success">
                                        <i class="fa fa-btn fa-user"></i>Follow
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection
