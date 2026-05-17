<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes with Role Guard
Route::middleware(['auth'])->group(function () {
    // === HRD ROUTES ===
    Route::prefix('hrd')->group(function () {
        Route::get('/dashboard', function () {
            if (Auth::user()->role !== 'hrd') return redirect()->route('pelamar.dashboard');
            return view('hrd.dashboard');
        })->name('hrd.dashboard');

        Route::get('/hiring', function () {
            if (Auth::user()->role !== 'hrd') return redirect()->route('pelamar.dashboard');
            return view('hrd.hiring');
        })->name('hrd.hiring');

        Route::get('/pelamar-aktif', function () {
            if (Auth::user()->role !== 'hrd') return redirect()->route('pelamar.dashboard');
            return view('hrd.pelamar-aktif');
        })->name('hrd.pelamar-aktif');

        Route::get('/profil', function () {
            if (Auth::user()->role !== 'hrd') return redirect()->route('pelamar.dashboard');
            return view('hrd.profil');
        })->name('hrd.profil');
    });

    // === PELAMAR ROUTES ===
    Route::prefix('pelamar')->group(function () {
        Route::get('/dashboard', function () {
            if (Auth::user()->role !== 'pelamar') return redirect()->route('hrd.dashboard');
            return view('pelamar.dashboard');
        })->name('pelamar.dashboard');

        Route::get('/profil', function () {
            if (Auth::user()->role !== 'pelamar') return redirect()->route('hrd.dashboard');
            return view('pelamar.profil');
        })->name('pelamar.profil');

        Route::get('/riwayat', function () {
            if (Auth::user()->role !== 'pelamar') return redirect()->route('hrd.dashboard');
            return view('pelamar.riwayat');
        })->name('pelamar.riwayat');

        Route::get('/lowongan', function () {
            if (Auth::user()->role !== 'pelamar') return redirect()->route('hrd.dashboard');
            return view('pelamar.lowongan');
        })->name('pelamar.lowongan');
    });
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/verify-otp', function () {
    return view('auth.verify-otp');
})->name('password.verify');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');
