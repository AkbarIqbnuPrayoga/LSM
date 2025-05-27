@extends('index')
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>LSM</h1>
            <h2>Latih Skill Mu Dengan Mendaftar Kompetensi Bersetifikat di LSM</h2>
            <div class="d-flex">
            <a href="#portfolio" class="btn-get-started scrollto">Get Started</a>
            <a href="https://www.youtube.com/watch?" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">
              <!-- ======= Featured Services Section ======= -->
              <section id="team" class="team section-bg py-5">
                  <div class="container" data-aos="fade-up">
                      <div class="section-title text-center mb-5">
                          <h2>Daftar</h2>
                          <h3>Skema <span>Pendaftaran</span></h3>
                          <p>Latih Skill Mu Dengan Mendaftar Kompetensi Bersetifikat di LSM</p>
                      </div>

                          <div class="d-flex flex-wrap justify-content-center align-items-center">
                              {{-- Langkah 1 --}}
                              <div class="text-center me-3">
                                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                      style="width: 120px; height: 120px;">
                                      <span>Login</span>
                                  </div>
                              </div>
                              <i class="bi bi-arrow-right fs-2 me-3"></i>

                              {{-- Langkah 2 --}}
                              <div class="text-center me-3">
                                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center text-center"
                                      style="width: 120px; height: 120px;">
                                      <span>Pilih<br>Pelatihan</span>
                                  </div>
                              </div>
                              <i class="bi bi-arrow-right fs-2 me-3"></i>

                              {{-- Langkah 3 --}}
                              <div class="text-center me-3">
                                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center text-center"
                                      style="width: 120px; height: 120px;">
                                      <span>Daftar<br>Pelatihan</span>
                                  </div>
                              </div>
                              <i class="bi bi-arrow-right fs-2 me-3"></i>

                              {{-- Langkah 4 --}}
                              <div class="text-center me-3">
                                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center text-center"
                                      style="width: 120px; height: 120px;">
                                      <span>Pembayaran</span>
                                  </div>
                              </div>
                              <i class="bi bi-arrow-right fs-2 me-3"></i>

                              {{-- Langkah 5 --}}
                              <div class="text-center me-3">
                                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center text-center"
                                      style="width: 120px; height: 120px;">
                                      <span>Mengikuti<br>Pelatihan</span>
                                  </div>
                              </div>
                              <i class="bi bi-arrow-right fs-2 me-3"></i>

                              {{-- Langkah 6 --}}
                              <div class="text-center">
                                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center text-center"
                                      style="width: 120px; height: 120px;">
                                      <span>Sertifikat</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
              <!-- ======= END Featured Services Section ======= -->


        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients section-bg">
          <div class="container" data-aos="zoom-in">

          <div class="section-title">
                    <h2>Sponsor</h2>
                    <h3>Sponsor <span>Website</span></h3>
                </div>

            <div class="row">

              <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('biz') }}/assets/img/clients/client-1.png" class="img-fluid" alt="">
              </div>

              <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('biz') }}/assets/img/clients/client-2.png" class="img-fluid" alt="">
              </div>

              <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('biz') }}/assets/img/clients/client-3.png" class="img-fluid" alt="">
              </div>

              <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('biz') }}/assets/img/clients/client-4.png" class="img-fluid" alt="">
              </div>

              <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('biz') }}/assets/img/clients/client-5.png" class="img-fluid" alt="">
              </div>

              <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('biz') }}/assets/img/clients/client-6.png" class="img-fluid" alt="">
              </div>

            </div>

          </div>
        </section><!-- End Clients Section -->

        <!-- ======= Daftar Pelatihan Section ======= -->
        <section id="portfolio" class="portfolio">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Pelatihan</h2>
              <h3>Berbagai <span>Pelatihan</span></h3>
              <p>Daftar Pelatihan</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
              <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                  <li data-filter="*" class="filter-active">All</li>
                  <li data-filter=".filter-online">Online</li>
                  <li data-filter=".filter-offline">Offline</li>
                  <li data-filter=".filter-hybrid">Hybrid</li>
                </ul>
              </div>
            </div>

          <!-- ISI Daftar Pelatihan -->
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
              @foreach($pelatihan as $item)
    <div class="col-lg-4 col-md-6 portfolio-item filter-{{ strtolower($item->tag) }}">
        <a href="{{ route('pelatihan.show', $item->id) }}">
            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid" alt="Gambar Pelatihan">
        </a>
        <div class="portfolio-info">
            <h4>{{ $item->nama }}</h4>
            <p>{{ ucfirst($item->tag) }}</p>
            <a href="{{ asset('storage/' . $item->gambar) }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="{{ $item->nama }}"><i class="bx bx-plus"></i></a>
            <a href="{{ route('pelatihan.show', $item->id) }}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
        </div>
    </div>
@endforeach
            </div>
        <!-- End Daftar Pelatihan -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Team</h2>
              <h3>Our Hardworking <span>Team</span></h3>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>

            <div class="row">

              <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                  <div class="member-img">
                    <img src="{{ asset('biz') }}/assets/img/team/team-1.jpg" class="img-fluid" alt="">
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="member-info">
                    <h4>Julius Juan</h4>
                    <span>Sesepuh</span>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                  <div class="member-img">
                    <img src="{{ asset('biz') }}/assets/img/team/team-1.jpg" class="img-fluid" alt="">
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="member-info">
                    <h4>Akbar Iqbnu Prayoga</h4>
                    <span>Sepuh Minkrep</span>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                  <div class="member-img">
                    <img src="{{ asset('biz') }}/assets/img/team/team-1.jpg" class="img-fluid" alt="">
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="member-info">
                    <h4>Ifhal Faizi</h4>
                    <span>Sepuh GPT</span>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                <div class="member">
                  <div class="member-img">
                    <img src="{{ asset('biz') }}/assets/img/team/team-1.jpg" class="img-fluid" alt="">
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="member-info">
                    <h4>Bryan</h4>
                    <span>Sepuh Gamedev</span>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </section>
        <!-- End Team Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>F.A.Q</h2>
              <h3>Frequently Asked <span>Questions</span></h3>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>

            <div class="row justify-content-center">
              <div class="col-xl-10">
                <ul class="faq-list">

                  <li>
                    <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                      </p>
                    </div>
                  </li>

                </ul>
              </div>
            </div>

          </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Contact</h2>
              <h3><span>Contact Us</span></h3>
              <p>Untuk Info Lebih Lanjut Bisa Menghubungi Kontak Yang Tersedia</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
              <div class="col-lg-6">
                <div class="info-box mb-4">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p>Jalan Letjen S. Parman No. 1 Tomang, Grogol petamburan, Jakarta 11440, Indonesia</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-6">
                <div class="info-box  mb-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p>Sepuh@Mikir.com</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-6">
                <div class="info-box  mb-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p>+62 888 8118 8118</p>
                </div>
              </div>

            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

              <div class="col-lg-6 ">
                <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d17044.460434637043!2d106.7891!3d-6.169467!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMTAnMTAuMSJTIDEwNsKwNDcnMjAuOCJF!5e1!3m2!1sen!2sus!4v1746584175470!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>

              <div class="col-lg-6">
                <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                  <div class="row">
                    <div class="col form-group">
                      <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                    </div>
                    <div class="col form-group">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                  </div>
                  <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>
                  <div class="text-center"><button type="submit">Send Message</button></div>
                </form>
              </div>

            </div>

          </div>
        </section><!-- End Contact Section -->

      </main><!-- End #main -->

@endsection