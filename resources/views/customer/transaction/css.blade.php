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