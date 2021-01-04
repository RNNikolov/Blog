@extends('layouts.main')

@section('content')
    <div class="jumbotron jumbotron-fluid"
         style="border-bottom-style: solid; border-bottom-color: black; border-bottom-width: 3px; background-image: url(https://images.unsplash.com/photo-1549421263-5ec394a5ad4c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80); background-repeat: no-repeat; background-size: cover; background-position: center">
        <div class="container">
            <h1 class="display-2 text-light" style="font-family: Montserrat">Welcome to my blog</h1>
            <p class="text-light" style="font-family: Montserrat; font-size: 22px">Thank you so much for visiting! This
                is my test website built with Laravel regarding investing in the stock market.</p>
            @if(!(auth()->check()))
                <p><a class="btn btn-lg btn-success" href={{ route('register')}} role="button"
                      style="font-family: Montserrat; font-size: 22px">Register now</a></p>
            @endif
        </div>
    </div>

    <div class="container">
        <p class="display-4 lead" style="font-family: Montserrat">Most Recent Posts:</p>
        <hr>
        <div class="row">
                @foreach($posts as $post)

                    <div class="col-md-4 mt-2">
                        <h2 class="display-5" style="font-family: Montserrat">{{ $post->title }}</h2>
                        <div class="mb-1 text-muted" style="font-family: Montserrat">By {{ $post->user->name }}
                            | {{ date('M j, Y', strtotime($post->created_at)) }}</div>
                        <p class="card-text mb-auto">{{ substr(html_entity_decode(strip_tags($post->content), ENT_QUOTES), 0, 250) }} {{ strlen(html_entity_decode(strip_tags($post->content), ENT_QUOTES)) > 250 ? "..." : ""}}</p>
                        @if(auth()->check())
                            <a type="submit" class="btn btn-success mt-2" href="{{ route('blog.single', $post->id) }}"
                               style="font-family: Montserrat; font-size: 16px">View post</a>
                        @endif
                    </div>

                @endforeach
        </div>
        <hr>
    </div>
@endsection
