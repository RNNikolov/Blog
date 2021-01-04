@extends('layouts.main')

@section('content')
    <div class="container mt-3" style="font-family: Montserrat">
        <div class="row">
            <div class="col-md-12 ">
                <h1 class="display-4" style="color: #41A317">{{ $post->title }}</h1>
            </div>
            <div class="col-md-12">
                <p class="lead">{!! $post->content !!}</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <hr>
                <h4 class="comments-title"><i class="fa fa-comments"
                                              aria-hidden="true"></i> {{ $post->comments()->count() }} Comments</h4>
                <hr>
                @foreach($post->comments as $comment)
                    <div class="comment mb-4">
                        <div class="user-info">

                            <img
                                src="{{ asset($comment->user->profile->image->url) }}"
                                class="user-image" style="width: 50px; height: 50px; border-radius: 50%; float: left">

                            <div class="user-name ml-3" style="float: left">
                                <h4 class="my-1">{{ $comment->user->name }}</h4>
                                <p class="user-time"
                                   style="font-size: 11px; font-style: italic; color: #aaa">{{ date('F dS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
                            </div>

                            @if(auth()->user()->id == $comment->user->id)
                                <a href="{{ route('comments.blogEdit', $comment->id) }}"
                                   class="btn btn-xs btn-success editCommentButton float-right"><i
                                        class="fas fa-pencil-alt"></i></a>
                            @endif
                        </div>

                        <div class="comment-content"
                             style="clear: both; font-size: 16px; line-height: 1.3em; margin-left: 65px">
                            {{ $comment->comment }}
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-12" style="margin-top: 50px;">
                <form class="form-comment mb-3" method="POST" action="{{ route('comments.store', $post->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold" style="font-size: 24px" for="comment">Comment:</label>
                        <textarea class="form-control" rows="7" name="comment" id="comment"
                                  autocomplete="off"></textarea>
                    </div>
                    <button class="btn addComment btn-success btn-block" type="submit" style="margin-top: 15px">Add
                        Comment
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('.addComment').click(function (e) {
                e.preventDefault();
                let $btn = $(this);
                var comment = $('#comment').val();
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: "{{ route('comments.store', $post->id) }}",
                    data: {
                        comment: comment
                    },
                    beforeSend: function () {
                        $btn.attr('disabled', true);
                        $(".errors-section").hide();
                    },
                    success: function (data) {
                        if (data.success) {
                            Swal.fire({
                                position: 'bottom-right',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                            })
                        } else {
                            $btn.attr('disabled', false);
                            $(".errors-section").show();

                            let html = "";
                            $.each(data.errors, function (i, v) {
                                html += '<li>' + v[0] + '</li>';
                            });

                            $(".errors-content").html(html);
                        }

                        if (data.reload) {
                            setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        }
                    }
                });
            })
        });

    </script>
@endsection
