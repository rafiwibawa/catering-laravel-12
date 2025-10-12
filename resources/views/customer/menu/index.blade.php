@extends('customer.layouts.app')

@section('content')

<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Our Menu</h2>
    </div>

    <!-- Trigger Button -->
    <div class="text-center mt-4 mb-4">
      <button type="button" 
              onclick="document.getElementById('searchModal').style.display='flex'"
              style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border: none; padding: 14px 28px; border-radius: 12px; font-weight: 600; font-size: 16px; color: #1f2937; box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4); transition: all 0.3s ease; cursor: pointer;"
              onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(251, 191, 36, 0.5)'"
              onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(251, 191, 36, 0.4)'">
          <svg style="width: 18px; height: 18px; display: inline-block; vertical-align: middle; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
          Cari Menu by Budget
      </button>
    </div>

    {{-- Informasi Harga Maksimum --}}
    @if (request()->has('budget') && request()->has('quantity'))
      @php
        $maxPricePerItem = floor(request('budget') / max(request('quantity'), 1));
      @endphp
      <div class="alert alert-info text-center mt-2">
        Maksimum harga per box: <strong>Rp {{ number_format($maxPricePerItem, 0, ',', '.') }}</strong>
      </div>
    @endif

    {{-- Kategori --}}
    <ul class="filters_menu" id="menu-filters">
      <li class="active" data-filter="*">All</li> 
      @foreach ($data['category'] as $item)
        <li data-filter=".category-{{ $item->id }}">{{ $item->name }}</li>
      @endforeach
    </ul>

    {{-- Menu --}}
    <div class="filters-content">
      <div class="row grid">
        @forelse ($data['menu'] as $item)
          <div class="col-sm-6 col-lg-4 all category-{{ $item->category_id }}">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('storage/' . $item->image) }}" alt="">
                </div>
                <div class="detail-box">
                  <h5>{{ $item->name }}</h5>
                  <p>{{ $item->description }}</p>
                  <div class="options">
                    <h6>Rp {{ number_format($item->price, 0, ',', '.') }}</h6>
                    <a href="menu/add-to-cart/{{ $item->id }}" class="add-to-cart" data-name="{{ $item->name }}" data-price="{{ $item->price }}">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20l44 0 0 44c0 11 9 20 20 20s20-9 20-20l0-44 44 0c11 0 20-9 20-20s-9-20-20-20l-44 0 0-44c0-11-9-20-20-20s-20 9-20 20l0 44-44 0c-11 0-20 9-20 20z"/>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <p>Tidak ditemukan menu yang sesuai dengan budget dan jumlah box.</p>
          </div>
        @endforelse
      </div>
    </div>

    <div class="btn-box">
      <a href="">
        View More
      </a>
    </div>
  </div>
</section>

@include('customer.menu.modal')
@endsection

@push('style')
  @include('customer.menu.css')
@endpush

@push('script')
  @include('customer.menu.script')
@endpush
