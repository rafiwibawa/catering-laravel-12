<script>
    document.addEventListener('DOMContentLoaded', function() {
      const paymentTypes = document.querySelectorAll('input[name="payment_type"]');
      
      paymentTypes.forEach(type => {
        type.addEventListener('change', function() {
          // Hide all bank selections
          document.querySelectorAll('.bank-selection').forEach(selection => {
            selection.style.display = 'none';
            // Disable all sub-options
            selection.querySelectorAll('input[type="radio"]').forEach(input => {
              input.disabled = true;
              input.required = false;
            });
          });
          
          // Reset chevron icons
          document.querySelectorAll('.fa-chevron-down, .fa-chevron-up').forEach(icon => {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
          });
          
          // Show selected payment method's options
          if (this.value === 'virtual_account') {
            const vaBanks = document.getElementById('va_banks');
            vaBanks.style.display = 'block';
            vaBanks.querySelectorAll('input[type="radio"]').forEach(input => {
              input.disabled = false;
              input.required = true;
            });
            // Rotate chevron
            this.parentElement.querySelector('i.fa-chevron-down').classList.replace('fa-chevron-down', 'fa-chevron-up');
          } else if (this.value === 'ewallet') {
            const ewalletOptions = document.getElementById('ewallet_options');
            ewalletOptions.style.display = 'block';
            ewalletOptions.querySelectorAll('input[type="radio"]').forEach(input => {
              input.disabled = false;
              input.required = true;
            });
            // Rotate chevron
            this.parentElement.querySelector('i.fa-chevron-down').classList.replace('fa-chevron-down', 'fa-chevron-up');
          } else if (this.value === 'cod') {
            // For COD, set payment_method manually
            // You might want to add a hidden input for this
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'payment_method';
            hiddenInput.value = 'cod';
            hiddenInput.id = 'cod_payment_method';
            
            // Remove previous hidden input if exists
            const existingHidden = document.getElementById('cod_payment_method');
            if (existingHidden) existingHidden.remove();
            
            this.closest('form').appendChild(hiddenInput);
          }
        });
      });
      
      // Prevent form submission if VA or E-Wallet selected but no bank chosen
      const form = document.querySelector(`form[action="{{ route('cart.checkout') }}"]`);
      form.addEventListener('submit', function(e) {
        const selectedType = document.querySelector('input[name="payment_type"]:checked');
        
        if (!selectedType) {
          e.preventDefault();
          alert('Silakan pilih metode pembayaran terlebih dahulu');
          return;
        }
        
        if (selectedType.value === 'virtual_account' || selectedType.value === 'ewallet') {
          const selectedBank = document.querySelector('input[name="payment_method"]:checked');
          if (!selectedBank) {
            e.preventDefault();
            alert('Silakan pilih bank/e-wallet terlebih dahulu');
            return;
          }
        }
      });
    });
  </script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity controls
        document.querySelectorAll('.quantity-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.dataset.action;
                const quantityInput = this.parentElement.querySelector('.quantity-input');
                const currentValue = parseInt(quantityInput.value);
                
                if (action === 'increase') {
                    quantityInput.value = currentValue + 1;
                    updateItemTotal(this.closest('.cart-item'));
                } else if (action === 'decrease' && currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    updateItemTotal(this.closest('.cart-item'));
                }
                
                // Add animation
                this.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
                
                // Here you would typically send AJAX request to update cart
                // updateCartItemQuantity(itemId, quantityInput.value);
            });
        });
  
        // Remove item buttons
        document.querySelectorAll('.btn-remove').forEach(btn => {
          btn.addEventListener('click', function() {
              const cartItem = this.closest('.cart-item');
              const itemId = cartItem.dataset.id; // Pastikan ada data-id di elemen
              const itemName = cartItem.querySelector('.item-name').textContent;
  
              if (confirm(`Apakah Anda yakin ingin menghapus "${itemName}" dari keranjang?`)) {
                  // Animasi fade out
                  cartItem.style.transition = 'all 0.3s ease';
                  cartItem.style.opacity = '0';
                  cartItem.style.transform = 'translateX(100px)';
  
                  fetch(`/cart/remove-item/${itemId}`, {
                      method: 'DELETE',
                      headers: {
                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                      }
                  })
                  .then(res => res.json())
                  .then(data => {
                      if (data.success) {
                          setTimeout(() => {
                              cartItem.remove();
                              updateOrderSummary();
                          }, 300);
  
                          // Update jumlah cart di badge
                          document.querySelector('#cart-count').textContent = data.cart_count;
                          // Update isi cart dropdown
                          document.querySelector('#cart-dropdown').innerHTML = data.dropdown_html;
                      } else {
                          alert(data.message || 'Gagal menghapus item.');
                          cartItem.style.opacity = '1';
                          cartItem.style.transform = 'translateX(0)';
                      }
                  })
                  .catch(() => {
                      alert('Terjadi kesalahan server.');
                      cartItem.style.opacity = '1';
                      cartItem.style.transform = 'translateX(0)';
                  });
              }
          });
        }); 
      
        document.head.insertAdjacentHTML('beforeend', modalStyles);
    });
  </script>