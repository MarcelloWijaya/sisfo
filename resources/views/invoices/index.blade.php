{{-- ============================================================ --}}
{{-- FILE: resources/views/invoices/index.blade.php             --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Invoice')
@section('header', 'Manajemen Invoice')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Daftar Invoice</h3>
                <p class="text-sm text-gray-500">Kelola invoice dan konfirmasi pembayaran</p>
            </div>
            <a href="{{ route('invoices.create') }}"
                class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-5 py-2.5 rounded-xl transition shadow-sm hover:shadow-md flex items-center gap-2 w-fit">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Buat Invoice
            </a>
        </div>

        {{-- Success Alert --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Summary Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $statusCards = [
                    [
                        'key' => 'unpaid',
                        'label' => 'Belum Bayar',
                        'color' => 'yellow',
                        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    [
                        'key' => 'pending',
                        'label' => 'Menunggu',
                        'color' => 'blue',
                        'icon' =>
                            'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    ],
                    [
                        'key' => 'paid',
                        'label' => 'Lunas',
                        'color' => 'green',
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    [
                        'key' => 'overdue',
                        'label' => 'Terlambat',
                        'color' => 'red',
                        'icon' =>
                            'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                    ],
                ];
            @endphp
            @foreach ($statusCards as $card)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-medium text-gray-500">{{ $card['label'] }}</span>
                        <div class="w-8 h-8 bg-{{ $card['color'] }}-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-{{ $card['color'] }}-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $card['icon'] }}" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800">{{ $summary[$card['key']]->count ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        Rp {{ number_format($summary[$card['key']]->total ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <form method="GET" class="flex flex-wrap gap-3">
                @if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('director'))
                    <select name="branch_id"
                        class="px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent text-sm">
                        <option value="">Semua Cabang</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}</option>
                        @endforeach
                    </select>
                @endif

                <select name="status"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent text-sm">
                    <option value="">Semua Status</option>
                    <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                    <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Terlambat</option>
                </select>

                <input type="month" name="month" value="{{ request('month') }}"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent text-sm">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama siswa / no invoice..."
                    class="px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent text-sm flex-1 min-w-48">

                <button type="submit"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl transition text-sm">
                    Filter
                </button>
                @if (request()->hasAny(['branch_id', 'status', 'month', 'search']))
                    <a href="{{ route('invoices.index') }}"
                        class="text-gray-500 hover:text-gray-700 px-4 py-2.5 rounded-xl text-sm flex items-center">Hapus
                        Filter</a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Invoice</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Program</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jatuh Tempo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($invoices as $invoice)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm font-mono font-medium text-gray-800">{{ $invoice->invoice_number }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 bg-[#90C74A]/10 rounded-full flex items-center justify-center flex-shrink-0">
                                            <span
                                                class="text-[#90C74A] text-xs font-bold">{{ substr($invoice->student->full_name ?? 'S', 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">
                                                {{ $invoice->student->full_name ?? '-' }}</p>
                                            <p class="text-xs text-gray-500">{{ $invoice->branch->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $invoice->program_name }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold text-gray-800">
                                        Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm {{ $invoice->due_date->isPast() && $invoice->status !== 'paid' ? 'text-red-600 font-medium' : 'text-gray-600' }}">
                                        {{ $invoice->due_date->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $invoice->status_badge }}">
                                        {{ $invoice->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('invoices.show', $invoice) }}"
                                        class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    @if (in_array($invoice->status, ['unpaid', 'overdue', 'pending']))
                                        <a href="{{ route('invoices.show', $invoice) }}#confirm"
                                            class="inline-flex items-center text-[#90C74A] hover:text-[#7db33e] transition text-xs font-medium border border-[#90C74A] px-2.5 py-1 rounded-lg">
                                            Konfirmasi
                                        </a>
                                    @endif
                                    @if ($invoice->status === 'paid' && $invoice->coupon)
                                        <a href="{{ route('coupons.show', $invoice->coupon) }}"
                                            class="inline-flex items-center text-purple-600 hover:text-purple-800 transition text-xs font-medium border border-purple-300 px-2.5 py-1 rounded-lg">
                                            Kupon
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-gray-500">Tidak ada invoice ditemukan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($invoices->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">{{ $invoices->links() }}</div>
            @endif
        </div>
    </div>
@endsection
