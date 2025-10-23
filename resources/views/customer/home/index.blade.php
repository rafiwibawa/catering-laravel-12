@extends('customer.layouts.app')

@section('content')

{{-- <section class="offer_section layout_padding-bottom">
  <div class="offer_container">
    <div class="container ">
      <div class="row">
        @foreach ($menu as $item)
          <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
                <img src="{{ asset('customer/images/o1.jpg') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  {{$item->name}}
                </h5>
                <h6>
                  <span>{{$item->diskon}} %</span> Off
                </h6>
                <a href="menu/add-to-cart/{{ $item->id }}" class="add-to-cart" data-name="{{ $item->name }}" data-price="{{ $item->price }}"> Order Now
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20l44 0 0 44c0 11 9 20 20 20s20-9 20-20l0-44 44 0c11 0 20-9 20-20s-9-20-20-20l-44 0 0-44c0-11-9-20-20-20s-20 9-20 20l0 44-44 0c-11 0-20 9-20 20z"/>
                  </svg>
                </a>
              </div>
            </div>
          </div> 
        @endforeach
      </div>
    </div>
  </div>
</section> --}}
 <!-- end offer section -->
 
<!-- about section -->
<section class="about_section layout_padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="{{ asset('customer/images/nasi-box.png')}}" alt="">
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
 
  <!-- client section -->
  <section class="client_section layout_padding-bottom mt-4">
    <div class="container">
      <div class="heading_container heading_center psudo_white_primary mb_45">
        <h2>
          Apa Kata Pelanggan Kami
        </h2>
      </div>
      <div class="carousel-wrap row ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Makanannya enak-enak dan porsinya pas! Saya pesan nasi box untuk acara kantor, semua rekan kerja puas. Terima kasih Rumah Makan Anni!
                </p>
                <h6>
                  Andini Puspita
                </h6>
                <p>
                  Jakarta
                </p>
              </div>
              <div class="img-box">
                <img src="{{ asset('customer/images/client1.jpg') }}" alt="" class="box-img">
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Layanan prasmanannya rapi dan tepat waktu. Makanan disajikan hangat dan beragam, tamu undangan di acara pernikahan saya sangat senang.
                </p>
                <h6>
                  Budi Santoso
                </h6>
                <p>
                  Bekasi
                </p>
              </div>
              <div class="img-box">
                <img src="{{ asset('customer/images/client2.jpg') }}" alt="" class="box-img">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  

  
@endsection

@push('slider')
@include('customer.home.slider')
@endpush

@push('script')
@include('customer.home.script')
@endpush