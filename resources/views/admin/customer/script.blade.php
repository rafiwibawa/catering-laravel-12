<script type="text/javascript">
  var Page = function() {
      var _componentPage = function(){
          var category_table;
  
          $(document).ready(function() {
              initTable();
              initAction(); 
          });
  
          const initTable = () => {
            category_table = $('#MenudataTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('/admin/customers/dt') }}",
                    type: 'POST',         
                    headers: {            
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                    { data: 'name' },   
                    { data: 'phone' }, 
                    { data: 'address' },      
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
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data) {
                        return ` 
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
   
            $('#customSearch').on('keyup', function () {
                order_table.search(this.value).draw();
            });
          },
          initAction = () => {
            $(document).on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin ingin menghapus customer ini?',
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
                            url: `/admin/customers/${id}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                toastr.success('customer berhasil dihapus');
                                category_table.ajax.reload(null, false); 
                            },
                            error: function(xhr) {
                                toastr.error('Gagal menghapus customer');
                            }
                        });
                    }
                });
            });  
          } 

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
  