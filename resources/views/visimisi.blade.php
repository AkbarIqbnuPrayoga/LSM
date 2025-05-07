@extends('index')
@section('content')
    <section id="about" class="about section-bg">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
          <h2>Profile</h2>
          <h3>Visi <span>Misi</span></h3>
          <p>Dengan berdirinya LSP Lembaga Pengembangan dan Konsultasi Nasional kami berharap dapat meningkatkan kualitas SDM Pengadaan Barang/Jasa.</p>
        </div>

        <div class="row">
          <div class="col-lg-6 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
            {{-- <img src="{{ asset('biz') }}/assets/img/about.jpg" class="img-fluid" alt=""> --}}
            <img src="{{ asset('images') }}/home/visi.png" class="img-fluid" alt="">

          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <h3>Visi</h3>
            <p class="fst-italic">
                Menjadi organisasi terpercaya dan mitra bagi semua pihak dalam membangun sumber daya manusia melalui pendidikan dan Sertifikasi.
            </p>
            <hr>
            <h3>Misi</h3>
            <ol class="nomor-list-warna-birutua kata">
                <li class="mb-2">Mengembangkan jaringan kerjasama secara berkesinambungan</li>
                <li class="mb-2">Melakukan peningkatan kualitas produk melalui berbagai riset dan analisa potensi pasar pemerintah dan swasta</li>
                <li class="mb-2">Membangun organisasi dan manajemen yang handal</li>
                <li class="mb-2">Menguatkan citra perusahaan sebagai organisasi yang kuat dan kredibel</li>
                <li class="mb-2">Meningkatkan jaringan informasi, penguatan manajemen data dan pemanfaatan teknologi</li>
            </ol>

          </div>
        </div>

      </div>
    </section>

@endsection
