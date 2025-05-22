@extends('customer.layouts.app')

@section('content')
 
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Register
      </h2>
    </div>
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="form_container"> 
            @if($cart && $cart->cartItems->count() > 0)
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="bg-light">
                    <tr>
                      <th scope="col">Menu</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($cart->cartItems as $item)
                      @php
                        $subtotal = $item->menu->price * $item->quantity;
                        $grandTotal += $subtotal;
                      @endphp
                      <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td class="text-end">Rp{{ number_format($item->menu->price, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-end">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="fw-bold bg-light">
                      <td colspan="3" class="text-end">Total Belanja:</td>
                      <td class="text-end text-success">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="btn_box text-center"> 
                <button type="submit" class="btn btn-primary">
                  Lanjut Pembayaran
                </button>
              </div> 
            @else
              <div class="alert alert-info text-center" role="alert">
                Keranjang belanja kosong.
              </div>
            @endif 
           
        </div>
      </div> 
    </div>
  </div>
</section>


@endsection 
  