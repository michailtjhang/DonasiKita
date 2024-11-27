<!-- Navbar Section -->
<section id="navbar" class="px-5">

    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top px-5 py-3">
        <div class="container d-flex align-items-center">

            <a class="navbar-brand" href="#">
                <img src="/images/logo-navbar.svg" alt="" srcset="" class="logo-brand img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page" href="{{url('/home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{url('/about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Donation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('event') ? 'active' : '' }}" href="{{url('/event')}}">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog & Article</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="dropbtn bg-light"><img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar"></button>
                            <div class="dropdown-content bg-light profile-dropdown bg-light px-2 py-2">
                                <hr class="dropdown-divider">
                                <div class="text-center">
                                    <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar mb-2">
                                </div>
                                <div class="text-center px-2 mb-2">
                                    <p class="text-dark text-large">Amanda Jonas</p>
                                </div>
                                <hr class="dropdown-divider">
                                <div class="text-center px-2">
                                    <a class="btn btn-primary w-100">Logout Account</a>
                                </div>
                            </div>
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