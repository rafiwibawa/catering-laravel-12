<script type="text/javascript">
    var Page = function() {
        var _componentPage = function(){

            $(document).ready(function() { 
                initAction(); 
            });

            const initAction = () => { 
                $(document).on('click', '.add-to-cart', function(event){
                    event.preventDefault(); 

                    let productName = $(this).data('name');
                    let url = $(this).attr('href');

                    Swal.fire({
                        title: 'Add To Cart?',
                        html: `
                            <p>Anda yakin ingin menambahkan "<strong>${productName}</strong>" ke keranjang?</p>
                            <div class="mt-3">
                                <label for="cart-qty" class="form-label">Jumlah:</label>
                                <input type="number" id="cart-qty" class="swal2-input" value="1" min="1" style="width: 100px;">
                            </div>
                        `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Tambah!',
                        cancelButtonText: 'Batal!',
                        confirmButtonClass: 'btn btn-primary',
                        cancelButtonClass: 'btn btn-danger ml-3',
                        buttonsStyling: false,
                        preConfirm: () => {
                            const qty = document.getElementById('cart-qty').value;
                            if (!qty || qty < 1) {
                                Swal.showValidationMessage('Jumlah harus minimal 1');
                                return false;
                            }
                            return qty;
                        }
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            const quantity = result.value;

                            $.ajax({
                                url: url,
                                type: 'POST',
                                dataType: 'json',
                                data: { qty: quantity }, // kirim jumlah ke server
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            })
                            .done(function(res) {  
                                if (res.success) { 
                                    toastr.success(res.message, 'Success');

                                    // Update jumlah cart di badge
                                    $('#cart-count').text(res.cart_count);

                                    // Update isi cart dropdown
                                    $('#cart-dropdown').html(res.dropdown_html);
                                } else {
                                    toastr.error('Gagal menambahkan produk', 'Failed');
                                }
                            })
                            .fail(function(jqXHR) {         
                                toastr.error(jqXHR.responseJSON?.error || 'Terjadi kesalahan', 'Failed');
                            });
                        }
                    });
                });
            }

            const showModal = function (selector) {
                $('#'+selector).modal('show')
            },
            hideModal = function (selector) {
                $('#'+selector).modal('hide')
            }

        };

        return {
            init: function(){
                _componentPage();
            }
        }

    }();

    document.addEventListener('DOMContentLoaded', function() {
        Page.init();
    });

</script>
