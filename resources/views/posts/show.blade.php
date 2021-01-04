@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">

        <div class="col-md-6 my-3">
            <h1 class="display-4" style="color: #41A317; font-family: Montserrat">{{ $post->title }}</h1>
            <p class="lead">{!! $post->content !!}</p>
        </div>

        <div class="col-md-4" style="font-family: Montserrat">
            <div class="card flex-md-row my-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-center">
                    Created At:
                    {{ date('M dS, Y - g:iA', strtotime($post->created_at)) }}
                </div>
            </div>

            <div class="card flex-md-row my-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-center">
                    Updated At:
                    {{ date('M dS, Y - g:iA', strtotime($post->updated_at)) }}
                </div>
            </div>

            <hr>

            <div class="row">

                <div class="col-sm-6">
                    <a href="{{ route('posts.edit',  $post->id) }}" class="btn btn-success btn-block">Edit</a>
                </div>

                <div class="col-sm-6">
                    <form id="delete-post-form" method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                    </form>
                </div>
            </div>

            <div id="backend-comments" style="margin-top: 50px;">
                <h3>Comments: <small>{{ $post->comments()->count() }} total</small></h3>

                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thread>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thread>

                        <tbody>
                        @foreach($post->comments as $comment)
                            <tr data-ajax-url="{{route('comments.destroy', ['id' => $comment->id])}}">
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-success editCommentButton"><i class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-xs btn-danger deleteCommentButton"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.deleteCommentButton').click(function (e) {
                e.preventDefault();

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: true
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        var url = $(this).closest("tr").data('ajax-url');

                        $.ajax({
                            type: "DELETE",
                            dataType: 'json',
                            url: url,
                            success: function (response) {
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    response.status,
                                    'success',
                                ).then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                })
            })
        });
    </script>
@endsection
