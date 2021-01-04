@extends('layouts.main')

@section('content')
    <div class="row justify-content-center mt-3" style="font-family: Montserrat">
        <div class="col-md-8">
            <h1>All Posts</h1>
        </div>

        <div class="col-md-2 mt-2">
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-success btn-h1-spacing">Create New Post</a>
        </div>

        <div class="col-md-10">
            <hr>
        </div>
    </div>

    <div class="row justify-content-center" style="font-family: Montserrat">
        <div class="col-md-10 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created At</th>
                <th>Operations</th>
                </thead>

                <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <th>{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ substr(strip_tags($post->content), 0, 50) }}{{ strlen(strip_tags($post->content)) > 50 ? "..." : "" }}</td>
                        <td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary float-left mr-2">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn  btn-success float-left mr-2">Edit</a>
                            <form class="float-left" id="delete-post-form" method="POST" action="{{ route('dashboard.destroy', $post->id) }}">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Delete</button>
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
                            {{ $posts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
