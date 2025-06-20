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
@endsection
