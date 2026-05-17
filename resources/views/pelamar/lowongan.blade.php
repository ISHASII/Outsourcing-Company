@extends('layouts.dashboard')

@section('dashboard-title', 'Cari Lowongan')

@section('dashboard-content')
<div class="space-y-6 animate-fade-in">
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 mb-2">Lowongan Pekerjaan Tersedia</h3>
        <p class="text-sm text-slate-500 mb-6">Cari dan lamar lowongan pekerjaan yang sesuai dengan keahlian Anda.</p>
        
        <div class="border-2 border-dashed border-slate-200 rounded-xl p-10 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-blue-50 text-[#003d7c] rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h4 class="font-bold text-slate-700">Daftar Lowongan</h4>
            <p class="text-xs text-slate-400 mt-1">Sistem katalog pencarian kerja akan dibangun di sini.</p>
        </div>
    </div>
</div>
@endsection
