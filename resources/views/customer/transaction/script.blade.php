<script type="text/javascript">
    var Page = function() {
        let currentPage = 1;
        let transactions = [];
    
        var _componentPage = function(){
    
            $(document).ready(function() { 
                initAction();
                loadTransactions();
            });
    
            const initAction = () => {
                $('#btnFilter').on('click', function() {
                    currentPage = 1;
                    loadTransactions();
                });
    
                $(document).on('click', '.btn-detail', function() {
                    const transactionId = $(this).data('id');
                    showTransactionDetail(transactionId);
                });
    
                $(document).on('click', '.page-link', function(e) {
                    e.preventDefault();
                    const page = $(this).data('page');
                    if (page && page !== currentPage) {
                        currentPage = page;
                        loadTransactions();
                    }
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
                            <td><button class="btn btn-sm btn-detail" data-id="${transaction.id}"><i class="fa fa-eye"></i> Detail</button></td>
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
    
            const showTransactionDetail = (transactionId) => {
                const transaction = transactions.find(t => t.id === transactionId);
                if (!transaction) return;
    
                const statusBadge = getStatusBadge(transaction.status);
                const formattedDate = formatDate(transaction.date);
                const formattedAmount = formatCurrency(transaction.amount);
    
                const detailHtml = `
                    <div class="p-4">
                        <h6 class="fw-bold mb-3">Detail Transaksi</h6>
                        <p><strong>ID:</strong> ${transaction.id}</p>
                        <p><strong>Tanggal:</strong> ${formattedDate}</p>
                        <p><strong>Status:</strong> ${statusBadge}</p>
                        <p><strong>Jumlah:</strong> ${formattedAmount}</p>
                        <p><strong>Deskripsi:</strong> ${transaction.description}</p>
                        ${transaction.notes ? `<p><strong>Catatan:</strong> ${transaction.notes}</p>` : ''}
                    </div>
                `;
                $('#detailModalBody').html(detailHtml);
                $('#detailModal').modal('show');
            }
    
            const getStatusBadge = (status) => {
                const badges = {
                    'pending': '<span class="badge bg-warning text-dark">Pending</span>',
                    'success': '<span class="badge bg-success">Berhasil</span>',
                    'failed': '<span class="badge bg-danger">Gagal</span>'
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
    