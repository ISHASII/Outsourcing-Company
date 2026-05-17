@extends('layouts.dashboard')

@section('dashboard-title', 'Overview - HRD Dashboard')

@section('dashboard-content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-[#002855] to-[#004b93] text-white p-8 rounded-3xl shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="absolute inset-0 bg-white/5 backdrop-blur-xs"></div>
        <div class="relative z-10 space-y-2">
            <span class="bg-blue-500/25 text-blue-200 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">HRD Portal</span>
            <h1 class="text-3xl font-extrabold">Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
            <p class="text-blue-100/80 max-w-xl text-sm">Kelola semua berkas lamaran pekerjaan, lowongan aktif, dan seleksi kandidat PT. Unggul Cipta Indah dengan cepat dan efisien.</p>
        </div>
        <div class="relative z-10 bg-white/10 p-4 rounded-2xl border border-white/20 backdrop-blur-md text-center min-w-[150px]">
            <span class="block text-3xl font-bold text-white">4</span>
            <span class="text-xs text-blue-200">Lowongan Aktif</span>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="space-y-1">
                <span class="text-xs font-medium text-slate-400 uppercase">Total Pelamar</span>
                <p class="text-2xl font-bold text-slate-800">128</p>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="space-y-1">
                <span class="text-xs font-medium text-slate-400 uppercase">Perlu Review</span>
                <p class="text-2xl font-bold text-amber-600">32</p>
            </div>
            <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="space-y-1">
                <span class="text-xs font-medium text-slate-400 uppercase">Lolos Seleksi</span>
                <p class="text-2xl font-bold text-green-600">18</p>
            </div>
            <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="space-y-1">
                <span class="text-xs font-medium text-slate-400 uppercase">Ditolak</span>
                <p class="text-2xl font-bold text-red-600">8</p>
            </div>
            <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Active Applications Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 md:p-8 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Lamaran Terbaru Masuk</h3>
                <p class="text-xs text-slate-500">Pelamar kerja yang baru saja mendaftar melalui portal pendaftaran online.</p>
            </div>
            <button class="text-xs font-semibold text-white bg-[#003d7c] hover:bg-[#002d5c] px-4 py-2 rounded-lg transition-colors">
                Lihat Semua Pelamar
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Nama Pelamar</th>
                        <th class="px-6 py-4">Status / Asal</th>
                        <th class="px-6 py-4">Pendidikan</th>
                        <th class="px-6 py-4">Pengalaman Kerja</th>
                        <th class="px-6 py-4">Status Seleksi</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">Budi Santoso</td>
                        <td class="px-6 py-4">WNI / Jawa Barat</td>
                        <td class="px-6 py-4 text-xs font-medium">S1 - Sistem Informasi</td>
                        <td class="px-6 py-4 text-xs">Pernah (PT. Indo Cemerlang - 2 Tahun)</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-amber-50 text-amber-600 font-semibold text-xs rounded-full">Menunggu Review</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline">Detail Pelamar</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">Jennifer Watson</td>
                        <td class="px-6 py-4">WNA / United Kingdom</td>
                        <td class="px-6 py-4 text-xs font-medium">S1 - Business Management</td>
                        <td class="px-6 py-4 text-xs">Pernah (Global Solutions Ltd - 3 Tahun)</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-green-50 text-green-600 font-semibold text-xs rounded-full">Lolos Seleksi</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline">Detail Pelamar</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">Siti Rahmawati</td>
                        <td class="px-6 py-4">WNI / DKI Jakarta</td>
                        <td class="px-6 py-4 text-xs font-medium">D3 - Manajemen Informatika</td>
                        <td class="px-6 py-4 text-xs">Tidak Ada / Fresh Graduate</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 font-semibold text-xs rounded-full">Dalam Penilaian</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline">Detail Pelamar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
