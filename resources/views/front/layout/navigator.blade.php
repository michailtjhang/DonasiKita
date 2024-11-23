<!-- Navbar Section -->
<section id="navbar" class="px-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top px-5">
        <div class="container-fluid px-5">
            <a class="navbar-brand" href="#">
                <img src="/images/logo-navbar.svg" alt="" srcset="" class="logo-brand img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == '') active @endif" aria-current="page"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == 'about') active @endif"
                            href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == 'donation') active @endif"
                            href="{{ route('donation') }}">Donation</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="">Donation</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == 'event') active @endif"
                            href="{{ route('event') }}">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog & Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="#">
                            <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar">
                        </a>
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