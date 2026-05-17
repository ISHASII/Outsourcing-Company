@extends('layouts.dashboard')

@section('dashboard-title', 'HIRING Management')

@section('dashboard-content')
<div class="space-y-6 animate-fade-in">
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 mb-2">Input Requirement SDM & Posting Lowongan</h3>
        <p class="text-sm text-slate-500 mb-6">Formulir untuk mempublikasikan lowongan kerja baru ke halaman landing page.</p>
        
        <!-- Placeholder Form -->
        <div class="border-2 border-dashed border-slate-200 rounded-xl p-10 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-blue-50 text-[#003d7c] rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <h4 class="font-bold text-slate-700">Form Posting Lowongan</h4>
            <p class="text-xs text-slate-400 mt-1">Modul ini siap dikembangkan untuk mengelola lowongan baru.</p>
        </div>
    </div>
</div>
@endsection
