<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">eSalon Admin</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                {{--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>--}}
                </li>
                <li><a href="{{url('/')}}" target="_blank"><i class="fa fa-gear fa-fw"></i> Client Area</a>
                </li>
                <li class="divider"></li>
                <li>
                    {{--<a href="{{url('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>--}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li>
                    <a href="{{url('admin/customers')}}"><i class="fa fa-users"></i> Customers</a>
                </li>
                <li>
                    <a href="{{url('admin/products')}}"><i class="fa  fa-cart-plus"></i> Products</a>
                </li>
                <li>
                    <a href="{{url('admin/bookings')}}"><i class="fa fa-bookmark"></i> Bookings</a>
                </li>
                <li>
                    <a href="{{url('admin/payments')}}"><i class="fa fa-money"></i> Payments</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
