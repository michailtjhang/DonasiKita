<!-- Navbar Section -->
<section id="navbar" class="px-5">

    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top px-5 py-3">
        <div class="container d-flex align-items-center">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/images/logo-navbar.svg" alt="" srcset="" class="logo-brand img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == '') active @endif" aria-current="page"
                            href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}"
                            href="{{ url('/about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == 'donations') active @endif"
                            href="{{ route('donations') }}">Donation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == 'events') active @endif"
                            href="{{ route('events') }}">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::segment(1) == 'blog' || Request::segment(1) == 'blogs') active @endif"
                            href="{{ route('blog') }}">Blogs & Article</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="dropbtn bg-light"><img src="https://www.w3schools.com/w3images/avatar2.png"
                                        alt="Avatar" class="avatar"></button>
                                <div class="dropdown-content bg-light profile-dropdown bg-light px-2 py-2">
                                    <hr class="dropdown-divider">
                                    <div class="text-center">
                                        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar"
                                            class="avatar mb-2">
                                    </div>
                                    <div class="text-center px-2 mb-2">
                                        <p class="text-dark text-large">{{ Auth::user()->name }}</p>
                                    </div>
                                    <hr class="dropdown-divider">
                                    <div class="text-center px-2 mb-3">
                                        <a href="{{ route('logout') }}" class="btn btn-primary w-100">See Profile</a>
                                    </div>
                                    <div class="text-center px-2">
                                        <a href="{{ route('logout') }}" class="btn btn-primary w-100">Logout Account</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="nav-item p-2">
                            <a href="{{ route('login') }}" class="btn btn-primary" href="#">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-primary" href="#">
                                Signup
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</section>

<!-- End Navbar Section -->
@Auth
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropbtn = document.querySelector('.dropbtn');
            const dropdownContent = document.querySelector('.dropdown-content');

            // Toggle dropdown visibility on button click
            dropbtn.addEventListener('click', () => {
                dropdownContent.classList.toggle('show');
            });

            // Close dropdown if clicked outside
            document.addEventListener('click', (event) => {
                if (!dropbtn.contains(event.target) && !dropdownContent.contains(event.target)) {
                    dropdownContent.classList.remove('show');
                }
            });
        });
    </script>
@endAuth
