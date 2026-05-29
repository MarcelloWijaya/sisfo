<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }} - Anaku Educare</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            color: #222;
            font-size: 13px;
        }

        .page {
            width: 210mm;
            min-height: 148mm;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.10);
        }

        /* ── TOP ACCENT BAR ── */
        .accent-bar {
            height: 6px;
            background: linear-gradient(90deg, #90C74A 0%, #c8e87a 50%, #90C74A 100%);
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 28px 16px;
            border-bottom: 1.5px solid #e8f5d0;
            background: linear-gradient(135deg, #f9fffe 0%, #f0fae3 100%);
        }

        .header-left {
            flex: 1;
        }

        .branch-name {
            font-size: 18px;
            font-weight: 900;
            color: #2d5a1b;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .brand-tag {
            display: inline-block;
            background: #90C74A;
            color: white;
            font-size: 9px;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 20px;
            letter-spacing: 1px;
            margin-top: 3px;
        }

        .branch-address {
            font-size: 10.5px;
            color: #555;
            margin-top: 6px;
            line-height: 1.5;
        }

        .header-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: contain;
            border: 2px solid #e8f5d0;
            background: white;
            padding: 4px;
        }

        .logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, #90C74A, #7db33e);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 9px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .logo-icon {
            font-size: 24px;
            margin-bottom: 2px;
        }

        /* ── INVOICE TITLE BAND ── */
        .invoice-band {
            background: linear-gradient(90deg, #90C74A, #7db33e);
            padding: 8px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .invoice-band h2 {
            color: white;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .invoice-band .inv-number {
            color: rgba(255, 255, 255, 0.9);
            font-size: 12px;
            font-family: monospace;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* ── META INFO ── */
        .meta-section {
            padding: 16px 28px;
            display: flex;
            gap: 40px;
            background: #fafafa;
            border-bottom: 1px solid #eee;
        }

        .meta-group {
            flex: 1;
        }

        .meta-row {
            display: flex;
            gap: 8px;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .meta-label {
            color: #888;
            min-width: 90px;
            font-size: 11px;
        }

        .meta-value {
            color: #222;
            font-weight: 600;
        }

        .meta-value.highlight {
            color: #2d5a1b;
            font-size: 13px;
        }

        /* ── TABLE ── */
        .table-section {
            padding: 0 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        thead tr {
            background: linear-gradient(90deg, #2d5a1b, #3d7a25);
        }

        thead th {
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 10px 14px;
            text-align: left;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        thead th:last-child {
            text-align: right;
        }

        tbody tr {
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr:nth-child(even) {
            background: #f9fef2;
        }

        tbody td {
            padding: 11px 14px;
            font-size: 12.5px;
            color: #333;
            vertical-align: middle;
        }

        tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .coupon-code {
            display: inline-block;
            background: #90C74A;
            color: white;
            font-family: monospace;
            font-size: 12px;
            font-weight: bold;
            padding: 3px 10px;
            border-radius: 6px;
            letter-spacing: 1px;
        }

        .discount-row td {
            color: #dc2626;
            font-style: italic;
        }

        .discount-row td:last-child {
            color: #dc2626;
        }

        /* ── TOTAL ROW ── */
        .total-row {
            background: linear-gradient(90deg, #f0fae3, #e8f5d0) !important;
            border-top: 2px solid #90C74A !important;
        }

        .total-row td {
            padding: 13px 14px !important;
            font-weight: 700 !important;
            font-size: 14px !important;
        }

        .total-row td:last-child {
            color: #2d5a1b !important;
            font-size: 16px !important;
        }

        /* ── PAYMENT METHOD ── */
        .payment-method {
            padding: 12px 28px;
            font-size: 11.5px;
            color: #555;
            border-top: 1px dashed #ddd;
            background: #fafafa;
        }

        /* ── FOOTER ── */
        .footer {
            padding: 16px 28px 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-top: 1px solid #eee;
        }

        .notes-section {
            flex: 1;
        }

        .notes-title {
            font-size: 10px;
            font-weight: bold;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .notes-text {
            font-size: 10.5px;
            color: #666;
            line-height: 1.5;
            font-style: italic;
        }

        .signature-section {
            text-align: center;
            min-width: 160px;
        }

        .signature-date {
            font-size: 11px;
            color: #555;
            margin-bottom: 4px;
        }

        .signature-line {
            border-bottom: 1.5px solid #333;
            margin: 40px 20px 6px;
        }

        .signature-label {
            font-size: 10.5px;
            color: #555;
            font-weight: 600;
        }

        /* ── PAID STAMP ── */
        .paid-stamp {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            border: 4px solid #90C74A;
            border-radius: 8px;
            color: #90C74A;
            font-size: 36px;
            font-weight: 900;
            padding: 4px 16px;
            letter-spacing: 3px;
            opacity: 0.12;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }

        .table-wrapper {
            position: relative;
        }

        /* ── BOTTOM BAR ── */
        .bottom-bar {
            height: 4px;
            background: linear-gradient(90deg, #7db33e 0%, #90C74A 50%, #7db33e 100%);
        }

        /* ── PRINT BUTTON ── */
        .print-actions {
            text-align: center;
            padding: 20px;
        }

        .btn-print {
            background: #90C74A;
            color: white;
            border: none;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 8px;
        }

        .btn-close {
            background: #eee;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
        }

        @media print {
            body {
                background: white;
            }

            .page {
                margin: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .print-actions {
                display: none;
            }
        }
    </style>
</head>

<body>

    {{-- Print Actions (hidden on print) --}}
    <div class="print-actions">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak Invoice</button>
        <button class="btn-close" onclick="window.history.back()">← Kembali</button>
    </div>

    <div class="page">
        {{-- Top accent --}}
        <div class="accent-bar"></div>

        {{-- Header --}}
        <div class="header">
            <div class="header-left">
                <div class="branch-name">{{ $invoice->branch->name ?? 'Anaku Educare' }}</div>
                <span class="brand-tag">ANAKU EDUCARE</span>
                <div class="branch-address">
                    {{ $invoice->branch->address ?? 'Jl. Contoh No. 1, Jakarta' }}<br>
                    @if ($invoice->branch->phone ?? false)
                        Telp. {{ $invoice->branch->phone }}
                    @endif
                    @if ($invoice->branch->email ?? false)
                        &nbsp;·&nbsp; {{ $invoice->branch->email }}
                    @endif
                </div>
            </div>

            {{-- Logo: ambil dari storage jika ada, fallback ke placeholder --}}
            @if (file_exists(public_path('images/logo.png')) || file_exists(public_path('images/logo.jpg')))
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="header-logo"
                    onerror="this.style.display='none'; document.getElementById('logo-placeholder').style.display='flex';">
                <div id="logo-placeholder" class="logo-placeholder" style="display:none;">
                    <div class="logo-icon">🎓</div>
                    <div>ANAKU<br>EDUCARE</div>
                </div>
            @else
                <div class="logo-placeholder">
                    <div class="logo-icon">🎓</div>
                    <div>ANAKU<br>EDUCARE</div>
                </div>
            @endif
        </div>

        {{-- Invoice Title Band --}}
        <div class="invoice-band">
            <h2>Bukti Pembayaran SPP</h2>
            <span class="inv-number">{{ $invoice->invoice_number }}</span>
        </div>

        {{-- Meta Info --}}
        <div class="meta-section">
            <div class="meta-group">
                <div class="meta-row">
                    <span class="meta-label">No. Invoice</span>
                    <span class="meta-value" style="font-family:monospace;">{{ $invoice->invoice_number }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Tanggal</span>
                    <span
                        class="meta-value">{{ ($invoice->payment->payment_date ?? $invoice->created_at)->format('d-m-Y') }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">No. Kupon</span>
                    <span class="meta-value" style="font-family:monospace; color:#90C74A;">
                        {{ $invoice->coupon->coupon_code ?? '-' }}
                    </span>
                </div>
            </div>
            <div class="meta-group">
                <div class="meta-row">
                    <span class="meta-label">Nama Murid</span>
                    <span class="meta-value highlight">{{ $invoice->student->full_name ?? '-' }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">No. Murid</span>
                    <span class="meta-value"
                        style="font-family:monospace;">{{ $invoice->student->student_code ?? '-' }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Orang Tua</span>
                    <span class="meta-value">{{ $invoice->student->parent_name ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-section">
            <div class="table-wrapper">
                {{-- Paid watermark --}}
                @if ($invoice->status === 'paid')
                    <div class="paid-stamp">LUNAS</div>
                @endif

                <table>
                    <thead>
                        <tr>
                            <th style="width:28%;">No Kupon</th>
                            <th>Keterangan</th>
                            <th style="width:22%; text-align:right;">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Main item row --}}
                        <tr>
                            <td>
                                @if ($invoice->coupon)
                                    <span class="coupon-code">{{ $invoice->coupon->coupon_code }}</span>
                                @else
                                    <span style="color:#aaa; font-style:italic;">Belum ada kupon</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $invoice->program_name }}</strong>
                                <br>
                                <span style="font-size:11px; color:#777;">
                                    Periode: {{ $invoice->billing_period_start->format('d M Y') }}
                                    – {{ $invoice->billing_period_end->format('d M Y') }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($invoice->amount, 0, ',', '.') }},-</td>
                        </tr>

                        {{-- Discount row (if applicable — add discount field to invoice if needed) --}}
                        @if (isset($invoice->discount_amount) && $invoice->discount_amount > 0)
                            <tr class="discount-row">
                                <td></td>
                                <td>{{ $invoice->discount_note ?? 'Diskon' }}</td>
                                <td>-Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }},-</td>
                            </tr>
                        @endif

                        {{-- Total --}}
                        <tr class="total-row">
                            <td></td>
                            <td style="text-align:right; color:#2d5a1b;">Jumlah Total</td>
                            <td>Rp
                                {{ number_format($invoice->payment->amount_paid ?? $invoice->amount, 0, ',', '.') }},-
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Payment Method --}}
        <div class="payment-method">
            @if ($invoice->payment)
                Pembayaran melalui:
                <strong>
                    {{ $invoice->payment->payment_method === 'cash' ? 'Tunai (Cash)' : 'Transfer Bank' }}
                    @if ($invoice->payment->bank_name)
                        – {{ $invoice->payment->bank_name }}
                    @endif
                    @if ($invoice->payment->reference_number)
                        (Ref: {{ $invoice->payment->reference_number }})
                    @endif
                </strong>
            @else
                Pembayaran melalui mesin EDC atau via transfer ke rekening cabang.
            @endif
        </div>

        {{-- Footer --}}
        <div class="footer">
            <div class="notes-section">
                <div class="notes-title">Catatan</div>
                <div class="notes-text">
                    Setiap cabang Anaku Educare beroperasi dan memiliki kepemilikan secara mandiri.<br>
                    Simpan bukti pembayaran ini sebagai tanda lunas yang sah.<br>
                    Untuk informasi lebih lanjut hubungi admin cabang Anda.
                </div>
            </div>

            <div class="signature-section">
                <div class="signature-date">
                    ..................., {{ ($invoice->payment->payment_date ?? now())->format('d-m-Y') }}
                </div>
                <div class="signature-line"></div>
                <div class="signature-label">{{ $invoice->branch->name ?? 'Anaku Educare' }}</div>
                <div style="font-size:10px; color:#aaa; margin-top:2px;">Admin / Kasir</div>
            </div>
        </div>

        {{-- Bottom accent --}}
        <div class="bottom-bar"></div>
    </div>

    <div class="print-actions">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak Invoice</button>
        <button class="btn-close" onclick="window.history.back()">← Kembali</button>
    </div>

</body>

</html>
