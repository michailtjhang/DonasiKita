<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-white bg-footer pt-4 pb-2 px-3">
    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4">
                    <!-- Content -->
                    <img src="/images/logo-footer.svg" alt="" style="width: 100px;">
                    <p class="mt-3">
                        Bersama Kita Berbagi <br> Bersama Kita Mengubah.
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-2 col-xl-2 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Navigation
                    </h6>
                    <p>
                        <a href="{{ url('/') }}" class="text-reset">Home</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Program</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">BelanjaLokal</a>
                    </p>
                    <p>
                        <a href="{{ route('about') }}" class="text-reset">About Us</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-3 col-xl-3 mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Contact Us</h6>

                    <a href="" class="text-reset">
                        <p><i class="fas fa-envelope me-3"></i> {{ $config['email'] }}</p>
                    </a>
                    <div class="d-flex align-items-center mb-3">
                        <!-- Kolom Kiri -->
                        <div class="me-3">
                            <i class="fas fa-home"></i>
                        </div>

                        <!-- Kolom Kanan -->
                        <div>
                            <p class="mb-0">
                                {{ $config['address'] }}
                            </p>
                        </div>
                    </div>

                    <a href="" class="text-reset py-3 my-3">
                        <p><i class="fas fa-phone me-3"></i> {{ $config['phone'] }}</p>
                    </a>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-2 col-xl-2 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Learn More
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">General Info</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Jobs</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Private Policy</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Terms of Services</a>
                    </p>
                </div>
                <div class="col-md-6 col-lg-2 col-xl-2 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Social
                    </h6>
                    <div>
                        <a href="{{ $config['facebook'] }}" class="me-2 text-reset">
                            <i class="fab rounded fa-facebook-f"></i>
                        </a>
                        <a href="{{ $config['twitter'] }}" class="me-2 text-reset">
                            <i class="fab rounded fa-twitter"></i>
                        </a>
                        <a href="{{ $config['youtube'] }}" class="me-2 text-reset">
                            <i class="fab rounded fa-youtube"></i>
                        </a>
                        <a href="{{ $config['instagram'] }}" class="me-2 text-reset">
                            <i class="fab rounded fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <!-- Grid column -->


            </div>
            <!-- Grid row -->
        </div>
        <p class="text-small text-center text-secondary">
            {!! $config['footer'] !!}
        </p>
    </section>
    <!-- Section: Links  -->
</footer>
<!-- Footer -->

<!-- Whatsapp Icon -->
<a href="https://wa.me/{{ $config['phone'] }}" target="_blank" class="whatsapp-icon">
    <i class="fab fa-whatsapp"></i>
</a>
<!-- Whatsapp Icon -->
