@extends('layouts.dashboard')

@section('dashboard-title', 'Riwayat Lamaran')

@section('dashboard-content')
<div class="space-y-6 animate-fade-in">
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 mb-2">Riwayat & Status Lamaran</h3>
        <p class="text-sm text-slate-500 mb-6">Pantau proses evaluasi berkas Anda di sini.</p>
        
        <div class="border-2 border-dashed border-slate-200 rounded-xl p-10 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-blue-50 text-[#003d7c] rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <h4 class="font-bold text-slate-700">Belum Ada Riwayat Lamaran</h4>
            <p class="text-xs text-slate-400 mt-1">Anda belum melamar lowongan apa pun sejauh ini.</p>
        </div>
    </div>
</div>
@endsection
