<script type="text/javascript">
  var Page = function() {
      var _componentPage = function(){
          var order_table;
  
          $(document).ready(function() {
              initTable();
          });
  
          const initTable = () => {
              order_table = $('#OrderdataTable').DataTable({
                  destroy: true,
                  processing: true,
                  serverSide: true,
                  responsive: true,
                  ajax: {
                      url: "{{ url('/admin/order/dt') }}",
                      type: 'GET'
                  },
                  columns: [
                    { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                    { data: 'customer_name' },       // hasil dari relasi
                    { data: 'order_date' },
                    { data: 'delivery_date' },
                    { data: 'status' },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                          return `
                            <a href="/order/${data}/edit" class="btn btn-circle btn-sm btn-warning" title="Edit">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="/order/${data}" class="btn btn-circle btn-sm btn-info" title="View">
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
                      searchPlaceholder: 'Nama, posisi...',
                      processing: '<div class="text-center">Loading...</div>',
                  }
              });
  
              // Optional: pencarian manual
              $('#customSearch').on('keyup', function () {
                  order_table.search(this.value).draw();
              });
          };
  
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
  