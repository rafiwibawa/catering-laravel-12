<script type="text/javascript">
  var Page = function() {
      var _componentPage = function(){
          var category_table;
  
          $(document).ready(function() {
              initTable();
              initAction();
              formSubmit(); 
          });
  
          const initTable = () => {
            category_table = $('#MenudataTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('/admin/categories/dt') }}",
                    type: 'POST',         
                    headers: {            
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                    { data: 'name' },        
                    {
                        data: 'created_at',
                        render: function(data) {
                            if (!data) return '-';
                            const date = new Date(data);
                            return date.toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });
                        }
                    },
                    {
                        data: 'updated_at',
                        render: function(data) {
                            if (!data) return '-';
                            const date = new Date(data);
                            return date.toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });
                        }
                    },
                    {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data) {
                        return `
                                <a href="/menus/${data}/edit" class="btn btn-circle btn-sm btn-warning btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a> 
                                <button class="btn btn-circle btn-sm btn-danger btn-delete" data-id="${data}" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            `;
                        }
                    }
                ],
                // order: [[0, 'asc']],
                language: {
                    search: '<span>Cari:</span> _INPUT_',
                    searchPlaceholder: 'Nama, kategori...',
                    processing: '<div class="text-center">Loading...</div>',
                }
            });
  
            // Optional: pencarian manual
            $('#customSearch').on('keyup', function () {
                order_table.search(this.value).draw();
            });
          },
          initAction = () => {
            $(document).on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin ingin menghapus category ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/categories/${id}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                toastr.success('category berhasil dihapus');
                                category_table.ajax.reload(null, false); // reload tanpa reset halaman pagination
                            },
                            error: function(xhr) {
                                toastr.error('Gagal menghapus category');
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.btn-edit', function(e) {
                e.preventDefault(); 
                const row = $(this).closest('tr');
                const data = category_table.row(row).data();

                if (data) {
                    $('#modalCompanyLabel').text('Edit Category');
                    $('#category_form').attr('action', `/admin/categories/${data.id}`);
                    $('#category_form').attr('method', 'POST'); 
                    $('#category_form').find('input[name="_method"]').remove(); 
                    $('#category_form').append('<input type="hidden" name="_method" value="PUT">');
                    $('#category_form')[0].reset();
  
                    $('#name').val(data.name);
 
                    $('#modal_category').modal('show');
                } else {
                    toastr.error('Data tidak ditemukan di tabel');
                } 
            });
 
            $('#btnAddCategory').on('click', function() { 
                $('#modalCompanyLabel').text('Tambah Category');
                $('#category_form').attr('action', "{{ url('/admin/categories') }}");
                $('#category_form').attr('method', 'POST');
                $('#category_form').find('input[name="_method"]').remove();
                $('#category_form')[0].reset(); 
                $('#modal_category').modal('show');
            });
          }
          formSubmit = () => {
            $('#category_form').submit(function(event){
                event.preventDefault();

                var $btn = $('#btnSaveCategory');
                var originalText = $btn.html();

                // Ubah tombol jadi loading
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');

                var formData = new FormData(this);
 
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'), 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                })
                .done(function(res) {
                    if (res.status == 200) {
                        toastr.success(res.message, 'Success');
                        category_table.ajax.reload(null, false);
                        $('#modal_category').modal('hide');
                    }
                })
                .fail(function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'Gagal menyimpan data', 'Error');
                })
                .always(function() {
                    // Kembalikan tombol seperti semula
                    $btn.prop('disabled', false).html(originalText);
                });
            }); 
          };

          $('#image').on('change', function() {
            var input = this;
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#image_preview').html(`<img src="${e.target.result}" style="max-height:100px;" alt="Preview"/>`);
              };
              reader.readAsDataURL(input.files[0]);
            } else {
              $('#image_preview').html('');
            }
          });

          const showModal = function (selector) {
              $('#' + selector).modal('show');
          };
  
          const hideModal = function (selector) {
              $('#' + selector).modal('hide');
          };
  
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
  