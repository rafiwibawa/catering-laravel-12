<script type="text/javascript">
  var Page = function() {
      var _componentPage = function(){
          var menu_table;
  
          $(document).ready(function() {
              initTable();
              initAction();
              formSubmit(); 
          });
  
          const initTable = () => {
            menu_table = $('#MenudataTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('/admin/menus/dt') }}",
                    type: 'POST',         
                    headers: {            
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                    {
                        data: 'image',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            if(data) {
                            return `<img src="/storage/${data}" style="height:50px; width:auto;" alt="Menu Image"/>`;
                            }
                            return '-';
                        }
                    },
                    { data: 'name' },
                    { data: 'description' },
                    {
                        data: 'price',
                        render: function(data, type, full, meta) {
                            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data);
                        }
                    },
                    { data: 'category_name' },
                    { data: 'created_by_name' },   
                    {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data) {
                        return `
                            <a href="/menus/${data}/edit" class="btn btn-circle btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/menus/${data}" class="btn btn-circle btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="btn btn-circle btn-sm btn-danger btn-delete" data-id="${data}" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            `;
                        }
                    }
                ],
                order: [[0, 'asc']],
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
                    title: 'Yakin ingin menghapus menu ini?',
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
                            url: `/admin/menus/${id}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                toastr.success('Menu berhasil dihapus');
                                menuTable.ajax.reload(null, false); // reload tanpa reset halaman pagination
                            },
                            error: function(xhr) {
                                toastr.error('Gagal menghapus menu');
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.btn-edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    url: `/admin/menus/${id}/edit`,
                    type: 'GET',
                    success: function(data) {
                        // Isi form modal dengan data dari server
                        $('#modalCompanyLabel').text('Edit Menu');
                        $('#menu_form').attr('action', `/admin/menus/${id}`);
                        $('#menu_form').attr('method', 'POST');
                        $('#menu_form').append('<input type="hidden" name="_method" value="PUT">');
                        $('#menu_id').val(data.id);
                        $('#name').val(data.name);
                        $('#description').val(data.description);
                        $('#price').val(data.price);
                        $('#category_id').val(data.category_id);
                        if(data.image) {
                          $('#image_preview').html(`<img src="/storage/${data.image}" style="max-height:100px;" alt="Preview"/>`);
                        } else {
                          $('#image_preview').html('');
                        }
                        $('#modal_company').modal('show');
                    },
                    error: function() {
                        toastr.error('Gagal mengambil data menu');
                    }
                });
            });
 
            $('#btnAddMenu').on('click', function() {
                loadCategories();

                $('#modalCompanyLabel').text('Tambah Menu');
                $('#menu_form').attr('action', "{{ url('/admin/menus') }}");
                $('#menu_form').attr('method', 'POST');
                $('#menu_form').find('input[name="_method"]').remove();
                $('#menu_form')[0].reset();
                $('#image_preview').html('');
                $('#modal_company').modal('show');
            });
          }
          formSubmit = () => {
            $('#menu_form').submit(function(event){
                event.preventDefault();

                // pakai FormData agar bisa kirim file image
                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                })
                .done(function(res) {
                    if (res.status == 200) {
                        toastr.success(res.message, 'Success');
                        menu_table.ajax.reload(null, false);
                        $('#modal_company').modal('hide');
                    }
                })
                .fail(function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'Gagal menyimpan data', 'Error');
                });
            });
          },
          loadCategories = () => {
            $.ajax({
                url: '/admin/categories/list',
                type: 'GET',
                success: function(categories) {
                    let $categorySelect = $('#category_id');
                    $categorySelect.empty();
                    $categorySelect.append('<option value="">-- Pilih Kategori --</option>');

                    categories.forEach(function(category) {
                        $categorySelect.append(`<option value="${category.id}">${category.name}</option>`);
                    });
                },
                error: function() {
                    toastr.error('Gagal memuat kategori');
                }
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
  