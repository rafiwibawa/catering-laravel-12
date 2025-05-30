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
                        text: `Anda yakin ingin menambahkan "${productName}" ke keranjang?`,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Tambah!',
                        cancelButtonText: 'Batal!',
                        confirmButtonClass: 'btn btn-primary',
                        cancelButtonClass: 'btn btn-danger ml-3',
                        buttonsStyling: false,
                    }).then(function (result) {
                        if (result.value) {
                            $.ajax({
                                url: url,
                                type: 'GET',
                                dataType: 'json',
                            })
                            .done(function(res, xhr, meta) {  
                                if (res.success) { 
                                    toastr.success(res.message, 'Success');

                                    // Update jumlah cart di badge
                                    $('#cart-count').text(res.cart_count);

                                    // Update isi cart dropdown
                                    $('#cart-dropdown').html(res.dropdown_html);
                                } else {
                                    toastr.error('Gagal!', 'Failed')
                                }
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {         
                                toastr.error(jqXHR.responseJSON.error, 'Failed');
                            })
                            .always(function() { }); 
                        }
                    })
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
