<script type="text/javascript">
    var Page = function() {
        let currentPage = 1;
        let transactions = [];
    
        var _componentPage = function() {
    
            $(document).ready(function() { 
                initAction();
                loadTransactions();
            });
    
            const initAction = () => {
                $('#btnFilter').on('click', function() {
                    currentPage = 1;
                    loadTransactions();
                });
    
                // klik pagination
                $(document).on('click', '.page-link', function(e) {
                    e.preventDefault();
                    const page = $(this).data('page');
                    if (page && page !== currentPage) {
                        currentPage = page;
                        loadTransactions();
                    }
                });
    
                // klik tombol invoice
                $(document).on('click', '.btn-invoice', function(e) {
                    e.preventDefault();
                    const url = $(this).attr('href');
                    openInvoice(url);
                });
            }
    
            const loadTransactions = () => {
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();
                const status = $('#statusFilter').val();
    
                $('#transactionTableBody').html(`
                    <tr>
                        <td colspan="6" class="text-center p-5">
                            <div class="spinner-border" style="color: #ffd700;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="text-muted mt-2">Memuat data...</p>
                        </td>
                    </tr>
                `);
    
                $.ajax({
                    url: '/transaction/data',  
                    method: 'GET',
                    data: {
                        page: currentPage,
                        start_date: startDate,
                        end_date: endDate,
                        status: status
                    },
                    success: function(response) {
                        transactions = response.data;
                        renderTransactions(response.data);
                        renderPagination(response.pagination);
                        updateStats(response.stats);
                    },
                    error: function(xhr) {
                        console.error("Gagal memuat data transaksi:", xhr.responseText);
                        $('#transactionTableBody').html(`
                            <tr>
                                <td colspan="6" class="text-center text-danger p-5">Gagal memuat data transaksi</td>
                            </tr>
                        `);
                    }
                });
            }
    
            const renderTransactions = (data) => {
                if (data.length === 0) {
                    $('#transactionTableBody').html(`
                        <tr>
                            <td colspan="6" class="text-center p-5">
                                <i class="fa fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="text-muted mt-3">Tidak ada transaksi ditemukan</p>
                            </td>
                        </tr>
                    `);
                    return;
                }
    
                let html = '';
                data.forEach(transaction => {
                    const statusBadge = getStatusBadge(transaction.status);
                    const formattedDate = formatDate(transaction.date);
                    const formattedAmount = formatCurrency(transaction.amount);
    
                    html += `
                        <tr>
                            <td><span class="badge bg-light text-dark fw-bold">${transaction.id}</span></td>
                            <td>${formattedDate}</td>
                            <td>${transaction.description}</td>
                            <td class="fw-bold">${formattedAmount}</td>
                            <td>${statusBadge}</td>
                            <td>
                                <a href="transaction/invoice/${transaction.id}" 
                                   class="btn btn-sm btn-outline-primary btn-invoice d-flex align-items-center gap-1">
                                    <i class="fa fa-print"></i> 
                                    <span>Invoice</span>
                                </a>
                            </td>
                        </tr>  
                    `;
                });
    
                $('#transactionTableBody').html(html);
            }
    
            const renderPagination = (pagination) => {
                const totalPages = pagination.total_pages;
                const current = pagination.current_page;
    
                $('#showingCount').text(pagination.showing);
                $('#totalCount').text(pagination.total);
    
                if (totalPages <= 1) {
                    $('#pagination').html('');
                    return;
                }
    
                let html = `
                    <li class="page-item ${current === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${current - 1}"><i class="fa fa-chevron-left"></i></a>
                    </li>
                `;
    
                for (let i = 1; i <= totalPages; i++) {
                    if (i === 1 || i === totalPages || (i >= current - 1 && i <= current + 1)) {
                        html += `<li class="page-item ${i === current ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                    } else if (i === current - 2 || i === current + 2) {
                        html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                    }
                }
    
                html += `
                    <li class="page-item ${current === totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${current + 1}"><i class="fa fa-chevron-right"></i></a>
                    </li>
                `;
    
                $('#pagination').html(html);
            }
    
            const updateStats = (stats) => {
                $('#totalTransactions').text(stats.total);
                $('#successTransactions').text(stats.success);
                $('#totalAmount').text(formatCurrency(stats.amount));
            }
    
            const getStatusBadge = (status) => {
                const badges = {
                    'pending': '<span class="badge bg-warning text-dark">Pending</span>',
                    'completed': '<span class="badge bg-success">Berhasil</span>',
                    'cancelled': '<span class="badge bg-danger">Gagal</span>'
                };
                return badges[status] || '<span class="badge bg-secondary">Tidak diketahui</span>';
            }
    
            const formatDate = (dateString) => {
                const date = new Date(dateString);
                return date.toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' });
            }
    
            const formatCurrency = (amount) => {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);
            }
    
            // --- Tambahan: fungsi buka invoice + auto print ---
            const openInvoice = (url) => {
                const newTab = window.open(url, '_blank');
    
                const checkReady = setInterval(() => {
                    if (newTab.document.readyState === 'complete') {
                        clearInterval(checkReady);
                        newTab.focus();
                        newTab.print();
                    }
                }, 500);
            }
        };
    
        return {
            init: function() {
                _componentPage();
            }
        }
    
    }();
    
    document.addEventListener('DOMContentLoaded', function() {
        Page.init();
    });
    </script>
    