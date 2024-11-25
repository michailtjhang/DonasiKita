<!-- Navbar Section -->
<section id="navbar" class="px-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top px-5 py-3">
        <div class="container-fluid spacer-x-v2 align-items-center">
            <a class="navbar-brand" href="#">
                <img src="/images/logo-navbar.svg" alt="" srcset="" class="logo-brand img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page" href="{{url('/home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{url('/about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == 'donation') active @endif"
                            href="{{ route('donation') }}">Donation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == 'blog') active @endif"
                            href="{{ route('blog') }}">Blogs & Article</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown bg-light">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar">
                            </button>
                            <ul class="dropdown-menu profile-dropdown bg-light px-2" aria-labelledby="dropdownMenuButton">
                                <hr class="dropdown-divider">
                                <li class="text-center">
                                    <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar mb-2">
                                </li>
                                <li class="text-center px-2 mb-2">
                                    <p class="text-dark text-large">Amanda Jonas</p>
                                </li>
                                <hr class="dropdown-divider">
                                <li class="text-center px-2">
                                    <a class="btn btn-primary w-100">Logout Account</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- uncomment jika belum login -->
                    <!-- <li class="nav-item">
                    <a class="btn btn-primary" href="#">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary" href="#">
                        Signup
                    </a>
                </li> -->
                </ul>
            </div>
        </div>
    </nav>
</section>
<!-- End Navbar Section -->