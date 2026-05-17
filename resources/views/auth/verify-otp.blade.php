@extends('layouts.app')

@section('title', 'Verifikasi OTP - PT. Unggul Cipta Indah')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('image/LOGO UCI.jpeg') }}');">
    <div class="absolute inset-0 bg-[#002855]/80 backdrop-blur-sm"></div>

    <a href="{{ route('password.request') }}" class="absolute top-6 left-6 md:top-8 md:left-8 z-20 p-3 bg-white/10 backdrop-blur-md rounded-full border border-white/20 text-white hover:bg-white/20 hover:scale-110 transition-all duration-200 shadow-lg group" title="Kembali">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>

    <div class="max-w-md w-full space-y-8 bg-white/10 backdrop-blur-xl p-10 rounded-3xl shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] z-10 border border-white/20 text-center">
        <div class="mx-auto w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <h2 class="mt-2 text-3xl font-extrabold text-white tracking-tight drop-shadow-md">Masukkan Kode OTP</h2>
        <p class="mt-2 text-sm text-blue-100">
            Kode OTP telah dikirimkan ke email Anda. Silakan masukkan kode 6 digit tersebut di bawah ini.
        </p>

        <form class="mt-8 space-y-6 text-left" action="{{ route('password.reset') }}" method="GET">
            <div>
                <label for="otp" class="block text-sm font-medium text-white/90 drop-shadow-sm text-center">Kode OTP</label>
                <div class="mt-2 flex justify-center gap-2">
                    <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-bold bg-white/10 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all shadow-inner backdrop-blur-sm" required autofocus>
                    <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-bold bg-white/10 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all shadow-inner backdrop-blur-sm" required>
                    <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-bold bg-white/10 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all shadow-inner backdrop-blur-sm" required>
                    <span class="text-white/40 flex items-center">-</span>
                    <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-bold bg-white/10 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all shadow-inner backdrop-blur-sm" required>
                    <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-bold bg-white/10 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all shadow-inner backdrop-blur-sm" required>
                    <input type="text" maxlength="1" class="w-12 h-14 text-center text-xl font-bold bg-white/10 border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all shadow-inner backdrop-blur-sm" required>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-[#003d7c] bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#003d7c] focus:ring-white shadow-[0_4px_14px_0_rgba(255,255,255,0.39)] transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
                    Verifikasi OTP
                </button>
            </div>
            
            <p class="text-xs text-center text-white/70 mt-4">Belum menerima kode? <a href="#" class="font-bold text-white hover:underline">Kirim ulang</a></p>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="text"][maxlength="1"]');
        inputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    });
</script>
@endsection
