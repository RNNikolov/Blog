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
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
                </thead>

                <tbody>

                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td> <!-- fix that  -->
                        <td>
                            <a href="{{ route('roles.edit', $user) }}"><button type="button" class="btn btn-success float-left">Edit</button></a>
                            <form action="{{ route('roles.destroy', $user) }}" method="POST" class="float-left ml-2">
                                @csrf
                                {{ method_field('delete') }}
                            <button type="submit" class="btn btn-danger ">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <div class="pagination justify-content-center">
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
