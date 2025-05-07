@extends('index')
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>LSM</h1>
            <h2>Latih Skill Mu</h2>
            <div class="d-flex">
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        <section id="counts" class="counts">
            <div class="container aos-init aos-animate" data-aos="fade-up">

              <div class="row">

                <div class="col-lg-3 col-md-6">
                  <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="0" class="purecounter">232</span>
                    <p>Skema Sertifikasi</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                  <div class="count-box">
                    <i class="bi bi-journal-richtext"></i>
                    <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="0" class="purecounter">521</span>
                    <p>Asesor Kompetensi</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                  <div class="count-box">
                    <i class="bi bi-headset"></i>
                    <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="0" class="purecounter">1463</span>
                    <p>Pemegang Sertifikat</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                  <div class="count-box">
                    <i class="bi bi-people"></i>
                    <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="0" class="purecounter">15</span>
                    <p>Tempat Uji Kompetensi</p>
                  </div>
                </div>

              </div>

            </div>
        </section>
        <section id="team" class="team section-bg">
            <div class="container aos-init aos-animate" data-aos="fade-up">

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
                      <h4>Procurement Staff</h4>
                      <span>Chief Executive Officer</span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                  <div class="member">
                    <div class="member-img">
                      <img src="{{ asset('biz') }}/assets/img/team/team-2.jpg" class="img-fluid" alt="">
                      <div class="social">
                        <a href=""><i class="bi bi-twitter"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                      </div>
                    </div>
                    <div class="member-info">
                      <h4>Procurement Senior Staff</h4>
                      <span>Product Manager</span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                  <div class="member">
                    <div class="member-img">
                      <img src="{{ asset('biz') }}/assets/img/team/team-3.jpg" class="img-fluid" alt="">
                      <div class="social">
                        <a href=""><i class="bi bi-twitter"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                      </div>
                    </div>
                    <div class="member-info">
                      <h4>Procurement Coordinator</h4>
                      <span>CTO</span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                  <div class="member">
                    <div class="member-img">
                      <img src="{{ asset('biz') }}/assets/img/team/team-4.jpg" class="img-fluid" alt="">
                      <div class="social">
                        <a href=""><i class="bi bi-twitter"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                      </div>
                    </div>
                    <div class="member-info">
                      <h4>Amanda Jepson</h4>
                      <span>Accountant</span>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </section>

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
          <div class="container" data-aos="fade-up">
            <div class="row d-flex justify-content-center">
              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon"><i class="bx bxl-dribbble"></i></div>
                  <h4 class="title"><a href="">Procurement Staff</a></h4>
                  <p class="description">karyawan perusahan yang bertanggung jawab dalam bidang procurement atau pengadaan barang/jasa di perusahaan</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon"><i class="bx bx-file"></i></div>
                  <h4 class="title"><a href="">Procurement Senior Staff</a></h4>
                  <p class="description">karyawan Senior perusahan yang bertanggung jawab dalam bidang procurement atau pengadaan barang/jasa di perusahaan</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon"><i class="bx bx-tachometer"></i></div>
                  <h4 class="title"><a href="">Procurement Coordinator</a></h4>
                  <p class="description">Memastikan pasokan barang dan jasa tidak terganggu sesuai dengan jadwal yang ditetapkan dalam rencana aksi pengadaan.</p>
                </div>
              </div>


            </div>
            <br>
            <div class="row d-flex justify-content-center">
              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon"><i class="bx bxl-dribbble"></i></div>
                  <h4 class="title"><a href="">Procurement Supervisor</a></h4>
                  <p class="description">Memastikan pembelian barang dan jasa yang berhubungan dengan kegiatan produksi dan pemeliharaan barang jadi dari pemasok yang telah ditentukan.</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon"><i class="bx bx-file"></i></div>
                  <h4 class="title"><a href="">Procurement Assistant Manager</a></h4>
                  <p class="description">Membantu manager perusahaan dan stafnya mematuhi strategi pembelian barang dan jasa tertentu</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon"><i class="bx bx-tachometer"></i></div>
                  <h4 class="title"><a href="">Procurement Manager</a></h4>
                  <p class="description">Memastikan perusahaan dan stafnya mematuhi strategi pembelian barang dan jasa tertentu</p>
                </div>
              </div>


            </div>

          </div>
        </section><!-- End Featured Services Section -->



      </main><!-- End #main -->

@endsection
