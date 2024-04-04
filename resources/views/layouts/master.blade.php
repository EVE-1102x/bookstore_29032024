<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- font awesome CDN -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <!--Styles-->
    <link rel="stylesheet" href="{{ asset('assets/css/adminStyles.css')  }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<!--NavBar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold tex t-uppercase" href="#">BookStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!--OffCanvas-->
                <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="bi bi-menu-up" style="font-size: 1rem;"></i>
                </a>
            </ul>

        <!--search Bar-->
            <form class="d-flex ms-auto" role="search">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <ul class="navbar-nav mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle" style="font-size: 2rem; color: cornflowerblue;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--OffCanvas-->
<div class="offcanvas offcanvas-start bg-dark text-light" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
            <ul class="navbar-nav" style="font-size: 1.3rem;">
                <!--Dashboard-->
                <li>
                    <a href="/admin/dashboard" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="bi bi-speedometer2"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!--Categories-->
                <li>
                    <a href="/admin/categories" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="bi bi-folder-fill"></i>
                        </span>
                        <span>Categories</span>
                    </a>
                </li>

                <!--Authors-->
                <li>
                    <a href="/admin/authors" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="fa-solid fa-user-pen"></i>
                        </span>
                        <span>Authors</span>
                    </a>
                </li>

                <!--Books-->
                <li>
                    <a href="/admin/books" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="fa-solid fa-book"></i>
                        </span>
                        <span>Books</span>
                    </a>
                </li>

                <!--Publishers-->
                <li>
                    <a href="/admin/publishers" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                        <span>Publishers</span>
                    </a>
                </li>

                <!--Employee-->
                <li>
                    <a href="/admin/employees" class="nav-link px-3 active">
                        <span class="me-2">
                             <i class="bi bi-person-vcard-fill"></i>
                        </span>
                        <span>Employees</span>
                    </a>
                </li>

                <!--Customer-->
                <li>
                    <a href="/admin/customers" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <span>Customers</span>
                    </a>
                </li>

                <!--Order-->
                <li>
                    <a href="/admin/orders" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="bi bi-receipt"></i>
                        </span>
                        <span>Orders</span>
                    </a>
                </li>

                <!--Charts-->
                <li>
                    <a href="/admin/charts" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="bi bi-bar-chart-fill"></i>
                        </span>
                        <span>Charts</span>
                    </a>
                </li>
                <li>
                    <!-- Horizontal divider with custom thickness and color -->
                    <hr class="border-top border-2 border-light">
                </li>

                <!--Website-->
                <li>
                    <a href="/" class="nav-link px-3 active">
                        <span class="me-2">
                            <i class="bi bi-house-gear-fill"></i>
                        </span>
                        <span>Website</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!--Main-->
<main class="mt-5 pt-3 bg-dark main">
    @yield('content')
</main>

@include('layouts.admin-footer')

<!-- Script -->
</body>
</html>







