@extends('admin.layouts.app')

@section('content')
 
<!-- Begin Page Content -->
<div class="container-fluid"> 
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="OrderdataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Customer</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Pembelian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                   <tbody>  
                   </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid --> 

@endsection 
 
@push('script') 
 
<script src="{{ asset('cms/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('cms/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('cms/js/demo/datatables-demo.js') }}"></script>
@include('admin.order.script')
@endpush
