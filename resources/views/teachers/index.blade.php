@extends('layouts.app')

@php
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }

    $user = auth()->user();
    $isDirector = $user->hasRole('director');
    $isSuperAdmin = $user->hasRole('super_admin');
    $isBranchAdmin = $user->hasRole('branch_admin');

    // Director, Super Admin, Branch Admin bisa add & edit
    $canManage = $isSuperAdmin || $isBranchAdmin || $isDirector;
    $canDelete = $isSuperAdmin; // hanya Super Admin yang bisa hapus

    $routePrefix = $isDirector ? 'director.teachers' : 'teachers';
@endphp

@section('title', __('all.teachers'))
@section('header', __('all.teacher_management'))

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">{{ __('all.all_teachers') }}</h3>
                <p class="text-sm text-gray-500">{{ __('all.manage_teachers') }}</p>
            </div>

            @if ($canManage)
                <a href="{{ route($routePrefix . '.create') }}"
                    class="bg-[#90C74A] hover:bg-[#7db33e] text-white px-5 py-2.5 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md flex items-center gap-2 w-fit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('all.add_new_teacher') }}
                </a>
            @endif
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <form method="GET" action="{{ route($routePrefix . '.index') }}" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="{{ __('all.search_teachers') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A] focus:border-transparent transition">
                </div>

                <select name="status"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#90C74A]">
                    <option value="">{{ __('all.all_status') }}</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('all.active') }}
                    </option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                        {{ __('all.inactive') }}</option>
                </select>

                <button type="submit"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    {{ __('all.search') }}
                </button>

                @if (request('search') || request('status'))
                    <a href="{{ route($routePrefix . '.index') }}"
                        class="text-gray-500 hover:text-gray-700 px-4 py-2.5 rounded-xl flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                        {{ __('all.clear') }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Teachers Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('all.name') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('all.nickname') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('all.gender') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('all.phone') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('all.email') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('all.qualification') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('all.status') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('all.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($teachers as $teacher)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $teacher->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">{{ $teacher->nickname ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm text-gray-600">{{ $teacher->gender == 'male' ? __('all.male') : __('all.female') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">{{ $teacher->phone ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">{{ $teacher->email ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">{{ $teacher->qualification ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $teacher->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $teacher->status == 'active' ? __('all.active') : __('all.inactive') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    {{-- Tombol View --}}
                                    <a href="{{ route($routePrefix . '.show', $teacher) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>

                                    {{-- Tombol Edit --}}
                                    @if ($canManage)
                                        <a href="{{ route($routePrefix . '.edit', $teacher) }}"
                                            class="text-[#90C74A] hover:text-[#7db33e]">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                    @endif

                                    {{-- Tombol Delete --}}
                                    @if ($canDelete)
                                        <button onclick="confirmDelete({{ $teacher->id }})"
                                            class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                        <form id="delete-form-{{ $teacher->id }}"
                                            action="{{ route($routePrefix . '.destroy', $teacher) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <p class="text-gray-500">{{ __('all.no_teachers_found') }}</p>
                                    @if ($canManage)
                                        <a href="{{ route($routePrefix . '.create') }}"
                                            class="mt-3 inline-block text-[#90C74A] hover:underline">
                                            {{ __('all.create_first_teacher') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (isset($teachers) && method_exists($teachers, 'links'))
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $teachers->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(id) {
                if (confirm('{{ __('all.delete_confirm') }}')) {
                    document.getElementById('delete-form-' + id).submit();
                }
            }
        </script>
    @endpush
@endsection
