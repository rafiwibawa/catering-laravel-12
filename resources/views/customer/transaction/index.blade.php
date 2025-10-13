@extends('customer.layouts.app')

@section('content')
<div class="transaction-history-page" style="background: #ffffff; min-height: 100vh; padding: 40px 20px;">
    <div class="container">
        <!-- Header -->
        <div class="page-header mb-5">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="mb-2" style="color: #1a1a1a; font-weight: 700; font-size: 2rem;">
                        Riwayat Transaksi
                    </h1>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">Kelola dan pantau semua transaksi Anda</p>
                </div>
                {{-- <button class="btn" style="background: #ffd700; color: #000; font-weight: 600; border: none; padding: 12px 24px; border-radius: 12px;">
                    <i class="fa fa-download me-2"></i> Export Data
                </button> --}}
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-5 g-4">
            <div class="col-md-4">
                <div class="stat-card" style="background: #fff; border-radius: 16px; padding: 24px;
                            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06); border: 1px solid #f0f0f0;">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); 
                                    width: 48px; height: 48px; border-radius: 12px; 
                                    display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-database" style="color: #000; font-size: 20px;"></i>
                        </div>
                        <span class="badge" style="background: #fff3cd; color: #856404; font-size: 0.75rem;">+12%</span>
                    </div>
                    <p class="text-muted mb-1" style="font-size: 0.875rem; font-weight: 500;">Total Transaksi</p>
                    <h2 class="mb-0" style="color: #1a1a1a; font-weight: 700;" id="totalTransactions">0</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="background: #fff; border-radius: 16px; padding: 24px;
                            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06); border: 1px solid #f0f0f0;">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #28a745 0%, #34ce57 100%); 
                                    width: 48px; height: 48px; border-radius: 12px; 
                                    display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-check-circle" style="color: #fff; font-size: 20px;"></i>
                        </div>
                        <span class="badge" style="background: #d4edda; color: #155724; font-size: 0.75rem;">98%</span>
                    </div>
                    <p class="text-muted mb-1" style="font-size: 0.875rem; font-weight: 500;">Berhasil</p>
                    <h2 class="mb-0" style="color: #1a1a1a; font-weight: 700;" id="successTransactions">0</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="background: #fff; border-radius: 16px; padding: 24px;
                            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06); border: 1px solid #f0f0f0;">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); 
                                    width: 48px; height: 48px; border-radius: 12px; 
                                    display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-google-wallet" style="color: #000; font-size: 20px;"></i>
                        </div>
                        <span class="badge" style="background: #fff3cd; color: #856404; font-size: 0.75rem;">+8%</span>
                    </div>
                    <p class="text-muted mb-1" style="font-size: 0.875rem; font-weight: 500;">Total Nilai</p>
                    <h2 class="mb-0" style="color: #1a1a1a; font-weight: 700;" id="totalAmount">Rp 0</h2>
                </div>
            </div>
        </div>

        <!-- Filter & Search Section -->
        <div class="filter-section mb-4">
            <div class="card" style="background: #fff; border-radius: 16px; border: 1px solid #f0f0f0;
                        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);">
                <div class="card-body p-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label" style="color: #6c757d; font-weight: 600; font-size: 0.875rem; margin-bottom: 8px;">
                                Tanggal Mulai
                            </label>
                            <input type="date" class="form-control modern-input" id="startDate">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" style="color: #6c757d; font-weight: 600; font-size: 0.875rem; margin-bottom: 8px;">
                                Tanggal Akhir
                            </label>
                            <input type="date" class="form-control modern-input" id="endDate">
                        </div>
                        <div class="col-md-3">
                          <div class="custom-select-wrapper">
                              <label class="custom-select-label">Status</label>
                              <select id="statusFilter" style="border-radius: 6px !important; height: 32px !important; padding: 4px 10px !important; border: 1px solid #ddd !important; outline: none !important; font-size: 13px !important; box-sizing: border-box !important; line-height: normal !important; min-height: auto !important;">
                                  <option value="">Semua Status</option>
                                  <option value="pending">Pending</option>
                                  <option value="success">Berhasil</option>
                                  <option value="failed">Gagal</option>
                              </select>
                          </div>
                      </div>
                        <div class="col-md-3">
                            <button class="btn w-100 modern-btn" id="btnFilter">
                                <i class="fa fa-search me-2"></i> Cari Transaksi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction List -->
        <div class="transaction-list">
            <div class="card" style="background: #fff; border-radius: 16px; border: 1px solid #f0f0f0;
                        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table modern-table mb-0" id="transactionTable">
                            <thead>
                                <tr>
                                    <th class="border-0 p-4">ID Transaksi</th>
                                    <th class="border-0 p-4">Tanggal & Waktu</th>
                                    <th class="border-0 p-4">Deskripsi</th>
                                    <th class="border-0 p-4">Jumlah</th>
                                    <th class="border-0 p-4">Status</th>
                                    <th class="border-0 p-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="transactionTableBody">
                                <tr>
                                    <td colspan="6" class="text-center p-5">
                                        <div class="spinner-border" style="color: #ffd700; width: 3rem; height: 3rem;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="text-muted mt-3 mb-0">Memuat data transaksi...</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer" style="background: #fafafa; border-top: 1px solid #f0f0f0; padding: 20px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="text-muted" style="font-size: 0.875rem;">
                            Menampilkan <strong id="showingCount" style="color: #1a1a1a;">0</strong> dari <strong id="totalCount" style="color: #1a1a1a;">0</strong> transaksi
                        </div>
                        <nav>
                            <ul class="pagination mb-0 modern-pagination" id="pagination"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('customer.transaction.modal')

@endsection

@push('style')
@include('customer.transaction.css')
@endpush

@push('script')
@include('customer.transaction.script')
@endpush