{{-- ============================================================ --}}
{{-- FILE: resources/views/invoices/show.blade.php              --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Detail Invoice')
@section('header', 'Detail Invoice')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <a href="{{ route('invoices.index') }}"
            class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 transition text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Invoice
        </a>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Invoice Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-[#90C74A] to-[#7db33e] p-6 text-white">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <p class="text-white/70 text-sm mb-1">Nomor Invoice</p>
                        <h2 class="text-2xl font-bold font-mono">{{ $invoice->invoice_number }}</h2>
                        <p class="text-white/80 text-sm mt-2">Diterbitkan: {{ $invoice->generated_at->format('d M Y H:i') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold
                        {{ $invoice->status === 'paid' ? 'bg-white text-green-600' : 'bg-white/20 text-white border border-white/30' }}">
                            {{ $invoice->status_label }}
                        </span>
                        <p class="text-white/70 text-sm mt-2">Jatuh Tempo: {{ $invoice->due_date->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Student Info --}}
                    <div>
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Informasi Siswa</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Nama</span>
                                <span class="font-medium text-gray-800">{{ $invoice->student->full_name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Kode Siswa</span>
                                <span class="font-mono text-gray-700">{{ $invoice->student->student_code ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Cabang</span>
                                <span class="text-gray-700">{{ $invoice->branch->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Orang Tua</span>
                                <span class="text-gray-700">{{ $invoice->student->parent_name ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Info --}}
                    <div>
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Detail Pembayaran</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Program</span>
                                <span class="font-medium text-gray-800">{{ $invoice->program_name }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Periode</span>
                                <span class="text-gray-700">
                                    {{ $invoice->billing_period_start->format('d M Y') }}
                                    –
                                    {{ $invoice->billing_period_end->format('d M Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between text-sm border-t border-gray-100 pt-2 mt-2">
                                <span class="font-semibold text-gray-700">Total</span>
                                <span class="font-bold text-xl text-[#90C74A]">
                                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment Record (if paid) --}}
        @if ($invoice->payment)
            <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                <h4 class="text-sm font-semibold text-green-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pembayaran Dikonfirmasi
                </h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <p class="text-green-600 text-xs">Tanggal Bayar</p>
                        <p class="font-medium text-green-900">{{ $invoice->payment->payment_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-green-600 text-xs">Metode</p>
                        <p class="font-medium text-green-900">{{ $invoice->payment->method_label }}</p>
                    </div>
                    <div>
                        <p class="text-green-600 text-xs">Jumlah Dibayar</p>
                        <p class="font-medium text-green-900">Rp
                            {{ number_format($invoice->payment->amount_paid, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-green-600 text-xs">Dikonfirmasi Oleh</p>
                        <p class="font-medium text-green-900">{{ $invoice->payment->confirmedBy->name ?? '-' }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Coupon / Bukti Bayar (if paid) --}}
        @if ($invoice->coupon)
            <div class="bg-white rounded-xl border-2 border-dashed border-[#90C74A] overflow-hidden">
                <div class="bg-[#90C74A]/5 px-6 py-4 border-b border-dashed border-[#90C74A]">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6 text-[#90C74A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            <h4 class="font-bold text-[#90C74A]">Kupon Bukti Pembayaran</h4>
                        </div>
                        <span class="text-xs text-gray-500">{{ $invoice->coupon->issued_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-center mb-4">
                        <p class="text-xs text-gray-500 mb-1">Kode Kupon</p>
                        <p class="text-2xl font-bold font-mono text-gray-800 tracking-widest">
                            {{ $invoice->coupon->coupon_code }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm border-t border-gray-100 pt-4">
                        <div>
                            <p class="text-gray-500 text-xs">Nama Siswa</p>
                            <p class="font-medium">{{ $invoice->coupon->student_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Program</p>
                            <p class="font-medium">{{ $invoice->coupon->program_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Periode</p>
                            <p class="font-medium">{{ $invoice->coupon->billing_period }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Total Dibayar</p>
                            <p class="font-bold text-[#90C74A]">Rp
                                {{ number_format($invoice->coupon->amount_paid, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                        <p class="text-xs text-gray-400">{{ $invoice->branch->name ?? '' }} · Anaku Educare ·
                            sisfo.anakueducare.id</p>
                        <div class="flex items-center justify-center gap-2 mt-3">
                            <a href="{{ route('coupons.print', $invoice->coupon) }}" target="_blank"
                                class="inline-flex items-center gap-2 bg-[#90C74A] hover:bg-[#7db33e] text-white px-4 py-2 rounded-xl text-sm font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Cetak Kupon
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Payment Confirmation Form --}}
        @if (in_array($invoice->status, ['unpaid', 'overdue', 'pending']))
            <div class="bg-white rounded-xl shadow-sm border border-gray-100" id="confirm">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Pembayaran</h3>
                    <p class="text-sm text-gray-500 mt-1">Isi detail pembayaran yang diterima</p>
                </div>
                <form method="POST" action="{{ route('invoices.confirm-payment', $invoice) }}" class="p-6 space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Dibayar <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="amount_paid" value="{{ $invoice->amount }}" required
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Pembayaran <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                        </div>
                    </div>

                    <div x-data="{ method: 'cash' }">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Metode Pembayaran <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="payment_method" value="cash" x-model="method"
                                    class="sr-only peer" checked>
                                <div
                                    class="text-center p-3 rounded-xl border-2 border-gray-200 peer-checked:border-[#90C74A] peer-checked:bg-[#90C74A]/5 transition">
                                    <svg class="w-6 h-6 mx-auto mb-1 text-gray-400 peer-checked:text-[#90C74A]"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="text-sm font-medium">Tunai</span>
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="payment_method" value="bank_transfer" x-model="method"
                                    class="sr-only peer">
                                <div
                                    class="text-center p-3 rounded-xl border-2 border-gray-200 peer-checked:border-[#90C74A] peer-checked:bg-[#90C74A]/5 transition">
                                    <svg class="w-6 h-6 mx-auto mb-1 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    <span class="text-sm font-medium">Transfer Bank</span>
                                </div>
                            </label>
                        </div>

                        {{-- Bank fields (show only if transfer) --}}
                        <div x-show="method === 'bank_transfer'" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Bank</label>
                                <input type="text" name="bank_name" placeholder="BCA, BNI, Mandiri, dll"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Referensi</label>
                                <input type="text" name="reference_number" placeholder="No. transaksi transfer"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan</label>
                        <textarea name="notes" rows="2" placeholder="Catatan tambahan (opsional)"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition resize-none"></textarea>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                            class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-6 py-2.5 rounded-xl transition font-medium shadow-sm hover:shadow-md">
                            ✓ Konfirmasi Pembayaran & Terbitkan Kupon
                        </button>
                        <a href="{{ route('invoices.index') }}"
                            class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        @endif

    </div>
@endsection
