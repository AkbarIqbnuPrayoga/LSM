@extends('index')
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>PUSDIKLAT</h1>
            <h2>Pusat Pendidikan Dan Pelatihan Bersetifikat</h2>
            <div class="d-flex">
            <a href="#portfolio" class="btn-get-started scrollto">Get Started</a>
            <a href="https://youtu.be/ko4BCK1H9eA" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
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
                          <p>Pusat Pendidikan Dan Pelatihan Bersetifikat</p>
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

        <section id="portfolio" class="portfolio">
          <div class="container" data-aos="fade-up">
            <div class="section-title">
              <h2>Pelatihan</h2>
              <h3>Berbagai <span>Pelatihan</span></h3>
              <p>Daftar Pelatihan</p>
            </div>

            {{-- Filter Buttons --}}
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

            {{-- List Pelatihan Berdasarkan Bulan --}}
            @foreach($groupedByMonthYear as $monthYear => $items)
              <div class="mb-5">
                <h4 class="text-center mb-4">{{ $monthYear }}</h4>

                <div class="row" data-aos="fade-up" data-aos-delay="200">
                  @foreach($items as $item)
                    <div 
                        class="col-lg-4 col-md-6 mb-4 portfolio-item filter-{{ strtolower($item->tag) }}"
                        data-waktu-selesai="{{ \Carbon\Carbon::parse($item->tanggal_selesai. ' ' . $item->waktu_mulai)->toIso8601String() }}">

                      
                      <div 
                        class="card border-0 shadow-sm position-relative overflow-hidden" 
                        onmouseover="this.querySelector('.overlay-info').style.transform='translateY(0)'" 
                        onmouseout="this.querySelector('.overlay-info').style.transform='translateY(100%)'">

                        {{-- Gambar --}}
                        <a href="{{ route('pelatihan.show', $item->id) }}">
                          <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="Gambar Pelatihan">
                        </a>

                        {{-- Overlay --}}
                        <div class="overlay-info position-absolute bottom-0 w-100 bg-dark bg-opacity-75 text-white text-center py-3 px-2"
                            style="transform: translateY(100%); transition: transform 0.3s;">
                          <h5 class="mb-1">{{ $item->nama }}</h5>
                          <p class="mb-2">{{ ucfirst($item->tag) }}</p>
                          <a href="{{ route('pelatihan.show', $item->id) }}" class="btn btn-light btn-sm">Selengkapnya</a>
                        </div>

                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach

          </div>
        </section>
        <!-- End Daftar Pelatihan -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>F.A.Q</h2>
              <h3>Frequently Asked <span>Questions</span></h3>
            </div>

            <div class="row justify-content-center">
              <div class="col-xl-10">
                <ul class="faq-list">

                  <li>
                    <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Bagaimana cara mendaftar pelatihan? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Anda dapat mendaftar melalui tombol “Daftar” di halaman pelatihan yang diinginkan. Isi formulir pendaftaran dan ikuti petunjuk selanjutnya.
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Apakah pelatihannya gratis atau berbayar? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Tergantung jenis pelatihan. Beberapa pelatihan tersedia secara gratis, namun ada juga yang berbayar. Informasi biaya akan tertera di deskripsi pelatihan.
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Apakah saya akan mendapatkan sertifikat setelah pelatihan? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Ya, peserta yang mengikuti pelatihan hingga selesai dan memenuhi syarat akan mendapatkan sertifikat elektronik.
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Pelatihan ini dilakukan secara online atau offline? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Informasi metode pelatihan (online, offline, atau hybrid) bisa Anda lihat di deskripsi masing-masing pelatihan.
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Apa syarat untuk mengikuti pelatihan ini? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Beberapa pelatihan memiliki syarat tertentu, seperti usia minimum, latar belakang pendidikan, atau pengalaman. Detail syarat dapat dilihat di halaman pelatihan.
                      </p>
                    </div>
                  </li>

                  <li>
                    <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Bagaimana saya tahu kalau saya sudah terdaftar? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                      <p>
                        Anda akan menerima email konfirmasi setelah berhasil mendaftar. Jika tidak menerima email dalam 1x24 jam, silakan hubungi tim kami.
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('#portfolio-flters li');
  const portfolioItems = document.querySelectorAll('.portfolio-item');
  const monthContainers = document.querySelectorAll('.mb-5');

  filterButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      // Hapus class active dari semua tombol
      filterButtons.forEach(b => b.classList.remove('filter-active'));

      // Tambah class active ke tombol yang diklik
      this.classList.add('filter-active');

      const filterValue = this.getAttribute('data-filter');

      portfolioItems.forEach(item => {
        if (filterValue === '*' || item.classList.contains(filterValue.substring(1))) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });

      // Cek tiap container bulan, sembunyikan jika tidak ada item tampil
      monthContainers.forEach(container => {
        // Cari semua .portfolio-item dalam container yang tampil
        const visibleItems = container.querySelectorAll('.portfolio-item:not([style*="display: none"])');

        if (visibleItems.length === 0) {
          container.style.display = 'none'; // sembunyikan container bulan
        } else {
          container.style.display = 'block'; // tampilkan container bulan
        }
      });
    });
  });
});
document.addEventListener("DOMContentLoaded", function () {
    const sekarang = new Date();

    // 1. Hapus item pelatihan yang sudah selesai
    document.querySelectorAll('.portfolio-item').forEach(card => {
        const waktuSelesaiStr = card.getAttribute('data-waktu-selesai');
        const waktuSelesai = new Date(waktuSelesaiStr);

        if (sekarang >= waktuSelesai) {
            card.remove(); // <-- hapus dari DOM
        }
    });

    // 2. Sembunyikan grup bulan jika semua pelatihannya hilang
    document.querySelectorAll('.mb-5').forEach(group => {
        const visibleItems = group.querySelectorAll('.portfolio-item');
        if (visibleItems.length === 0) {
            group.remove(); // <-- hapus dari DOM juga
        }
    });

    // 3. Jalankan isotope setelah item dihapus
    var portfolioIsotope = new Isotope('.portfolio-container', {
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });

    let filters = document.querySelectorAll('#portfolio-flters li');
    filters.forEach(filter => {
        filter.addEventListener('click', function () {
            filters.forEach(el => el.classList.remove('filter-active'));
            this.classList.add('filter-active');
            let filterValue = this.getAttribute('data-filter');
            portfolioIsotope.arrange({ filter: filterValue });
        });
    });
});
</script>


@endsection