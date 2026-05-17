@extends('layouts.dashboard')

@section('dashboard-title', 'Data Pelamar Aktif')

@section('dashboard-content')
<div class="space-y-6 animate-fade-in">
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 mb-2">Daftar Pelamar Aktif</h3>
        <p class="text-sm text-slate-500 mb-6">Kelola dan tinjau data pelamar yang sedang mengikuti proses rekrutmen.</p>
        
        <div class="border-2 border-dashed border-slate-200 rounded-xl p-10 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-blue-50 text-[#003d7c] rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h4 class="font-bold text-slate-700">Database Pelamar</h4>
            <p class="text-xs text-slate-400 mt-1">Data table pelamar akan ditampilkan di sini.</p>
        </div>
    </div>
</div>
@endsection
