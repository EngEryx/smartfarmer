<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Smart Farmer</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('chemicals')}}">
                        Agro-Chemicals
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('fertilisers')}}">
                        Fertilisers
                    </a>
                </li>
                <li class="nav-item active">
                    @if(auth()->guest())
                        <a class="nav-link" href="{{url('login')}}">
                            Login
                        </a>
                        <a class="nav-link" href="{{url('register')}}">
                            Register
                        </a>
                        @else
                        <a class="nav-link" href="{{url('home')}}">
                             View Dashboard - {{auth()->user()->name}}
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
