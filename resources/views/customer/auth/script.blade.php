<script type="text/javascript">
    var Page = function() {
        var _componentPage = function(){

            $(document).ready(function() {
                formSubmit();
                initAction();
                getData();  
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
                                    toastr.success(res.message, 'Success') 
                                    // $('#cart-count').text(res.cart_count);
                                } else {
                                    toastr.error('Gagal!', 'Failed')
                                }
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                console.error('AJAX Error:', textStatus, errorThrown);
                                toastr.error('Gagal!', 'Failed')
                            })
                            .always(function() { }); 
                        }
                    })
                }); 
            },
            formSubmit = () => {
                $('#form_company').submit(function(event){
                    event.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: $(this).serialize(),
                    })
                    .done(function(res, xhr, meta) {
                        if (res.status == 200) {
                            toastr.success(res.message, 'Success')
                            init_table.draw(false);
                            hideModal('modal_company');
                        }
                    })
                    .fail(function(res, error) {
                        toastr.error(res.responseJSON.message, 'Gagal')
                    })
                    .always(function() {
                    });
                }); 
            },
            getData = () => {
                $.ajax({
                    url: "{{url('menu/get-category')}}",
                    type: 'GET',
                    dataType: 'json',
                })
                .done(function(res, xhr, meta) {
                    let list = ''; 
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
