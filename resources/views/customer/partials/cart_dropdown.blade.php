@forelse ($cartItems as $item)
    <div class="cart_item" style="display: flex; align-items: center; gap: 10px;">
        <img src="{{ asset('customer/images/' . $item->menu->image) }}" alt="{{ $item->menu->name }}" width="40" height="40" style="border-radius: 6px;">
        <span>{{ $item->menu->name }} - {{ $item->quantity }} pcs</span>
    </div>
@empty
    <div style="padding: 10px;">Keranjang kosong</div>
@endforelse

<div style="text-align:right; margin-top: 10px;">
    <a href="/cart" style="text-decoration:none; color:#007bff; display: inline-flex; align-items: center;">
        <img src="https://cdn-icons-png.flaticon.com/512/709/709496.png" alt="cart icon" width="16" height="16" style="margin-right: 5px;">
        Lihat Semua
    </a>
</div>
