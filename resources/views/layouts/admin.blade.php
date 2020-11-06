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
                        <img src="/images/ic_admin.png" alt="" class="my-4" style="width: 75px" />
                    </a>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin-dashboard') }}" class="list-group-item list-group-item-action {{ (request()->is('admin')) ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == 'category') ? 'active' : '' }}">Categories</a>
                    <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == 'product') ? 'active' : '' }}">Products</a>
                    <a href="{{ route('gallery.index') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == 'gallery') ? 'active' : '' }}">Galleries</a>
                    <a href="/dashboard-settings.html" class="list-group-item list-group-item-action">Transactions</a>
                    <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action {{ (Request::segment(2) == 'user') ? 'active' : '' }}">Users</a>
                </div>
            </div>
            <!-- /sidebar-wrapper -->

            {{-- Navbar --}}
            <div id="page-content-wrapper">
                <nav class="navbar navbar-store navbar-expand-lg navbar-light fixed-top" data-aos="fade-down">
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
                                    Hi, {{ Auth()->user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/index.html">Back to Store</a>
                                    <a class="dropdown-item" href="/dashboard-account.html">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </div>
                            </li>
                        </ul>

                        <!-- Mobile Menu -->
                        <ul class="navbar-nav d-block d-lg-none mt-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Hi, {{ Auth()->user()->name }}
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