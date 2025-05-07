@extends('index')
@section('content')

<section id="team" class="team section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h2>Daftar</h2>
            <h3>Skema <span>Sertifikasi</span></h3>
            <p>Lembaga Sertifikasi Profesi Lembaga Pengembangan dan Konsultasi Nasional</p>
        </div>
        <div class="back-slick">
            <div class="your-schema">
                <div class="p-1 p-md-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                    <div class="member-img">
                        <img src="{{ asset('images') }}/home/1.png" class="img-fluid" alt="">
                        <div class="social schema-more">
                            <a href="{{ route('procurement', 'Procurement Staff') }}">Selengkapnya</i></a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="p-1 p-md-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                    <div class="member-img">
                        <img src="{{ asset('images') }}/home/2.png" class="img-fluid" alt="">
                        <div class="social schema-more">
                            <a href="{{ route('procurement',  'Procurement Senior Staff') }}">Selengkapnya</i></a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="p-1 p-md-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                    <div class="member-img">
                        <img src="{{ asset('images') }}/home/3.png" class="img-fluid" alt="">
                        <div class="social schema-more">
                            <a href="{{ route('procurement',  'Procurement Coordinator') }}">Selengkapnya</i></a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="p-1 p-md-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                    <div class="member-img">
                        <img src="{{ asset('images') }}/home/4.png" class="img-fluid" alt="">
                        <div class="social schema-more">
                            <a href="{{ route('procurement',  'Procurement Supervisor') }}">Selengkapnya</i></a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="p-1 p-md-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                    <div class="member-img">
                        <img src="{{ asset('images') }}/home/5.png" class="img-fluid" alt="">
                        <div class="social schema-more">
                            <a href="{{ route('procurement',  'Procurement Asistant Manager') }}">Selengkapnya</i></a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="p-1 p-md-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                    <div class="member-img">
                        <img src="{{ asset('images') }}/home/6.png" class="img-fluid" alt="">
                        <div class="social schema-more">
                            <a href="{{ route('procurement',  'Procurement Manager') }}">Selengkapnya</i></a>
                        </div>
                    </div>
                    </div>
                </div>


            </div>
            <div class="schema-prev desktop">
                <span><i class="fa-solid fa-angle-left"></i></span>
            </div>
            <div class="schema-next desktop">
                <span><i class="fa-solid fa-angle-right"></i></span>
            </div>
        </div>




    </div>
</section>

@endsection