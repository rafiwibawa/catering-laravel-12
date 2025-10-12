<!-- Modal -->
<div id="searchModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(4px); z-index: 1050; align-items: center; justify-content: center; padding: 20px;" onclick="if(event.target.id === 'searchModal') this.style.display='none'">
    <div style="background: #1f2937; max-width: 500px; width: 100%; border-radius: 20px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5); position: relative; animation: slideIn 0.3s ease;" onclick="event.stopPropagation()">
        
        <!-- Close Button -->
        <button type="button" 
                onclick="document.getElementById('searchModal').style.display='none'"
                style="position: absolute; top: 16px; right: 16px; background: rgba(255, 255, 255, 0.1); border: none; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; z-index: 10;"
                onmouseover="this.style.background='rgba(239, 68, 68, 0.2)'; this.style.transform='rotate(90deg)'"
                onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.transform='rotate(0deg)'">
            <svg style="width: 20px; height: 20px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Header -->
        <div style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); padding: 30px 30px 40px; border-radius: 20px 20px 0 0; position: relative;">
            <div style="text-align: center;">
                <div style="background: rgba(0, 0, 0, 0.2); width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                    <svg style="width: 32px; height: 32px; color: #1f2937;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h4 style="color: #1f2937; font-weight: 700; margin-bottom: 8px; font-size: 24px;">Cari Menu</h4>
                <p style="color: #78350f; font-size: 14px; margin: 0;">Temukan menu terbaik sesuai budget Anda</p>
            </div>
        </div>

        <!-- Form Content -->
        <form method="GET" action="{{ route('customer.menu.search') }}">
            <div style="padding: 30px;">
                
                <!-- Budget Input -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; color: #fbbf24; margin-bottom: 10px; font-size: 14px;">
                        <svg style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                        Budget Anda
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #fbbf24; font-weight: 600; font-size: 15px;">Rp</span>
                        <input type="number" 
                               name="budget" 
                               class="form-control" 
                               placeholder="50000" 
                               required 
                               value="{{ request('budget') }}"
                               style="padding: 14px 14px 14px 48px; background: #374151; border: 2px solid #4b5563; border-radius: 12px; font-size: 15px; color: white; transition: all 0.3s ease; width: 100%;"
                               onfocus="this.style.borderColor='#fbbf24'; this.style.background='#4b5563'"
                               onblur="this.style.borderColor='#4b5563'; this.style.background='#374151'">
                    </div>
                </div>

                <!-- Quantity Input -->
                <div style="margin-bottom: 28px;">
                    <label style="display: block; font-weight: 600; color: #fbbf24; margin-bottom: 10px; font-size: 14px;">
                        <svg style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                        </svg>
                        Jumlah Porsi
                    </label>
                    <div style="position: relative;">
                        <input type="number" 
                               name="quantity" 
                               class="form-control" 
                               placeholder="10" 
                               required 
                               value="{{ request('quantity') }}"
                               style="padding: 14px 48px 14px 16px; background: #374151; border: 2px solid #4b5563; border-radius: 12px; font-size: 15px; color: white; transition: all 0.3s ease; width: 100%;"
                               onfocus="this.style.borderColor='#fbbf24'; this.style.background='#4b5563'"
                               onblur="this.style.borderColor='#4b5563'; this.style.background='#374151'">
                        <span style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: #fbbf24; font-weight: 600; font-size: 14px;">pcs</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border: none; padding: 16px; border-radius: 12px; font-weight: 600; font-size: 16px; color: #1f2937; box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4); transition: all 0.3s ease; width: 100%; cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(251, 191, 36, 0.5)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(251, 191, 36, 0.4)'">
                    <svg style="width: 18px; height: 18px; display: inline-block; vertical-align: middle; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari Menu Sekarang
                </button>

                <!-- Info Text -->
                <div style="text-align: center; margin-top: 16px;">
                    <small style="color: #9ca3af; font-size: 12px;">💡 Dapatkan rekomendasi menu terbaik untuk Anda</small>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Animation -->
<style>
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        opacity: 1;
    }
</style>