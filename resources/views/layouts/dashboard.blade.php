@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50/50 flex relative" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">
    
    <!-- Background Elements for Glassmorphism Context -->
    <div class="fixed top-0 left-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none -translate-x-1/2 -translate-y-1/2 z-0"></div>
    <div class="fixed bottom-0 right-0 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none translate-x-1/3 translate-y-1/3 z-0"></div>

    <!-- Desktop Sidebar (Glassmorphism) -->
    <aside :class="sidebarCollapsed ? 'w-[80px]' : 'w-[280px]'" class="hidden lg:flex flex-col bg-white/70 backdrop-blur-2xl border-r border-white/50 text-slate-700 fixed h-full z-20 shadow-[4px_0_30px_rgba(0,0,0,0.03)] transition-all duration-300 overflow-x-hidden">
        
        <!-- Logo Header -->
        <div class="h-20 flex items-center px-4 border-b border-slate-200/50 shrink-0 transition-all" :class="sidebarCollapsed ? 'justify-center cursor-pointer hover:bg-slate-50/50' : 'justify-between'" @click="if(sidebarCollapsed) sidebarCollapsed = false" title="Buka Menu">
            <div class="flex items-center gap-3 overflow-hidden">
                <div class="bg-white p-1 rounded-lg shadow-sm border border-slate-100 shrink-0 mx-auto transition-transform duration-300" :class="sidebarCollapsed ? 'scale-110 shadow-md' : ''">
                    <img src="{{ asset('image/LOGO UCI.jpeg') }}" alt="Logo" class="w-8 h-8 object-contain rounded">
                </div>
                <div x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="whitespace-nowrap">
                    <h1 class="text-sm font-extrabold text-[#003d7c] leading-tight">PT. UCI</h1>
                    <p class="text-[10px] text-slate-500 font-semibold tracking-wider uppercase">Portal Dashboard</p>
                </div>
            </div>
            
            <button @click.stop="sidebarCollapsed = true" x-show="!sidebarCollapsed" class="p-1.5 rounded-lg text-slate-400 hover:bg-slate-200 hover:text-slate-700 transition-all focus:outline-none flex-shrink-0 bg-slate-50" title="Tutup Menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-grow p-4 space-y-1 overflow-y-auto overflow-x-hidden z-10 custom-scrollbar">
            @if(Auth::user()->role === 'hrd')
                <!-- HRD SIDEBAR LINKS -->
                <div class="border-b border-slate-200/50 pb-1 mb-1">
                    <a href="{{ route('hrd.dashboard') }}" title="Dashboard" class="flex items-center px-4 py-3 rounded-xl transition-all {{ Request::routeIs('hrd.dashboard') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#003d7c] hover:shadow-md border border-transparent hover:border-blue-100' }}">
                        <svg class="w-5 h-5 shrink-0" :class="sidebarCollapsed ? 'mx-auto' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="font-semibold text-sm whitespace-nowrap">Dashboard</span>
                    </a>
                </div>
                
                <div class="border-b border-slate-200/50 pb-1 mb-1">
                    <a href="{{ route('hrd.hiring') }}" title="HIRING" class="flex items-center px-4 py-3 rounded-xl transition-all {{ Request::routeIs('hrd.hiring') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#003d7c] hover:shadow-md border border-transparent hover:border-blue-100' }}">
                        <svg class="w-5 h-5 shrink-0" :class="sidebarCollapsed ? 'mx-auto' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="font-semibold text-sm whitespace-nowrap">HIRING</span>
                    </a>
                </div>

                <div class="border-b border-slate-200/50 pb-1 mb-1">
                    <a href="{{ route('hrd.pelamar-aktif') }}" title="Data Pelamar Aktif" class="flex items-center px-4 py-3 rounded-xl transition-all {{ Request::routeIs('hrd.pelamar-aktif') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#003d7c] hover:shadow-md border border-transparent hover:border-blue-100' }}">
                        <svg class="w-5 h-5 shrink-0" :class="sidebarCollapsed ? 'mx-auto' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="font-semibold text-sm whitespace-nowrap">Data Pelamar Aktif</span>
                    </a>
                </div>


            @else
                <!-- PELAMAR SIDEBAR LINKS -->
                <div class="border-b border-slate-200/50 pb-1 mb-1">
                    <a href="{{ route('pelamar.dashboard') }}" title="Dashboard" class="flex items-center px-4 py-3 rounded-xl transition-all {{ Request::routeIs('pelamar.dashboard') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#003d7c] hover:shadow-md border border-transparent hover:border-blue-100' }}">
                        <svg class="w-5 h-5 shrink-0" :class="sidebarCollapsed ? 'mx-auto' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="font-semibold text-sm whitespace-nowrap">Dashboard</span>
                    </a>
                </div>

                <div class="border-b border-slate-200/50 pb-1 mb-1">
                    <a href="{{ route('pelamar.riwayat') }}" title="Riwayat Lamaran" class="flex items-center px-4 py-3 rounded-xl transition-all {{ Request::routeIs('pelamar.riwayat') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#003d7c] hover:shadow-md border border-transparent hover:border-blue-100' }}">
                        <svg class="w-5 h-5 shrink-0" :class="sidebarCollapsed ? 'mx-auto' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="font-semibold text-sm whitespace-nowrap">Riwayat Lamaran</span>
                    </a>
                </div>
                <div class="border-b border-slate-200/50 pb-1 mb-1">
                    <a href="{{ route('pelamar.lowongan') }}" title="Cari Lowongan" class="flex items-center px-4 py-3 rounded-xl transition-all {{ Request::routeIs('pelamar.lowongan') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#003d7c] hover:shadow-md border border-transparent hover:border-blue-100' }}">
                        <svg class="w-5 h-5 shrink-0" :class="sidebarCollapsed ? 'mx-auto' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="font-semibold text-sm whitespace-nowrap">Cari Lowongan</span>
                    </a>
                </div>
            @endif
        </nav>

        <!-- Sidebar Footer Controls -->
        <div class="p-4 border-t border-slate-200/60 shrink-0">
            <div class="border-b border-slate-200/50 pb-1 mb-1">
                <a href="#" title="Pengaturan" class="flex items-center px-4 py-3 rounded-xl text-slate-600 hover:bg-blue-50 hover:text-[#003d7c] hover:shadow-md border border-transparent hover:border-blue-100 transition-all">
                    <svg class="w-5 h-5 shrink-0" :class="sidebarCollapsed ? 'mx-auto' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="font-semibold text-sm whitespace-nowrap">Pengaturan</span>
                </a>
            </div>
            
            <div class="border-b border-slate-200/50 pb-1 mb-1">
                <form action="{{ route('logout') }}" method="POST" class="block w-full">
                    @csrf
                    <button type="submit" title="Keluar / Logout" class="flex items-center w-full px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 hover:text-red-700 transition-all text-left">
                        <svg class="w-5 h-5 shrink-0" :class="sidebarCollapsed ? 'mx-auto' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span x-show="!sidebarCollapsed" x-transition.opacity.duration.300ms class="font-semibold text-sm whitespace-nowrap">Keluar / Logout</span>
                    </button>
                </form>
            </div>


        </div>
    </aside>

    <!-- Mobile Drawer Sidebar (Glassmorphism backdrop) -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden flex" x-cloak>
        <!-- Overlay -->
        <div @click="sidebarOpen = false" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity duration-300"></div>

        <!-- Sidebar Content -->
        <div class="relative flex-1 flex flex-col max-w-[280px] w-full bg-white/95 backdrop-blur-2xl border-r border-white text-slate-700 transition duration-300 transform shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">
            
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none bg-white/10 text-white hover:bg-white/20 transition-colors">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" /></svg>
                </button>
            </div>

            <!-- Logo Header -->
            <div class="h-20 flex items-center gap-3 px-6 border-b border-slate-200/50 shrink-0">
                <div class="bg-white p-1 rounded-lg shadow-sm border border-slate-100">
                    <img src="{{ asset('image/LOGO UCI.jpeg') }}" alt="Logo" class="w-8 h-8 object-contain rounded">
                </div>
                <div>
                    <h1 class="text-sm font-extrabold text-[#003d7c] leading-tight">PT. UCI</h1>
                    <p class="text-[10px] text-slate-500 font-semibold tracking-wider uppercase">Portal Dashboard</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-grow p-4 space-y-1 overflow-y-auto z-10">
                @if(Auth::user()->role === 'hrd')
                    <div class="border-b border-slate-200/50 pb-1 mb-1">
                        <a href="{{ route('hrd.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('hrd.dashboard') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-slate-50 hover:text-[#003d7c]' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                            <span class="font-semibold text-sm">Dashboard</span>
                        </a>
                    </div>
                    <div class="border-b border-slate-200/50 pb-1 mb-1">
                        <a href="{{ route('hrd.hiring') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('hrd.hiring') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-slate-50 hover:text-[#003d7c]' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="font-semibold text-sm">HIRING</span>
                        </a>
                    </div>
                    <div class="border-b border-slate-200/50 pb-1 mb-1">
                        <a href="{{ route('hrd.pelamar-aktif') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('hrd.pelamar-aktif') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-slate-50 hover:text-[#003d7c]' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="font-semibold text-sm">Data Pelamar Aktif</span>
                        </a>
                    </div>

                @else
                    <div class="border-b border-slate-200/50 pb-1 mb-1">
                        <a href="{{ route('pelamar.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('pelamar.dashboard') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-slate-50 hover:text-[#003d7c]' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                            <span class="font-semibold text-sm">Dashboard</span>
                        </a>
                    </div>

                    <div class="border-b border-slate-200/50 pb-1 mb-1">
                        <a href="{{ route('pelamar.riwayat') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('pelamar.riwayat') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-slate-50 hover:text-[#003d7c]' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            <span class="font-semibold text-sm">Riwayat Lamaran</span>
                        </a>
                    </div>
                    <div class="border-b border-slate-200/50 pb-1 mb-1">
                        <a href="{{ route('pelamar.lowongan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('pelamar.lowongan') ? 'bg-[#003d7c] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-slate-50 hover:text-[#003d7c]' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="font-semibold text-sm">Cari Lowongan</span>
                        </a>
                    </div>
                @endif
            </nav>

            <div class="p-4 border-t border-slate-200/60 shrink-0">
                <div class="border-b border-slate-200/50 pb-1 mb-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-[#003d7c] transition-all">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="font-semibold text-sm">Pengaturan</span>
                    </a>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" class="block w-full mt-1">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 hover:text-red-700 transition-all text-left">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="font-semibold text-sm">Keluar / Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div :class="sidebarCollapsed ? 'lg:ml-[80px]' : 'lg:ml-[280px]'" class="flex-1 flex flex-col min-w-0 z-10 relative transition-all duration-300">
        <!-- Dashboard Top Navbar -->
        <header class="bg-white/80 backdrop-blur-xl h-20 shadow-[0_1px_10px_rgba(0,0,0,0.02)] border-b border-white flex items-center justify-between px-6 md:px-8 sticky top-0 z-10">
            <!-- Mobile Menu Toggle -->
            <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-white hover:shadow-sm focus:outline-none transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
            </button>

            <!-- Dashboard Title / Current Date -->
            <div class="hidden sm:block">
                <h2 class="text-xl font-extrabold text-[#003d7c] tracking-tight">
                    @yield('dashboard-title', 'Dashboard')
                </h2>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mt-0.5">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>

            <!-- Profile Info / Navigation -->
            <div class="flex items-center gap-4 ml-auto">
                <a href="{{ url('/') }}" class="text-[11px] font-bold text-[#003d7c] bg-white border border-[#003d7c]/10 hover:bg-blue-50 px-4 py-2 rounded-xl transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Web Utama
                </a>
                
                <a href="{{ Auth::user()->role === 'hrd' ? route('hrd.profil') : route('pelamar.profil') }}" class="flex items-center gap-3 pl-4 border-l border-slate-200/60 hover:opacity-80 transition-opacity cursor-pointer group">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#003d7c] to-[#005fb8] text-white flex items-center justify-center font-bold text-sm shadow-md uppercase border-2 border-white group-hover:scale-105 transition-transform">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-bold text-slate-800 leading-none mb-1 group-hover:text-[#003d7c] transition-colors">{{ Auth::user()->name }}</p>
                        <span class="text-[10px] text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md uppercase font-bold">{{ Auth::user()->role }}</span>
                    </div>
                </a>
            </div>
        </header>

        <!-- Main Workspace -->
        <main class="flex-grow p-6 md:p-8 overflow-y-auto">
            @yield('dashboard-content')
        </main>
    </div>
</div>

<!-- Alpine.js fallback in case it's not loaded globally -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
    /* Custom Scrollbar for Sidebar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(203, 213, 225, 0.5); /* slate-300 with opacity */
        border-radius: 4px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.8); /* slate-400 with opacity */
    }
</style>
@endsection
