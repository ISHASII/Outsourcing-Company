@extends('layouts.dashboard')

@section('dashboard-title', 'Profil Saya')

@section('dashboard-content')
<div class="space-y-6 animate-fade-in">
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 mb-2">Lengkapi Data Diri Anda</h3>
        <p class="text-sm text-slate-500 mb-6">Pastikan seluruh informasi Anda valid sebelum melamar pekerjaan.</p>
        
        <div class="border-2 border-dashed border-slate-200 rounded-xl p-10 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-blue-50 text-[#003d7c] rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <h4 class="font-bold text-slate-700">Form Biodata Lengkap</h4>
            <p class="text-xs text-slate-400 mt-1">Area form pengisian CV dan profil lengkap.</p>
        </div>
    </div>
</div>
@endsection
