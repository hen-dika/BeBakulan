<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @include('includes.style')
    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <a href="{{ route('home') }}">
                        <img src="/images/dashboard-store-logo.svg" alt="" class="my-4" />
                    </a>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == '') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('dashboard-product') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == 'product') ? 'active' : '' }}">My Products</a>
                    <a href="{{ route('dashboard-transaction') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == 'transaction') ? 'active' : '' }}">Transactions</a>
                    <a href="{{ route('dashboard-setting-store') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == 'setting') ? 'active' : '' }}">Store Settings</a>
                    <a href="{{ route('dashboard-setting-account') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == 'account') ? 'active' : '' }}">My Account</a>
                </div>
            </div>
            <!-- /sidebar-wrapper -->

            {{-- Navbar --}}
            <div id="page-content-wrapper">
                <nav class="navbar navbar-store navbar-expand-lg navbar-light fixed-top" data-aos="fade-down">
                    
                    {{-- Mobile view --}}
                    <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                        &laquo; Menu
                    </button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto d-none d-lg-flex">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    <img src="/images/icon-user.png" alt="" class="rounded-circle mr-2 profile-picture"/>
                                    Hi, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">Back to Store</a>
                                    <a class="dropdown-item" href="{{ route('dashboard-setting-account') }}">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                    @php
                                        $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                                    @endphp

                                    @if($carts > 0)
                                        <img src="/images/icon-cart-filled.svg" alt="" />
                                        <div class="cart-badge">{{ $carts }}</div>
                                    @else
                                        <img src="/images/icon-cart-empty.svg" alt="" />
                                    @endif
                                </a>
                            </li>
                        </ul>

                        <!-- Mobile Menu -->
                        <ul class="navbar-nav d-block d-lg-none mt-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Hi, {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cart') }}">
                                    @php
                                        $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                                    @endphp
                                    @if($carts > 0)
                                        <img src="/images/icon-cart-filled.svg" alt="" />
                                        <div class="cart-badge">{{ $carts }}</div>
                                    @else
                                        <img src="/images/icon-cart-empty.svg" alt="" />
                                    @endif   
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>
                {{-- /navbar --}}

                <!-- Page Content -->
                @yield('content')
                <!-- /page-content-wrapper -->
            </div>
        </div>
    </div>

    @include('includes.script')  
    @stack('addon-script')
</body>
</html>
