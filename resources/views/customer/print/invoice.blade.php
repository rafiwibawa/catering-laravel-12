<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Rumah Makan Anni</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #FFFBF0 0%, #FFF8E7 100%);
            padding: 40px 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .invoice-container {
            max-width: 800px;
            width: 100%;
            background: #fff;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 80px);
        }

        .header {
            background: linear-gradient(135deg, #FFF9E6 0%, #FFFCF0 100%);
            color: #000;
            padding: 48px 48px 32px;
            border-bottom: 2px solid #FFE5A0;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #666;
            font-size: 15px;
            font-weight: 400;
        }

        .content {
            padding: 48px;
            flex: 1;
        }

        .invoice-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        .info-block h3 {
            color: #999;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .info-block p {
            color: #1a1a1a;
            line-height: 1.7;
            font-size: 15px;
        }

        .invoice-number {
            background: linear-gradient(135deg, #FFD666 0%, #FFC933 100%);
            color: #000;
            padding: 10px 18px;
            border-radius: 8px;
            display: inline-block;
            font-weight: 600;
            font-size: 15px;
            margin-top: 12px;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(255, 198, 51, 0.2);
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 32px;
        }

        .items-table thead {
            background: linear-gradient(135deg, #FFF9E6 0%, #FFFAED 100%);
            border-top: 1px solid #FFE5A0;
            border-bottom: 1px solid #FFE5A0;
        }

        .items-table th {
            padding: 16px 0;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #f0f0f0;
        }

        .items-table tbody tr:last-child {
            border-bottom: none;
        }

        .items-table td {
            padding: 20px 0;
            color: #1a1a1a;
            font-size: 15px;
        }

        .items-table .item-name {
            font-weight: 500;
            color: #000;
        }

        .items-table .item-desc {
            font-size: 13px;
            color: #999;
            margin-top: 4px;
            font-weight: 400;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-section {
            background: #fafafa;
            padding: 32px;
            border-radius: 12px;
            margin-top: 32px;
            border: 1px solid #e5e5e5;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 14px 0;
        }

        .total-row.grand-total {
            border-top: 1px solid #e5e5e5;
            margin-top: 16px;
            padding-top: 20px;
        }

        .total-row .label {
            font-size: 15px;
            color: #666;
            font-weight: 500;
        }

        .total-row.grand-total .label {
            font-size: 16px;
            color: #000;
            font-weight: 600;
        }

        .total-row .value {
            font-size: 15px;
            color: #1a1a1a;
            font-weight: 600;
        }

        .total-row.grand-total .value {
            font-size: 26px;
            color: #000;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-top: 8px;
        }

        .status-pending {
            background: #FFF4E6;
            color: #D97706;
        }

        .footer {
            background: #fafafa;
            padding: 32px 48px;
            text-align: center;
            color: #999;
            font-size: 13px;
            border-top: 1px solid #e5e5e5;
            margin-top: auto;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            
            .invoice-container {
                box-shadow: none;
                border-radius: 0;
            }

            .header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .items-table thead {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .total-row.grand-total .value {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .status-badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .invoice-number {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1>RUMAH MAKAN ANNI</h1>
            <p>Invoice Pembayaran</p>
        </div>

        <div class="content">
            <div class="invoice-info">
                <div class="info-block">
                    <h3>Informasi Invoice</h3>
                    <div class="invoice-number">{{ $order->order_code }}</div>
                    <p style="margin-top: 16px;">
                        <strong>Tanggal Order:</strong>
                        {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}<br>
                        <strong>Status:</strong>
                        <span class="status-badge 
                            {{ $order->status == 'pending' ? 'status-pending' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>

                <div class="info-block">
                    <h3>Informasi Pelanggan</h3>
                    <p>
                        <strong>Nama:</strong> {{ ucfirst($order->customer->name) }}<br>
                        <strong>Telepon:</strong> {{ $order->customer->phone }}<br>
                        <strong>Alamat:</strong> {{ ucfirst($order->customer->address) }}
                    </p>
                </div>
            </div>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>
                                <div class="item-name">{{ $item->menu->name }}</div>
                                <div class="item-desc">{{ $item->menu->description }}</div>
                            </td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-right">Rp {{ number_format($item->menu->price, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-section">
                @php
                    $total = $order->items->sum('subtotal');
                @endphp
                <div class="total-row grand-total">
                    <span class="label">Total Pembayaran</span>
                    <span class="value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda kepada Rumah Makan Anni</p>
            <p style="margin-top: 8px;">Untuk informasi lebih lanjut, silakan hubungi kami</p>
        </div>
    </div>
</body>
</html>