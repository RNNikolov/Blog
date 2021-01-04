@extends('layouts.main')

@section('content')
    <div class="container pt-3">
        <div class="col-md-12">
            <div class="jumbotron"
                 style="background-image: url(https://images.unsplash.com/photo-1589579234091-4b2ffe39b26f?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1000&q=80); background-repeat: no-repeat; background-size: cover; background-position: center">
                <div class="row align-items-center justify-content-center">
                    <h1 class="display-2 text-light" style="font-family: Montserrat">Create a new post</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="font-family: Montserrat">
        <div class="d-md-flex align-items-center h-100 justify-content-center">
            <form class="form-post mb-3" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"
                  style="width: 800px">
                @csrf

                <div class="form-label-group">
                    <label class="font-weight-bold" style="font-size: 14px" for="title">Title</label>
                    <input id="title" class="form-control" name="title" type="title" placeholder="Enter title here"
                           required="" autofocus="" style="font-size: 14px">
                </div>

                <div class="form-label-group mt-3">
                    <label class="font-weight-bold" style="font-size: 14px" for="inputImage">Upload Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control-file" id="inputImage">
                </div>

                <div class="form-label-group mt-3">
                    <label class="font-weight-bold" style="font-size: 14px" for="content">Content</label>
                    <textarea class="ckeditor form-control" name="content" id="content"></textarea>
                </div>

                <button class="btn btn-lg btn-success btn-block mt-3" type="submit" style="cursor: pointer">Publish
                </button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
