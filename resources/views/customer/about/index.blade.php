@extends('customer.layouts.app')

@section('content')
 
 
  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="{{ asset('customer/images/nasi-box.png') }}" alt="">
          </div>
        </div>
        <div class="col-md-6">
            <div class="detail-box">
                <div class="heading_container">
                  <h2>
                    Tentang Rumah Makan Anni
                  </h2>
                </div>
                <p>
                  Rumah Makan Anni adalah pilihan tepat untuk Anda yang mencari layanan makanan lezat dan terpercaya. Kami menyediakan layanan catering untuk berbagai acara, mulai dari nasi box praktis hingga prasmanan lengkap dengan menu khas rumahan yang menggugah selera. Kepuasan pelanggan adalah prioritas kami.
                </p>
                <a href="">
                  Selengkapnya
                </a>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->
  
@endsection 
 