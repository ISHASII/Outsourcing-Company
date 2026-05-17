@extends('layouts.dashboard')

@section('dashboard-title', 'Overview - Dashboard Pelamar')

@section('dashboard-content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-[#003d7c] to-[#0060b6] text-white p-8 rounded-3xl shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="absolute inset-0 bg-white/5 backdrop-blur-xs"></div>
        <div class="relative z-10 space-y-2">
            <span class="bg-blue-500/25 text-blue-200 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">Pelamar Portal</span>
            <h1 class="text-3xl font-extrabold">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-blue-100/80 max-w-xl text-sm">Ini adalah halaman dashboard pribadi Anda. Pantau status berkas lamaran, lengkapi profil diri, dan cari lowongan kerja aktif di sini.</p>
        </div>
        <div class="relative z-10 bg-white/10 p-4 rounded-2xl border border-white/20 backdrop-blur-md text-center min-w-[150px]">
            <span class="text-xs text-blue-200 block mb-1">Status Profil</span>
            <span class="px-2.5 py-1 bg-amber-500/30 text-amber-200 font-semibold text-xs rounded-full">Belum Lengkap</span>
        </div>
    </div>

    <!-- Application Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="space-y-1">
                <span class="text-xs font-medium text-slate-400 uppercase">Lamaran Aktif</span>
                <p class="text-2xl font-bold text-slate-800">1</p>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="space-y-1">
                <span class="text-xs font-medium text-slate-400 uppercase">Menunggu Review</span>
                <p class="text-2xl font-bold text-amber-600">1</p>
            </div>
            <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
            <div class="space-y-1">
                <span class="text-xs font-medium text-slate-400 uppercase">Seleksi Lolos</span>
                <p class="text-2xl font-bold text-green-600">0</p>
            </div>
            <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Active Job Listings and User Applications -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Side: User Application Progress -->
        <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm lg:col-span-2 space-y-6">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Status Berkas Lamaran Anda</h3>
                <p class="text-xs text-slate-500">Pantau proses evaluasi dari lamaran pekerjaan yang sedang Anda jalani.</p>
            </div>
            
            <div class="border border-slate-100 rounded-2xl p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="text-xs bg-blue-50 text-[#003d7c] font-semibold px-2 py-0.5 rounded">Full-Time</span>
                    <h4 class="font-bold text-slate-800 text-base">Staff Administrasi Operasional</h4>
                    <p class="text-xs text-slate-400">Departemen Operational Support</p>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <span class="px-2.5 py-1 bg-amber-50 text-amber-600 font-bold text-xs rounded-full">Menunggu Review HRD</span>
                    <span class="text-[10px] text-slate-400">Dikirim: {{ now()->subDays(2)->isoFormat('D MMMM YYYY') }}</span>
                </div>
            </div>
        </div>

        <!-- Right Side: Complete Profile CTA -->
        <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">Lengkapi Profil Anda</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Profil yang lengkap akan mempermudah tim HRD PT. Unggul Cipta Indah dalam mengevaluasi lamaran dan skill Anda secara akurat.</p>
            </div>
            
            <a href="#" class="inline-flex justify-center items-center w-full py-3 px-4 border border-transparent text-xs font-bold rounded-xl text-white bg-[#003d7c] hover:bg-[#002d5c] shadow-sm transition-colors text-center mt-4">
                Mulai Lengkapi Profil
            </a>
        </div>
    </div>
</div>
@endsection
