@extends('index')
@section('content')
<section id="contact" class="contact">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Contact</h2>
              <h3><span>Contact Us</span></h3>
              <p>Untuk Info Lebih Lanjut Bisa Menghubungi Kontak Yang Tersedia.</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
              <div class="col-lg-6">
                <div class="info-box mb-4">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p>Jalan Letjen S. Parman No. 1 Tomang, Grogol petamburan, Jakarta 11440, Indonesia<</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-6">
                <div class="info-box  mb-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p>Admin@LSM.com</p>
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
              <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1065.0990401574793!2d106.93661892847962!3d-6.258261666493604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMTUnMjkuOCJTIDEwNsKwNTYnMTQuMiJF!5e1!3m2!1sid!2sid!4v1746626762247!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
        </section>
@endsection
