@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <form class="form-post-put my-3" method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            {{ method_field('PUT') }}
            <div class="row">
                <div class="col-md-8 " style="font-family: Montserrat">
                    <div class="form-label-group">
                        <label class="font-weight-bold" style="font-size: 14px" for="title">Title</label>
                        <input id="title" class="form-control"  name="title" type="title" placeholder="Title" value="{{ $post->title }}">
                    </div>
                    <div class="form-spacing-top mt-4">
                        <label class="font-weight-bold" style="font-size: 14px" for="content">Content</label>
                        <textarea class="ckeditor form-control" name="content" id="content">{{ $post->content }}</textarea>
                    </div>
                </div>

                <div class="col-md-4"  style="font-family: Montserrat">
                    <div class="card flex-md-row mt-4 box-shadow h-md-250">
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
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-danger btn-block">Cancel</a>
                        </div>
                        <!--submit button which will send POST request to the posts.update-->
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            height: "650px"
        });
    </script>

@endsection
