@extends('layouts.main')

@section('content')
    <div class="container col-md-10 pt-3">
       <div class="col-md-12">
            <div class="jumbotron" style="background-image: url(https://images.unsplash.com/photo-1549421263-5ec394a5ad4c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80); background-repeat: no-repeat; background-size: cover; background-position: center">
                <div class="row align-items-center justify-content-center">
                    <h1 class="display-2 text-light" style="font-family: Montserrat">Blog posts</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container col-md-10" style="font-family: Montserrat">
        <div class="row mb-2">
            @foreach ($posts as $post)
                <div class="col-md-6">
                    <div class="card flex-md-row mb-4 box-shadow h-md-250">
                        <div class="card-body d-flex flex-column align-items-start">
                            <h3 class="mb-0">{{ $post->title }}</h3>
                            <div class="mb-1 text-muted">By {{ $post->user->name }} | {{ date('M j, Y', strtotime($post->created_at)) }}</div>
                            <p class="card-text mb-auto">{{ substr(html_entity_decode(strip_tags($post->content), ENT_QUOTES), 0, 150) }} {{ strlen(html_entity_decode(strip_tags($post->content), ENT_QUOTES)) > 150 ? "..." : ""}}</p>
                            <a href="{{ route('blog.single', $post->id) }}">Continue reading</a>
                        </div>
                        <img class="card-img-right rounded flex-auto d-none d-md-block" name="thumbnail" alt="Thumbnail" style="width: 200px; height: 250px" src="{{ $post->image->url }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <div class="pagination justify-content-center">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
