@extends('layouts.second')

@section('content')
    <div class="row justify-content-center my-4" style="font-family: Montserrat">
        <div class="col-md-8 col-md-offset-2">
            <h1>Edit Comment</h1>

            <form class="form" method="POST" action="{{ route('comments.update', $comment->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-spacing-top mt-4">
                    <label class="font-weight-bold" style="font-size: 14px" for="comment">Comment:</label>
                    <textarea class="form-control" name="comment" id="comment" rows="7">{{ $comment->comment }}</textarea>
                </div>
                <button class="btn buttonUpdate btn-success btn-block mt-3 " type="submit" style="margin-top: 15px">Update Comment</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.buttonUpdate').click(function (e) {
                e.preventDefault();

                var comment = $('#comment').val();
                $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{ route('comments.update', $comment->id) }}",
                    data: {
                        comment: comment
                    },
                    beforeSend: function(){
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
                            $(".errors-section").show();

                            let html = "";
                            $.each(data.errors, function(i,v) {
                                html += '<li>'+v[0]+'</li>';
                            });

                            $(".errors-content").html(html);
                        }

                        if(data.redirect) {
                            setTimeout(function(){
                                window.location.href = '{{ route('blog.single', $comment->post->id) }}';
                            }, 1500);
                        }
                    }
                });
            });
        });
    </script>
@endsection
