@extends('index')
@section('content')
    @push('styles')
        <style>
            .contact-form {
                max-width: 720px;
                padding: 40px 30px;
                background: #ffffff;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
                font-family: 'Segoe UI', sans-serif;
                transition: all 0.3s ease;
            }

            .contact-form .form-row {
                display: flex;
                flex-wrap: wrap;
                gap: 24px;
                margin-bottom: 20px;
            }

            .contact-form .form-group {
                flex: 1 1 45%;
                display: flex;
                flex-direction: column;
            }

            .contact-form input,
            .contact-form textarea {
                padding: 14px 16px;
                border: 2px solid #ccc;
                border-radius: 10px;
                font-size: 16px;
                transition: all 0.3s ease;
                background-color: #f7f9fc;
                margin-top: 6px;
            }

            .contact-form input:focus,
            .contact-form textarea:focus {
                outline: none;
                border-color: #007bff;
                box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
                background-color: #fff;
            }

            .contact-form textarea {
                resize: vertical;
                min-height: 150px;
            }

            .contact-form .form-submit {
                text-align: center;
                margin-top: 30px;
            }

            .contact-form button {
                background-color: #007bff;
                color: #fff;
                padding: 12px 30px;
                font-size: 16px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background 0.3s ease, transform 0.2s;
            }

            .contact-form button:hover {
                background-color: #0056b3;
                transform: translateY(-2px);
            }

            /* Feedback messages */
            .contact-form .loading,
            .contact-form .error-message,
            .contact-form .sent-message {
                display: none;
                text-align: center;
                margin-top: 20px;
                font-weight: bold;
                font-size: 15px;
            }

            .contact-form .loading.d-block {
                display: block;
                color: #888;
            }

            .contact-form .error-message.d-block {
                display: block;
                color: #dc3545;
            }

            .contact-form .sent-message.d-block {
                display: block;
                color: #28a745;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .contact-form .form-row {
                    flex-direction: column;
                }

                .contact-form .form-group {
                    width: 100%;
                }
            }
        </style>
    @endpush

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>PUSDIKLAT</h1>
            <h2>Pusat Pendidikan Dan Pelatihan Bersertifikat</h2>
            <div class="d-flex">
                <a href="#portfolio" class="btn-get-started scrollto">Get Started</a>
                <a href="https://youtu.be/ko4BCK1H9eA" class="glightbox btn-watch-video"><i
                        class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">
           <!-- ======= Skema Pendaftaran Section ======= -->
        <section id="skema" class="team section-bg py-5">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-6">
            <h2>Daftar</h2>
            <h3>Skema <span>Pendaftaran</span></h3>
            <p>Pusat Pendidikan Dan Pelatihan Bersetifikat</p>
            </div>

            <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="d-flex flex-column flex-md-row flex-wrap justify-content-center align-items-center gap-3">

                <!-- Langkah 1 -->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center bg-primary text-white px-4 py-2 rounded-pill fw-bold">
                    <span class="me-3">1.</span> Login
                    </div>
                    <i class="bi bi-arrow-right mx-2 fs-4 d-none d-md-block"></i>
                </div>

                <!-- Langkah 2 -->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center bg-primary text-white px-4 py-2 rounded-pill fw-bold">
                    <span class="me-3">2.</span> Pilih Pelatihan
                    </div>
                    <i class="bi bi-arrow-right mx-2 fs-4 d-none d-md-block"></i>
                </div>

                <!-- Langkah 3 -->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center bg-primary text-white px-4 py-2 rounded-pill fw-bold">
                    <span class="me-3">3.</span> Daftar Pelatihan
                    </div>
                    <i class="bi bi-arrow-right mx-2 fs-4 d-none d-md-block"></i>
                </div>

                <!-- Langkah 4 -->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center bg-primary text-white px-4 py-2 rounded-pill fw-bold">
                    <span class="me-3">4.</span> Pembayaran
                    </div>
                    <i class="bi bi-arrow-right mx-2 fs-4 d-none d-md-block"></i>
                </div>

                <!-- Langkah 5 -->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center bg-primary text-white px-4 py-2 rounded-pill fw-bold">
                    <span class="me-3">5.</span> Mengikuti Pelatihan
                    </div>
                    <i class="bi bi-arrow-right mx-2 fs-4 d-none d-md-block"></i>
                </div>

                <!-- Langkah 6 -->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center bg-success text-white px-4 py-2 rounded-pill fw-bold">
                    <span class="me-3">6.</span> Sertifikat
                    </div>
                </div>

                </div>
            </div>
            </div>
        </div>
        </section>
        <!-- ======= End Skema Section ======= -->


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
                @foreach ($groupedByMonthYear as $monthYear => $items)
                    <div class="mb-5">
                        <h4 class="text-center mb-4">{{ $monthYear }}</h4>

                        <div class="row" data-aos="fade-up" data-aos-delay="200">
                            @foreach ($items as $item)
                                <div class="col-lg-4 col-md-6 mb-4 portfolio-item filter-{{ strtolower($item->tag) }}"
                                    data-waktu-selesai="{{ \Carbon\Carbon::parse($item->tanggal_selesai . ' ' . $item->waktu_mulai)->toIso8601String() }}">


                                    <div class="card border-0 shadow-sm position-relative overflow-hidden"
                                        onmouseover="this.querySelector('.overlay-info').style.transform='translateY(0)'"
                                        onmouseout="this.querySelector('.overlay-info').style.transform='translateY(100%)'">

                                        {{-- Gambar --}}
                                        <a href="{{ route('pelatihan.show', $item->id) }}">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top"
                                                alt="Gambar Pelatihan">
                                        </a>

                                        {{-- Overlay --}}
                                        <div class="overlay-info position-absolute bottom-0 w-100 bg-dark bg-opacity-75 text-white text-center py-3 px-2"
                                            style="transform: translateY(100%); transition: transform 0.3s;">
                                            <h5 class="mb-1">{{ $item->nama }}</h5>
                                            <p class="mb-2">{{ ucfirst($item->tag) }}</p>
                                            <a href="{{ route('pelatihan.show', $item->id) }}"
                                                class="btn btn-light btn-sm">Selengkapnya</a>
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
                                <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Bagaimana cara
                                    mendaftar pelatihan? <i class="bi bi-chevron-down icon-show"></i><i
                                        class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Anda dapat mendaftar melalui tombol “Daftar” di halaman pelatihan yang diinginkan.
                                        Isi formulir pendaftaran dan ikuti petunjuk selanjutnya.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Apakah
                                    pelatihannya gratis atau berbayar? <i class="bi bi-chevron-down icon-show"></i><i
                                        class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Tergantung jenis pelatihan. Beberapa pelatihan tersedia secara gratis, namun ada
                                        juga yang berbayar. Informasi biaya akan tertera di deskripsi pelatihan.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Apakah saya akan
                                    mendapatkan sertifikat setelah pelatihan? <i
                                        class="bi bi-chevron-down icon-show"></i><i
                                        class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Ya, peserta yang mengikuti pelatihan hingga selesai dan memenuhi syarat akan
                                        mendapatkan sertifikat elektronik.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Pelatihan ini
                                    dilakukan secara online atau offline? <i class="bi bi-chevron-down icon-show"></i><i
                                        class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Informasi metode pelatihan (online, offline, atau hybrid) bisa Anda lihat di
                                        deskripsi masing-masing pelatihan.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Apa syarat untuk
                                    mengikuti pelatihan ini? <i class="bi bi-chevron-down icon-show"></i><i
                                        class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Beberapa pelatihan memiliki syarat tertentu, seperti usia minimum, latar belakang
                                        pendidikan, atau pengalaman. Detail syarat dapat dilihat di halaman pelatihan.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Bagaimana saya
                                    tahu kalau saya sudah terdaftar? <i class="bi bi-chevron-down icon-show"></i><i
                                        class="bi bi-chevron-up icon-close"></i></div>
                                <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Anda akan menerima email konfirmasi setelah berhasil mendaftar. Jika tidak menerima
                                        email dalam 1x24 jam, silakan hubungi tim kami.
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
                            <p>pusdiklat@tarumanagara.ac.id</p>
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

                    <div class="col-lg-6 mb-4">
                        <div class="ratio ratio-4x3">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d17044.460434637043!2d106.7891!3d-6.169467!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMTAnMTAuMSJTIDEwNsKwNDcnMjAuOCJF!5e1!3m2!1sen!2sus!4v1746584175470!5m2!1sen!2sus"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        {{-- ✅ Tambahkan di sini --}}
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- 🔽 Form dimulai di bawah ini --}}
                        <form action="{{ route('contact.send') }}" method="POST" class="contact-form" id="contactForm">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Your Name" 
                                        value="{{ auth()->check() ? auth()->user()->name : old('name') }}" 
                                        {{ auth()->check() ? 'readonly' : '' }} required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Your Email" 
                                        value="{{ auth()->check() ? auth()->user()->email : old('email') }}" 
                                        {{ auth()->check() ? 'readonly' : '' }} required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subjek" placeholder="Subjek" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="form-submit">
                                @if(auth()->check())
                                    <button type="submit">Send Message</button>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login to Send Message</a>
                                @endif
                            </div>
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
                        if (filterValue === '*' || item.classList.contains(filterValue
                                .substring(1))) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Cek tiap container bulan, sembunyikan jika tidak ada item tampil
                    monthContainers.forEach(container => {
                        // Cari semua .portfolio-item dalam container yang tampil
                        const visibleItems = container.querySelectorAll(
                            '.portfolio-item:not([style*="display: none"])');

                        if (visibleItems.length === 0) {
                            container.style.display = 'none'; // sembunyikan container bulan
                        } else {
                            container.style.display = 'block'; // tampilkan container bulan
                        }
                    });
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
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
                filter.addEventListener('click', function() {
                    filters.forEach(el => el.classList.remove('filter-active'));
                    this.classList.add('filter-active');
                    let filterValue = this.getAttribute('data-filter');
                    portfolioIsotope.arrange({
                        filter: filterValue
                    });
                });
            });
        });
    </script>
@endsection
