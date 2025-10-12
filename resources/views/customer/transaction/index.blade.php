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
                <button class="btn" style="background: #ffd700; color: #000; font-weight: 600; border: none; padding: 12px 24px; border-radius: 12px;">
                    <i class="fa fa-download me-2"></i> Export Data
                </button>
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

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-file-invoice me-2" style="color: #ffd700;"></i>
                    Detail Transaksi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="detailModalBody"></div>
        </div>
    </div>
</div>

<style>
    .transaction-history-page {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .custom-select-wrapper {
        position: relative;
    }

    .custom-select-label {
        position: absolute;
        top: 12px;
        right: 20px;
        color: #9e9e9e;
        font-size: 0.75rem;
        font-weight: 500;
        pointer-events: none;
        z-index: 1;
        background: #fff;
        padding: 0 4px;
    }

    .custom-select {
        appearance: none;
        background: #fff;
        border: 1px solid #e0e0e0;
        color: #1a1a1a;
        padding: 12px 60px 12px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%239e9e9e' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
    }

    .custom-select:focus {
        border-color: #ffd700;
        box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.1);
        outline: none;
    }

    .custom-select:hover {
        border-color: #ffd700;
    }

    .modern-input {
        background: #fff;
        border: 1px solid #e0e0e0;
        color: #1a1a1a;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .modern-input:focus {
        background: #fff;
        border-color: #ffd700;
        color: #1a1a1a;
        box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.1);
        outline: none;
    }

    .modern-btn {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #000;
        font-weight: 600;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
    }

    .stat-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
    }

    .modern-table thead tr {
        background: #fafafa;
    }

    .modern-table thead th {
        color: #6c757d;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modern-table tbody tr {
        border-bottom: 1px solid #f5f5f5;
        transition: all 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background: #fafafa;
    }

    .modern-table tbody td {
        padding: 20px;
        color: #1a1a1a;
        vertical-align: middle;
        font-size: 0.9rem;
    }

    .badge {
        padding: 6px 12px;
        font-weight: 600;
        font-size: 0.8rem;
        border-radius: 8px;
    }

    .modern-pagination .page-link {
        background: #fff;
        border: 1px solid #e0e0e0;
        color: #1a1a1a;
        padding: 8px 14px;
        margin: 0 4px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .modern-pagination .page-link:hover {
        background: #ffd700;
        color: #000;
        border-color: #ffd700;
        transform: translateY(-2px);
    }

    .modern-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        border-color: #ffd700;
        color: #000;
    }

    .modern-pagination .page-item.disabled .page-link {
        background: #f5f5f5;
        border-color: #e0e0e0;
        color: #9e9e9e;
    }

    .modern-modal {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .modern-modal .modal-header {
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
        padding: 24px;
    }

    .modern-modal .modal-title {
        color: #1a1a1a;
        font-weight: 700;
        font-size: 1.25rem;
    }

    .btn-detail {
        background: #fff;
        color: #1a1a1a;
        border: 1px solid #e0e0e0;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .btn-detail:hover {
        background: #ffd700;
        color: #000;
        border-color: #ffd700;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.5rem;
        }
        
        .stat-card {
            margin-bottom: 1rem;
        }

        .modern-table {
            font-size: 0.85rem;
        }

        .modern-table tbody td {
            padding: 12px;
        }
    }
</style>
@endsection

@push('script')
@include('customer.transaction.script')
@endpush