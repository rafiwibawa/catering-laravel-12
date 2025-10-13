@extends('customer.layouts.app')

@section('content')
<section class="cart_section py-5">
  <div class="container">
    <!-- Header -->
    <div class="row mb-5">
      <div class="col-12 text-center">
        <div class="cart-header"> 
          <h2 class="display-4 fw-bold mb-2">Keranjang Belanja</h1>
          <p class="lead text-muted">Review pesanan Anda sebelum melakukan pembayaran</p>
        </div>
      </div>
    </div>
    
    @if($cart && $cart->cartItems->count() > 0)
    <div class="row g-4">
      <!-- Cart Items Section -->
      <div class="col-xl-8 col-lg-7">
        <div class="cart-items-container">
          <div class="section-header mb-4">
            <h3 class="section-title">
              <span class="title-icon">
                <i class="fa fa-opencart"></i>
              </span>
              Item Pesanan
              <span class="item-count">{{ $cart->cartItems->count() }} item</span>
            </h3>
          </div>

          <div class="cart-items-wrapper">
            @php $grandTotal = 0; @endphp
            @foreach($cart->cartItems as $index => $item)
              @php
                $subtotal = $item->menu->price * $item->quantity;
                $grandTotal += $subtotal;
              @endphp
              <div class="cart-item" data-item="{{ $index }}" data-id="{{ $item->id }}">
                <div class="item-image">
                  @if($item->menu->image)
                    <img src="{{ asset('storage/'.$item->menu->image) }}" 
                         alt="{{ $item->menu->name }}">
                  @else
                    <div class="image-placeholder">
                      <i class="fas fa-image"></i>
                    </div>
                  @endif
                </div>

                <div class="item-details">
                  <div class="item-header">
                    <h4 class="item-name">{{ $item->menu->name }}</h4>
                    <button class="btn-remove" type="button">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                  <p class="item-description">{{ Str::limit($item->menu->description ?? 'Makanan lezat dan bergizi', 60) }}</p>
                  
                  <div class="item-controls">
                    <div class="price-section">
                      <span class="price-label">Harga Satuan</span>
                      <span class="unit-price">Rp{{ number_format($item->menu->price, 0, ',', '.') }}</span>
                    </div>

                    <div class="quantity-section">
                      <span class="quantity-label">Jumlah</span>
                      <div class="quantity-controls">
                        <form action="{{ route('cart.minus', $item->id) }}" method="POST" style="display:inline;">
                          @csrf
                          <button class="quantity-btn minus" type="submit">
                            <i class="fa fa-minus"></i>
                          </button>
                        </form>
                      
                        <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="1" readonly>
                      
                        <form action="{{ route('cart.plus', $item->id) }}" method="POST" style="display:inline;">
                          @csrf
                          <button class="quantity-btn plus" type="submit">
                            <i class="fa fa-plus"></i>
                          </button>
                        </form>
                      </div>
                    </div>

                    <div class="total-section">
                      <span class="total-label">Subtotal</span>
                      <span class="item-total">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Sidebar: Summary & Payment -->
      <div class="col-xl-4 col-lg-5">
        <div class="checkout-sidebar">
          <!-- Order Summary -->
          <div class="summary-card">
            <div class="card-header">
              <h3>
                <i class="fas fa-receipt me-2"></i>
                Ringkasan Pesanan
              </h3>
            </div>
            <div class="card-body">
              <div class="summary-row">
                <span>Subtotal ({{ $cart->cartItems->count() }} item)</span>
                <span>Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
              </div>
              <div class="summary-row">
                <span>Biaya Layanan</span>
                <span>Rp2.000</span>
              </div>
              <div class="summary-row">
                <span>Ongkos Kirim</span>
                <span class="text-success fw-bold">Gratis</span>
              </div>
              <div class="summary-divider"></div>
              <div class="summary-total">
                <span>Total Pembayaran</span>
                <span>Rp{{ number_format($grandTotal + 2000, 0, ',', '.') }}</span>
              </div>
            </div>
          </div> 
          <!-- Payment Methods -->
          <form action="{{ route('cart.checkout') }}" method="GET">
            <div class="payment-section mb-4">
              <h5 class="fw-bold mb-3">
                <i class="fa fa-credit-card me-2"></i>
                Pilih Metode Pembayaran
              </h5>
              
              <div class="payment-methods">
                <!-- Virtual Account Option -->
                <div class="payment-option mb-3">
                  <div class="form-check p-3 border rounded">
                    <input class="form-check-input" type="radio" name="payment_type" 
                          id="virtual_account" value="virtual_account" required>
                    <label class="form-check-label w-100 d-flex justify-content-between align-items-center" 
                          for="virtual_account" style="cursor: pointer;">
                      <span class="fw-semibold">
                        <i class="fa fa-university me-2 text-primary"></i>
                        Virtual Account
                      </span>
                      <i class="fa fa-chevron-down text-muted"></i>
                    </label>
                  </div>
                  
                  <!-- VA Bank Selection (Hidden by default) -->
                  <div id="va_banks" class="bank-selection mt-2 ps-4" style="display: none;">
                    <div class="form-check mb-2 p-2 border-start border-3 border-primary">
                      <input class="form-check-input" type="radio" name="payment_method" 
                            id="va_bri" value="BR" required disabled>
                      <label class="form-check-label" for="va_bri">
                        <span class="fw-medium">BRI</span>
                      </label>
                    </div>
                    <div class="form-check mb-2 p-2 border-start border-3 border-primary">
                      <input class="form-check-input" type="radio" name="payment_method" 
                            id="va_bca" value="BC" required disabled>
                      <label class="form-check-label" for="va_bca">
                        <i class="bi bi-bank text-primary me-2"></i>
                        <span class="fw-medium">BCA</span>
                      </label>
                    </div>
                    <div class="form-check mb-2 p-2 border-start border-3 border-primary">
                      <input class="form-check-input" type="radio" name="payment_method" 
                            id="va_bni" value="I1" required disabled>
                      <label class="form-check-label" for="va_bni">
                        <span class="fw-medium">BNI</span>
                      </label>
                    </div>
                    <div class="form-check mb-2 p-2 border-start border-3 border-primary">
                      <input class="form-check-input" type="radio" name="payment_method" 
                            id="va_mandiri" value="M2" required disabled>
                      <label class="form-check-label" for="va_mandiri">
                        <span class="fw-medium">Mandiri</span>
                      </label>
                    </div>
                  </div>
                </div>

                <!-- E-Wallet Option (Untuk ekspansi nanti) -->
                <div class="payment-option mb-3">
                  <div class="form-check p-3 border rounded">
                    <input class="form-check-input" type="radio" name="payment_type" 
                          id="ewallet" value="ewallet">
                    <label class="form-check-label w-100 d-flex justify-content-between align-items-center" 
                          for="ewallet" style="cursor: pointer;">
                      <span class="fw-semibold">
                        <i class="fa fa-google-wallet me-2 text-success"></i>
                        E-Wallet
                      </span>
                      <i class="fa fa-chevron-down text-muted"></i>
                    </label>
                  </div>
                  
                  <!-- E-Wallet Selection (Hidden by default) -->
                  <div id="ewallet_options" class="bank-selection mt-2 ps-4" style="display: none;">
                    <div class="form-check mb-2 p-2 border-start border-3 border-success">
                      <input class="form-check-input" type="radio" name="payment_method" 
                            id="ew_shopee" value="SA" disabled>
                      <label class="form-check-label" for="ew_shopee">
                        <span class="fw-medium">Shopee Pay Apps</span>
                      </label>
                    </div>
                    <div class="form-check mb-2 p-2 border-start border-3 border-success">
                      <input class="form-check-input" type="radio" name="payment_method" 
                            id="ew_ovo" value="OV" disabled>
                      <label class="form-check-label" for="ew_ovo">
                        <span class="fw-medium">OVO</span>
                      </label>
                    </div>
                    <div class="form-check mb-2 p-2 border-start border-3 border-success">
                      <input class="form-check-input" type="radio" name="payment_method" 
                            id="ew_dana" value="DA" disabled>
                      <label class="form-check-label" for="ew_dana">
                        <span class="fw-medium">DANA</span>
                      </label>
                    </div>
                  </div>
                </div> 

                {{-- <div class="payment-option mb-3">
                  <div class="form-check p-3 border rounded">
                    <input class="form-check-input" type="radio" name="payment_type" 
                          id="qris" value="qris" required>
                    <label class="form-check-label w-100 d-flex justify-content-between align-items-center" 
                          for="qris" style="cursor: pointer;">
                      <span class="fw-semibold">
                        <i class="fa fa-qrcode me-2 text-danger"></i>
                        QRIS
                      </span>
                      <i class="fa fa-chevron-down text-muted"></i>
                    </label>
                  </div> 

                  <!-- QRIS -->
                  <div id="va_banks" class="bank-selection mt-2 ps-4" style="display: none;">
                    <div class="form-check mb-2 p-2 border-start border-3 border-primary">
                      <input class="form-check-input" type="radio" name="payment_method" 
                            id="qris_sp" value="SP" required disabled>
                      <label class="form-check-label" for="qris_sp">
                        <span class="fw-medium">Shopee Pay</span>
                      </label>
                    </div> 
                  </div>
                </div> --}}

              </div>
            </div>

            <div class="btn_box text-center">
              <button type="submit" class="btn btn-warning w-100 rounded-pill text-white fw-bold py-2">
                <i class="fa fa-lock me-2"></i>
                Lanjutkan Pembayaran
              </button>
            </div>
          </form>  
        </div>
      </div>
    </div>
    @else
    <!-- Empty Cart -->
    <div class="empty-cart">
      <div class="empty-cart-content">
        <div class="empty-icon">
          <i class="fa fa-opencart"></i>
        </div>
        <h2>Keranjang Belanja Kosong</h2>
        <p>Waktunya mengisi perut dengan makanan lezat! Jelajahi menu kami dan temukan hidangan favorit Anda.</p>
        <a href="{{ route('customer.menu') }}" class="btn-browse-menu">
          Jelajahi Menu 
        </a>
      </div>
    </div>
    @endif
  </div>
</section>
 
@endsection
  
@push('style')
  @include('customer.cart.css')
@endpush

@push('script')
  @include('customer.cart.script')
@endpush