<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    @yield('style')
    <style>
        nav {
            background-color: lavender;
            box-shadow: 3px 3px 8px rgb(174, 173, 173);
        }
        footer {
            background-color: rgb(203, 203, 238);
            margin-top: 40px;
            /* border:1px solid blue; */
            padding: 0 12px;
        }
    </style>
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fst-italic" href="{{url('/')}}"><b>Job Portal</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto">
                    <a href="{{route('news')}}" class="nav-link me-2"><b>News</b></a>
                    @if (Auth::check())
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="spanOne"><b>{{ Auth::user()->name }}</b></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf @method('delete')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @else
                    <a class="nav-link" href="{{route('loginForm')}}"><b>Sign In</b></a>
                    <a class="nav-link" href="{{route('registerForm')}}"><b>Sign Up</b></a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div style="flex: 1;">
        @yield('content')
    </div>

    <!-- Footer Section -->
    <footer class="mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="fw-bold fst-italic" style="font-size: 18px">
                All Rights Reserved &copy; 2023.
            </div>
            <ul style="list-style: none" class="d-flex pt-3 gap-3">
                <li class="fs-5"><i class="bi bi-facebook"></i></li>
                <li class="fs-5"><i class="bi bi-instagram"></i></li>
                <li class="fs-5"><i class="bi bi-twitter"></i></li>
            </ul>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
