@forelse ($cartItems as $item)
    <div class="cart_item" style="display: flex; align-items: center; gap: 12px; padding: 12px; border-radius: 8px; background: #f8f9fa; margin-bottom: 8px; transition: all 0.2s ease;">
        <img src="{{ asset('storage/'.$item->menu->image) }}" 
             alt="{{ $item->menu->name }}" 
             style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="flex: 1;">
            <div style="font-weight: 600; color: #2c3e50; font-size: 14px; margin-bottom: 2px;">
                {{ $item->menu->name }}
            </div>
            <div style="display: flex; align-items: center; gap: 4px; color: #6c757d; font-size: 13px;">
                <span style="background: #e9ecef; padding: 2px 8px; border-radius: 4px; font-weight: 500;">
                    {{ $item->quantity }} pcs
                </span>
            </div>
        </div>
    </div>
@empty
    <div style="padding: 30px; text-align: center; color: #6c757d;">
        <svg style="width: 48px; height: 48px; margin-bottom: 12px; opacity: 0.3;" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
        </svg>
        <div style="font-size: 14px;">Keranjang kosong</div>
    </div>
@endforelse

<div style="margin-top: 16px; padding-top: 12px; border-top: 1px solid #e9ecef;">
    <a href="/cart" style="display: inline-flex; align-items: center; gap: 6px; text-decoration: none; color: #007bff; font-weight: 500; font-size: 14px; padding: 8px 12px; border-radius: 6px; transition: all 0.2s ease;">
        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <span>Lihat Semua</span>
        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </a>
</div>