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
                    <a class="nav-link" href="{{url('machinery')}}">
                        Machinery
                    </a>
                </li>
                @if(auth()->check())
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('feedback')}}">
                            Feedback
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @if(auth()->user()->user_type == 0)
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('admin/dashboard')}}">
                                Admin Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('frontend.booking.view-cart')}}">
                            View Cart (
                            @if(session()->exists('customer_cart'.auth()->user()->id))
                                {{ count(session()->get('customer_cart'.auth()->user()->id)) }}
                            @else
                                0
                            @endif

                            )
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
