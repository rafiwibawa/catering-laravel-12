@extends('admin.layouts.app')

@section('content')
 
<div class="container-fluid">  
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Table Customer</h6>
                <div class="d-flex align-items-center gap-2"> 
                    {{-- <span class="text-muted mr-3">Keterangan tambahan</span> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="MenudataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th> 
                            <th>Nama</th>
                            <th>Phone</th> 
                            <th>Alamat</th>
                            <th>Registrasi</th>
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

@endsection 

@include('admin.customer.modal')

@push('script') 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('cms/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('cms/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('cms/js/demo/datatables-demo.js') }}"></script>
@include('admin.customer.script')
@endpush
