
<footer class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4" style="background-color: black">
        <div class="row align-items-center h-100">
            <div class="col-md-3 text-center">
                <img src="{{asset('growth.png')}}" alt="logo" width="75" height="50">
                <h1 style="color: #41A317; font-family: Montserrat">Investing</h1>
            </div>
            <div class="col-sm-5 col-md-4 py-4">
                <h4 style="color: #41A317; font-family: Montserrat">About us</h4>
                <p class="text-muted" style="font-family: Montserrat">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
                <h4 style="color: #41A317; font-family: Montserrat">Quick links</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group item"><a class="text-muted" href="{{ route('home.index') }}" style="font-family: Montserrat">Home</a></li>
                    <li class="list-group item"><a class="text-muted" href="{{ route('blog.index') }}" style="font-family: Montserrat">Blog</a></li>
                    @if( auth()->check() )
                        <li class="list-group item"><a class="text-muted" href="{{ route('posts.index') }}" style="font-family: Montserrat">My posts</a></li>
                    @endif
                    <li class="list-group item"><a class="text-muted" href="{{ route('about') }}" style="font-family: Montserrat">About us</a></li>
                </ul>
            </div>
        </div>
</footer>

