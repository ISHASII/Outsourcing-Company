@extends('layouts.app')

@section('title', 'PT. Unggul Cipta Indah | Professional Outsourcing')

@section('content')
    <div class="min-h-screen flex flex-col font-sans text-slate-800 bg-slate-50">
        <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <a href="#beranda" class="flex items-center gap-2">
                        <div class="bg-[#003d7c] p-2 rounded-lg">
                            <span class="w-6 h-6 inline-flex items-center justify-center text-white font-bold">UI</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-900 leading-tight">PT. Unggul Cipta Indah</h1>
                            <p class="text-xs text-[#003d7c] font-semibold tracking-wide uppercase">Professional Outsourcing
                            </p>
                        </div>
                    </a>

                    <nav class="hidden md:flex items-center gap-8">
                        <a href="#beranda"
                            class="js-nav-link text-sm font-medium text-slate-600 hover:text-[#003d7c] transition-colors">Beranda</a>
                        <a href="#tentang-kami"
                            class="js-nav-link text-sm font-medium text-slate-600 hover:text-[#003d7c] transition-colors">Tentang
                            Kami</a>
                        <a href="#visi-misi"
                            class="js-nav-link text-sm font-medium text-slate-600 hover:text-[#003d7c] transition-colors">Visi &
                            Misi</a>
                        <a href="#lowongan-kerja"
                            class="js-nav-link text-sm font-medium text-slate-600 hover:text-[#003d7c] transition-colors">Lowongan
                            Kerja</a>
                        <a href="#kontak"
                            class="js-nav-link text-sm font-medium text-slate-600 hover:text-[#003d7c] transition-colors">Kontak</a>
                        <div class="flex items-center gap-3 ml-4 border-l pl-6 border-slate-200">
                            <button
                                class="text-sm font-medium text-slate-600 hover:text-[#003d7c] transition-colors">Masuk</button>
                            <button
                                class="bg-[#003d7c] hover:bg-[#002d5c] text-white text-sm font-medium py-2.5 px-5 rounded-lg transition-colors shadow-sm">Daftar
                                Sekarang</button>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            <section id="beranda" class="relative w-full h-[600px] flex items-center">
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1762341118954-d0ce391674d2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjb3Jwb3JhdGUlMjBvZmZpY2UlMjB3b3JraW5nfGVufDF8fHx8MTc3ODQ3MTkwMXww&ixlib=rb-4.1.0&q=80&w=1080"
                        alt="Corporate Office" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-slate-900/70"></div>
                </div>

                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center md:text-left">
                    <div class="max-w-3xl">
                        <span
                            class="inline-block py-1 px-3 rounded-full bg-[#003d7c]/20 border border-[#003d7c]/40 text-blue-100 text-sm font-semibold tracking-wider mb-6 backdrop-blur-sm">
                            MITRA OUTSOURCING TERPERCAYA
                        </span>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                            Membangun Karier,<br class="hidden md:block" /> Memajukan Perusahaan
                        </h1>
                        <p class="text-lg md:text-xl text-slate-200 mb-10 max-w-2xl leading-relaxed">
                            Temukan talenta terbaik untuk perusahaan Anda atau raih kesempatan karier profesional melalui
                            portal rekrutmen terdepan kami.
                        </p>

                        <div
                            class="bg-white p-3 rounded-xl shadow-xl max-w-4xl mx-auto md:mx-0 flex flex-col md:flex-row gap-3">
                            <div class="flex-1 flex items-center bg-slate-50 border border-slate-200 rounded-lg px-4 py-3">
                                <span class="w-5 h-5 text-slate-400 mr-3 inline-flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M10.5 3.75a6.75 6.75 0 1 0 4.745 11.575l4.49 4.49a.75.75 0 0 0 1.06-1.06l-4.49-4.49A6.75 6.75 0 0 0 10.5 3.75Zm0 1.5a5.25 5.25 0 1 1 0 10.5 5.25 5.25 0 0 1 0-10.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input type="text" placeholder="Posisi pekerjaan atau keahlian..."
                                    class="bg-transparent w-full focus:outline-none text-slate-800" />
                            </div>
                            <div class="flex-1 flex items-center bg-slate-50 border border-slate-200 rounded-lg px-4 py-3">
                                <span class="w-5 h-5 text-slate-400 mr-3 inline-flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25a6.75 6.75 0 0 0-6.75 6.75c0 4.092 5.169 9.548 6.392 10.785a.75.75 0 0 0 1.116 0c1.223-1.237 6.392-6.693 6.392-10.785A6.75 6.75 0 0 0 12 2.25Zm0 1.5a5.25 5.25 0 0 1 5.25 5.25c0 2.842-3.694 6.876-5.25 8.397-1.557-1.52-5.25-5.555-5.25-8.397A5.25 5.25 0 0 1 12 3.75Zm0 3.75a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input type="text" placeholder="Lokasi kota..."
                                    class="bg-transparent w-full focus:outline-none text-slate-800" />
                            </div>
                            <button
                                class="bg-[#991b1b] hover:bg-[#7f1d1d] text-white font-medium py-3 px-8 rounded-lg transition-colors shadow-sm whitespace-nowrap">
                                Cari Lowongan
                            </button>
                        </div>

                        <div
                            class="mt-6 flex flex-wrap gap-4 items-center text-sm text-slate-300 justify-center md:justify-start">
                            <span>Pencarian populer:</span>
                            <a href="#" class="hover:text-white underline decoration-slate-500">Administrasi</a>
                            <a href="#" class="hover:text-white underline decoration-slate-500">Security</a>
                            <a href="#" class="hover:text-white underline decoration-slate-500">Driver</a>
                        </div>
                    </div>
                </div>
            </section>

            <section
                class="bg-gradient-to-r from-[#991b1b] to-[#003d7c] w-full py-8 text-white relative z-20 -mt-8 mx-auto max-w-6xl rounded-xl shadow-lg border border-white/10">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-x divide-white/20">
                    <div class="px-4">
                        <h3 class="text-3xl font-bold mb-1">15+</h3>
                        <p class="text-white/80 text-sm">Tahun Pengalaman</p>
                    </div>
                    <div class="px-4">
                        <h3 class="text-3xl font-bold mb-1">500+</h3>
                        <p class="text-white/80 text-sm">Mitra Perusahaan</p>
                    </div>
                    <div class="px-4">
                        <h3 class="text-3xl font-bold mb-1">10k+</h3>
                        <p class="text-white/80 text-sm">Pekerja Tersalurkan</p>
                    </div>
                    <div class="px-4">
                        <h3 class="text-3xl font-bold mb-1">98%</h3>
                        <p class="text-white/80 text-sm">Tingkat Retensi</p>
                    </div>
                </div>
            </section>

            <section id="tentang-kami" class="py-24 bg-white relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="flex items-center justify-center mb-20">
                        <div class="flex-grow h-[2px] bg-slate-200"></div>
                        <h2 class="px-10 text-3xl md:text-4xl font-bold text-[#003d7c] tracking-widest uppercase text-center">Tentang Kami</h2>
                        <div class="flex-grow h-[2px] bg-slate-200"></div>
                    </div>

                    <div class="grid lg:grid-cols-2 gap-16 items-start">
                        <!-- Left Side: Content -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-4">
                                <div class="w-1.5 h-10 bg-[#e31e24] rounded-full"></div>
                                <h3 class="text-2xl md:text-3xl font-bold text-slate-900">Sejarah Perjalanan Kami</h3>
                            </div>
                            
                            <div class="space-y-6 text-slate-600 leading-relaxed text-lg">
                                <p>
                                    Didirikan pada tanggal <span class="font-bold text-slate-900">25 November 1994</span>, PT. Unggul Cipta Indah (UCI) memulai langkahnya sebagai penyedia tenaga Asisten Keperawatan yang dipercaya oleh Rumah Sakit Honoris di Tangerang.
                                </p>
                                <p>
                                    Seiring dengan kepercayaan klien dan komitmen kami dalam memberikan layanan prima, UCI terus berkembang menjadi perusahaan Outsourcing dan Facility Management berskala nasional yang berfokus pada profesionalisme, moral, dan tanggung jawab kerja.
                                </p>
                            </div>
                        </div>

                        <!-- Right Side: Stats Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                            <!-- Card 1 -->
                            <div class="bg-[#003d7c] rounded-[2rem] p-10 text-center text-white shadow-2xl shadow-blue-900/20 transform transition duration-500 hover:-translate-y-2 group">
                                <div class="text-5xl font-black mb-3 tracking-tighter group-hover:scale-110 transition-transform duration-500">340+</div>
                                <div class="text-sm font-bold text-blue-200 uppercase tracking-[0.2em] opacity-80">Man Power</div>
                            </div>
                            <!-- Card 2 -->
                            <div class="bg-[#003d7c] rounded-[2rem] p-10 text-center text-white shadow-2xl shadow-blue-900/20 transform transition duration-500 hover:-translate-y-2 group">
                                <div class="text-5xl font-black mb-3 tracking-tighter group-hover:scale-110 transition-transform duration-500">30+</div>
                                <div class="text-sm font-bold text-blue-200 uppercase tracking-[0.2em] opacity-80">Tahun Pengalaman</div>
                            </div>
                            <!-- Card 3 -->
                            <div class="bg-[#003d7c] rounded-[2rem] p-10 text-center text-white shadow-2xl shadow-blue-900/20 transform transition duration-500 hover:-translate-y-2 group">
                                <div class="text-5xl font-black mb-3 tracking-tighter group-hover:scale-110 transition-transform duration-500">6 Lokasi</div>
                                <div class="text-sm font-bold text-blue-200 uppercase tracking-[0.2em] opacity-80">Mayapada Hospital</div>
                            </div>
                            <!-- Card 4 -->
                            <div class="bg-[#003d7c] rounded-[2rem] p-10 text-center text-white shadow-2xl shadow-blue-900/20 transform transition duration-500 hover:-translate-y-2 group">
                                <div class="text-5xl font-black mb-3 tracking-tighter group-hover:scale-110 transition-transform duration-500">12 Lokasi</div>
                                <div class="text-sm font-bold text-blue-200 uppercase tracking-[0.2em] opacity-80">Mitra10</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="visi-misi" class="py-24 bg-white relative overflow-hidden" style="background-image: repeating-linear-gradient(-45deg, #f1f5f9 0px, #f1f5f9 1px, transparent 1px, transparent 10px);">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-20">
                        <h2 class="text-3xl md:text-4xl font-bold text-[#003d7c] tracking-widest uppercase mb-4 text-center">Visi & Misi</h2>
                        <div class="w-20 h-1.5 bg-[#e31e24] mx-auto rounded-full"></div>
                    </div>

                    <div class="grid lg:grid-cols-12 gap-8 items-stretch">
                        <!-- Left: Visi Card (5/12) -->
                        <div class="lg:col-span-5">
                            <div class="bg-[#003d7c] rounded-[2.5rem] p-12 h-full text-white relative overflow-hidden flex flex-col justify-center shadow-2xl shadow-blue-900/30">
                                <!-- Target Pattern Background -->
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 opacity-10 pointer-events-none">
                                    <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="150" cy="150" r="145" stroke="currentColor" stroke-width="10"/>
                                        <circle cx="150" cy="150" r="105" stroke="currentColor" stroke-width="10"/>
                                        <circle cx="150" cy="150" r="65" stroke="currentColor" stroke-width="10"/>
                                        <circle cx="150" cy="150" r="25" stroke="currentColor" stroke-width="10"/>
                                    </svg>
                                </div>

                                <div class="relative z-10">
                                    <div class="w-16 h-16 bg-[#e31e24] rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-10 h-10">
                                            <path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-3xl font-bold mb-6">Visi Kami</h3>
                                    <p class="text-xl md:text-2xl font-medium leading-relaxed italic opacity-90">
                                        "Menjadi perusahaan terbaik dengan memberdayakan tenaga kerja yang profesional dan berakhlak."
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Misi Cards (7/12) -->
                        <div class="lg:col-span-7 flex flex-col gap-6">
                            <div class="grid sm:grid-cols-2 gap-6">
                                <!-- Misi 1 -->
                                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-blue-200 transition-colors">
                                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-[#003d7c]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-bold text-slate-900 mb-2">Misi 1</h4>
                                    <p class="text-slate-600 leading-relaxed text-sm">
                                        Membangun hubungan jangka panjang yang didasari pada kepercayaan dan profesionalisme.
                                    </p>
                                </div>
                                <!-- Misi 2 -->
                                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-blue-200 transition-colors">
                                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-[#003d7c]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.592c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.127c-.332.183-.582.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-bold text-slate-900 mb-2">Misi 2</h4>
                                    <p class="text-slate-600 leading-relaxed text-sm">
                                        Memberikan pelayanan yang terbaik dalam kualitas dengan responsibilitas yang tinggi.
                                    </p>
                                </div>
                            </div>
                            <!-- Misi 3 (Wide) -->
                            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-blue-200 transition-colors flex-grow">
                                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-[#003d7c]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875v-4.25m16.5 0a2.182 2.182 0 0 0-2.182-2.182h-1.5a2.182 2.182 0 0 0-2.182 2.182m5.864 0h-4.364m-3 0a2.182 2.182 0 0 0-2.182-2.182h-1.5a2.182 2.182 0 0 0-2.182 2.182m5.864 0h-4.364m-3 0a2.182 2.182 0 0 0-2.182-2.182h-1.5A2.182 2.182 0 0 0 5.625 12h-1.5c-1.035 0-1.875.84-1.875 1.875v4.5c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875v-4.5Z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 mb-2">Misi 3</h4>
                                <p class="text-slate-600 leading-relaxed text-sm">
                                    Menciptakan sistem kerja yang profesional dan berkesinambungan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="layanan" class="py-24 bg-slate-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center max-w-3xl mx-auto mb-20">
                        <h2 class="text-3xl md:text-4xl font-bold text-[#003d7c] tracking-widest uppercase mb-4 text-center">Sub Bidang Pekerjaan</h2>
                        <div class="w-16 h-1.5 bg-[#e31e24] mx-auto rounded-full mb-8"></div>
                        <p class="text-slate-500 text-lg leading-relaxed">
                            Layanan yang kami berikan berfokus pada efisiensi dan keandalan untuk mendukung operasional bisnis Anda.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Card 1: Cleaning Service -->
                        <div class="bg-white rounded-3xl p-10 shadow-xl shadow-slate-200/60 border border-slate-50 transform transition duration-500 hover:-translate-y-2 group">
                            <div class="w-14 h-14 bg-[#003d7c] rounded-2xl flex items-center justify-center mb-8 shadow-lg text-white transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Cleaning Service</h3>
                            <p class="text-slate-500 leading-relaxed">Layanan kebersihan profesional untuk berbagai jenis fasilitas.</p>
                        </div>

                        <!-- Card 2: Asisten Keperawatan -->
                        <div class="bg-white rounded-3xl p-10 shadow-xl shadow-slate-200/60 border border-slate-50 transform transition duration-500 hover:-translate-y-2 group">
                            <div class="w-14 h-14 bg-[#003d7c] rounded-2xl flex items-center justify-center mb-8 shadow-lg text-white transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Asisten Keperawatan</h3>
                            <p class="text-slate-500 leading-relaxed">Tenaga asisten medis kompeten (Ajun) untuk rumah sakit dan fasilitas kesehatan.</p>
                        </div>

                        <!-- Card 3: Runner -->
                        <div class="bg-white rounded-3xl p-10 shadow-xl shadow-slate-200/60 border border-slate-50 transform transition duration-500 hover:-translate-y-2 group">
                            <div class="w-14 h-14 bg-[#003d7c] rounded-2xl flex items-center justify-center mb-8 shadow-lg text-white transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Runner</h3>
                            <p class="text-slate-500 leading-relaxed">Tenaga operasional lapangan yang cekatan dan dapat diandalkan.</p>
                        </div>

                        <!-- Card 4: Gardener -->
                        <div class="bg-white rounded-3xl p-10 shadow-xl shadow-slate-200/60 border border-slate-50 transform transition duration-500 hover:-translate-y-2 group">
                            <div class="w-14 h-14 bg-[#003d7c] rounded-2xl flex items-center justify-center mb-8 shadow-lg text-white transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9s2.015-9 4.5-9m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-.778.099-1.533.284-2.253" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Gardener</h3>
                            <p class="text-slate-500 leading-relaxed">Perawatan taman dan lanskap untuk lingkungan yang asri dan hijau.</p>
                        </div>

                        <!-- Card 5: Driver -->
                        <div class="bg-white rounded-3xl p-10 shadow-xl shadow-slate-200/60 border border-slate-50 transform transition duration-500 hover:-translate-y-2 group">
                            <div class="w-14 h-14 bg-[#003d7c] rounded-2xl flex items-center justify-center mb-8 shadow-lg text-white transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Driver</h3>
                            <p class="text-slate-500 leading-relaxed">Layanan pengemudi profesional yang aman dan berpengalaman.</p>
                        </div>

                        <!-- Card 6: Bell Boy -->
                        <div class="bg-white rounded-3xl p-10 shadow-xl shadow-slate-200/60 border border-slate-50 transform transition duration-500 hover:-translate-y-2 group">
                            <div class="w-14 h-14 bg-[#003d7c] rounded-2xl flex items-center justify-center mb-8 shadow-lg text-white transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Bell Boy</h3>
                            <p class="text-slate-500 leading-relaxed">Pelayanan garis depan (frontline) yang ramah untuk hotel atau apartemen.</p>
                        </div>
                    </div>
                </div>
            </section>
            <style>
                @keyframes marquee {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                .animate-marquee {
                    display: flex;
                    width: max-content;
                    animation: marquee 30s linear infinite;
                }
                .animate-marquee:hover {
                    animation-play-state: paused;
                }
            </style>

            <section class="py-20 bg-white overflow-hidden border-t border-b border-slate-50">
                <div class="max-w-7xl mx-auto px-4 mb-12">
                    <div class="flex items-center gap-4">
                        <div class="h-[1px] flex-grow bg-slate-200"></div>
                        <h2 class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-[0.3em] whitespace-nowrap">Mitra Strategis & Partner Terpercaya</h2>
                        <div class="h-[1px] flex-grow bg-slate-200"></div>
                    </div>
                </div>
                
                <div class="relative">
                    <!-- Fading edges -->
                    <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-white to-transparent z-10"></div>
                    <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-white to-transparent z-10"></div>
                    
                    <div class="animate-marquee">
                        @php
                            $partners = [
                                ['name' => 'Global Persada', 'icon' => 'building'],
                                ['name' => 'Industri Maju', 'icon' => 'briefcase'],
                                ['name' => 'Mitra Abadi', 'icon' => 'shield-check'],
                                ['name' => 'Unggul Jaya', 'icon' => 'chart-up'],
                                ['name' => 'Sentra Karya', 'icon' => 'users'],
                                ['name' => 'Logistik Cepat', 'icon' => 'clock'],
                                ['name' => 'Teknologi Nusa', 'icon' => 'shield-check'],
                                ['name' => 'Karya Mandiri', 'icon' => 'building'],
                            ];
                        @endphp

                        <!-- First loop -->
                        <div class="flex items-center gap-16 md:gap-24 px-12">
                            @foreach($partners as $partner)
                            <div class="group flex items-center gap-3 opacity-30 hover:opacity-100 transition-all duration-500 cursor-default">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center group-hover:bg-blue-50 transition-colors duration-500">
                                    <x-landing.icon :name="$partner['icon']" class="w-5 h-5 text-slate-400 group-hover:text-[#003d7c] transition-colors duration-500" />
                                </div>
                                <span class="text-lg font-bold text-slate-700 group-hover:text-[#003d7c] transition-colors duration-500 whitespace-nowrap tracking-tight">{{ $partner['name'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Second loop (Seamless) -->
                        <div class="flex items-center gap-16 md:gap-24 px-12">
                            @foreach($partners as $partner)
                            <div class="group flex items-center gap-3 opacity-30 hover:opacity-100 transition-all duration-500 cursor-default">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center group-hover:bg-blue-50 transition-colors duration-500">
                                    <x-landing.icon :name="$partner['icon']" class="w-5 h-5 text-slate-400 group-hover:text-[#003d7c] transition-colors duration-500" />
                                </div>
                                <span class="text-lg font-bold text-slate-700 group-hover:text-[#003d7c] transition-colors duration-500 whitespace-nowrap tracking-tight">{{ $partner['name'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section id="konsep-kerja" class="py-24 bg-[#003d7c] relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                    <!-- Section Header -->
                    <div class="text-center mb-24">
                        <h2 class="text-3xl md:text-4xl font-bold text-white tracking-widest uppercase mb-4 text-center">Konsep Kerja Kami</h2>
                        <div class="w-16 h-1.5 bg-[#e31e24] mx-auto rounded-full"></div>
                    </div>

                    <div class="relative">
                        <!-- Connecting Line (Desktop) -->
                        <div class="hidden lg:block absolute top-12 left-[10%] right-[10%] h-0.5 border-t-2 border-dashed border-[#e31e24] z-0"></div>

                        <div class="grid lg:grid-cols-3 gap-16 lg:gap-8 relative z-10">
                            <!-- Step 1 -->
                            <div class="flex flex-col items-center group">
                                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-10 border-4 border-[#e31e24] shadow-2xl transform transition duration-500 group-hover:scale-110 group-hover:rotate-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#003d7c" class="w-10 h-10">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m.75-12H6a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 006 21h12a2.25 2.25 0 002.25-2.25V9.75M15 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 6.75h.75m-.75 3h.75m-.75 3h.75" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-6 tracking-tight flex items-center gap-3">
                                    <span class="text-2xl font-serif text-white/60 leading-none">①</span> Pekerjaan Terprogram
                                </h3>
                                <p class="text-blue-100/70 leading-relaxed text-sm md:text-base max-w-[280px] mx-auto">
                                    Pelaksanaan tugas dilakukan secara sistematis dengan laporan berkala (Harian, Mingguan, Bulanan).
                                </p>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex flex-col items-center group">
                                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-10 border-4 border-[#e31e24] shadow-2xl transform transition duration-500 group-hover:scale-110 group-hover:-rotate-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#003d7c" class="w-10 h-10">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.412 8.356 7.311 5.451 12 5.451c4.69 0 8.588 2.905 10.964 6.227a1.012 1.012 0 010 .644C20.588 15.644 16.689 18.55 12 18.55c-4.69 0-8.588-2.906-10.964-6.228z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-6 tracking-tight flex items-center gap-3">
                                    <span class="text-2xl font-serif text-white/60 leading-none">②</span> Pengawasan
                                </h3>
                                <p class="text-blue-100/70 leading-relaxed text-sm md:text-base max-w-[280px] mx-auto">
                                    Kontrol ketat melalui KPI dan briefing rutin oleh supervisor untuk menjaga standar kualitas layanan.
                                </p>
                            </div>

                            <!-- Step 3 -->
                            <div class="flex flex-col items-center group">
                                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-10 border-4 border-[#e31e24] shadow-2xl transform transition duration-500 group-hover:scale-110 group-hover:rotate-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#003d7c" class="w-10 h-10">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-6 tracking-tight flex items-center gap-3">
                                    <span class="text-2xl font-serif text-white/60 leading-none">③</span> Komplain & Evaluasi
                                </h3>
                                <p class="text-blue-100/70 leading-relaxed text-sm md:text-base max-w-[280px] mx-auto">
                                    Penanganan komplain yang responsif disertai evaluasi (Continuous Improvement) secara berkelanjutan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="lowongan-kerja" class="section-shell bg-white">
                <div
                    class="absolute top-0 right-0 w-1/3 h-full bg-slate-50/50 -skew-x-12 transform origin-top translate-x-20 z-0">
                </div>
                <div class="max-w-7xl mx-auto relative z-10">
                    <div class="flex flex-col lg:flex-row gap-20">
                        <!-- Left Column: Context & Categories -->
                        <div class="lg:w-[32%]">
                            <div class="mb-10">
                                <span class="section-kicker mb-4">Portal Lowongan</span>
                                <h2 class="section-title mb-6 leading-[1.1]">Temukan Karier <br/> <span class="text-primary-600">Impian Anda</span></h2>
                                <p class="section-copy">Jelajahi berbagai peluang karier dari perusahaan-perusahaan terkemuka yang menjadi mitra strategis kami. Mulai langkah profesional Anda hari ini.</p>
                            </div>

                            <div class="relative group">
                                <div class="absolute -inset-2 bg-gradient-to-r from-primary-600 to-blue-400 rounded-[2rem] opacity-20 blur-xl group-hover:opacity-30 transition duration-500"></div>
                                <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxqb2IlMjByZWNydWl0bWVudCUyMGludGVydmlldyUyMGhyfGVufDF8fHx8MTc3ODQ3MTkwMnww&ixlib=rb-4.1.0&q=80&w=1080"
                                    alt="Professional Recruitment" class="relative rounded-[1.8rem] shadow-2xl w-full h-64 object-cover object-center" />
                            </div>
                        </div>

                        <!-- Right Column: Job Listings -->
                        <div class="lg:w-[68%]">
                            <div class="flex items-end justify-between mb-10 pb-6 border-b border-slate-100">
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-950">Lowongan Terbaru</h3>
                                    <p class="text-slate-500 mt-1">Peluang kerja yang baru saja ditambahkan</p>
                                </div>
                                <a href="#" class="flex items-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">
                                    Lihat Semua 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="space-y-6">
                                @php
                                    $jobs = [
                                        [
                                            'title' => 'Staff Administrasi (Kontrak)',
                                            'company' => 'PT. Mitra Abadi Sejahtera',
                                            'location' => 'Jakarta Selatan',
                                            'type' => 'Full-time',
                                            'posted' => '2 hari yang lalu',
                                            'salary' => 'Rp 5.000.000 - Rp 7.000.000'
                                        ],
                                        [
                                            'title' => 'Kepala Regu Security',
                                            'company' => 'PT. Global Persada',
                                            'location' => 'Tangerang',
                                            'type' => 'Shift',
                                            'posted' => '5 jam yang lalu',
                                            'salary' => 'Rp 4.500.000 - Rp 6.000.000'
                                        ],
                                        [
                                            'title' => 'Operator Produksi',
                                            'company' => 'PT. Industri Maju Bersama',
                                            'location' => 'Cikarang',
                                            'type' => 'Full-time',
                                            'posted' => '1 hari yang lalu',
                                            'salary' => 'Rp 5.200.000 - Rp 6.500.000'
                                        ]
                                    ];
                                @endphp

                                @foreach($jobs as $job)
                                    <x-landing.job-card :job="$job" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="relative py-24 overflow-hidden">
                <!-- Background Gradient -->
                <div class="absolute inset-0 bg-gradient-to-r from-[#991b1b] via-[#7f1d1d] to-[#003d7c] z-0"></div>
                
                <!-- Decorative Shapes -->
                <div class="absolute top-0 right-0 w-1/2 h-full bg-black/10 skew-x-12 transform origin-bottom translate-x-24 z-1"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <!-- Left: Content -->
                        <div class="text-white">
                            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                                Siap Bermitra Dengan Kami?
                            </h2>
                            <p class="text-lg text-white/80 mb-10 leading-relaxed max-w-xl">
                                Tingkatkan efisiensi operasional perusahaan Anda bersama penyedia layanan terpercaya. Hubungi kami untuk konsultasi kebutuhan Anda.
                            </p>
                            
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="tel:02184312450" class="flex items-center gap-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-2xl px-6 py-4 transition-all group">
                                    <div class="w-12 h-12 bg-[#991b1b] rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                        <x-landing.icon name="phone" class="w-6 h-6 text-white" />
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs text-white/60 font-bold uppercase tracking-wider">Telepon Kantor</p>
                                        <p class="text-lg font-bold">021 - 8431 2450</p>
                                    </div>
                                </a>
                                
                                <a href="https://wa.me/6281315552926" class="flex items-center gap-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-2xl px-6 py-4 transition-all group">
                                    <div class="w-12 h-12 bg-[#22c55e] rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-white">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .018 5.393 0 12.029c0 2.119.554 4.188 1.604 6.046l-1.704 6.219 6.359-1.668a11.845 11.845 0 005.787 1.503h.005c6.634 0 12.032-5.394 12.035-12.031a11.85 11.85 0 00-3.529-8.384" />
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs text-white/60 font-bold uppercase tracking-wider">WhatsApp Business</p>
                                        <p class="text-lg font-bold">+62 813-1555-2926</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Right: Glass Card -->
                        <div class="relative">
                            <div class="absolute -inset-4 bg-primary-400/20 blur-3xl rounded-full"></div>
                            <div class="relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-[2.5rem] p-10 shadow-2xl overflow-hidden">
                                <h3 class="text-2xl font-bold text-white mb-8">Informasi Kontak</h3>
                                
                                <div class="space-y-8">
                                    <div class="flex items-start gap-5">
                                        <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center shrink-0 shadow-lg">
                                            <x-landing.icon name="pin" class="w-6 h-6 text-white" />
                                        </div>
                                        <div>
                                            <p class="text-white font-bold mb-1">Kantor Pusat</p>
                                            <p class="text-white/60 text-sm leading-relaxed">
                                                Jatisampurna, Bekasi<br/>Jawa Barat, Indonesia
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start gap-5">
                                        <div class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center shrink-0 shadow-lg">
                                            <x-landing.icon name="mail" class="w-6 h-6 text-white" />
                                        </div>
                                        <div>
                                            <p class="text-white font-bold mb-1">Email</p>
                                            <p class="text-white/60 text-sm leading-relaxed">
                                                unggulcuptaindah@gmail.com
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start gap-5">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600 flex items-center justify-center shrink-0 shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                        </div>
                                        <div>
                                            <p class="text-white font-bold mb-1">Instagram</p>
                                            <p class="text-white/60 text-sm leading-relaxed">
                                                @unggulciptaindah
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer id="kontak" class="bg-[#003d7c] text-white pt-20 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-xl">
                                <span class="text-blue-800 font-black text-2xl">UI</span>
                            </div>
                            <div class="font-bold text-xl tracking-tight leading-tight">
                                PT. Unggul Cipta<br/>Indah
                            </div>
                        </div>
                        <p class="text-blue-100/60 text-sm leading-relaxed max-w-sm font-medium">
                            Penyedia layanan outsourcing & facility management profesional, berakhlak, dan bertanggung jawab sejak 1994.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-white font-bold mb-8 uppercase tracking-widest text-sm">Perusahaan</h3>
                        <ul class="space-y-4">
                            <li><a href="#beranda" class="text-blue-100/60 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 group"><span class="text-red-500 group-hover:translate-x-1 transition-transform">›</span> Beranda</a></li>
                            <li><a href="#tentang-kami" class="text-blue-100/60 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 group"><span class="text-red-500 group-hover:translate-x-1 transition-transform">›</span> Tentang Kami</a></li>
                            <li><a href="#visi-misi" class="text-blue-100/60 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 group"><span class="text-red-500 group-hover:translate-x-1 transition-transform">›</span> Visi & Misi</a></li>
                            <li><a href="#lowongan-kerja" class="text-blue-100/60 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 group"><span class="text-red-500 group-hover:translate-x-1 transition-transform">›</span> Lowongan Kerja</a></li>
                            <li><a href="#kontak" class="text-blue-100/60 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 group"><span class="text-red-500 group-hover:translate-x-1 transition-transform">›</span> Kontak</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-white font-bold mb-8 uppercase tracking-widest text-sm">Layanan Kami</h3>
                        <ul class="space-y-4">
                            <li class="text-blue-100/60 text-sm font-medium flex items-center gap-2"><span class="text-red-500">›</span> Cleaning Service</li>
                            <li class="text-blue-100/60 text-sm font-medium flex items-center gap-2"><span class="text-red-500">›</span> Asisten Keperawatan</li>
                            <li class="text-blue-100/60 text-sm font-medium flex items-center gap-2"><span class="text-red-500">›</span> Runner & Gardener</li>
                            <li class="text-blue-100/60 text-sm font-medium flex items-center gap-2"><span class="text-red-500">›</span> Driver & Bell Boy</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-white font-bold mb-8 uppercase tracking-widest text-sm">Hubungi Kami</h3>
                        <ul class="space-y-5">
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                    <x-landing.icon name="pin" class="w-4 h-4 text-red-500" />
                                </div>
                                <p class="text-blue-100/60 text-[13px] font-medium leading-relaxed">
                                    Jatisampurna, Bekasi<br/>Jawa Barat, Indonesia
                                </p>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                    <x-landing.icon name="phone" class="w-4 h-4 text-red-500" />
                                </div>
                                <a href="tel:02184312450" class="text-blue-100/60 hover:text-white transition-colors text-[13px] font-medium">021-8431 2450</a>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                    <x-landing.icon name="mail" class="w-4 h-4 text-red-500" />
                                </div>
                                <a href="mailto:unggulcuptaindah@gmail.com" class="text-blue-100/60 hover:text-white transition-colors text-[13px] font-medium">unggulcuptaindah@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="pt-8 border-t border-white/10 text-blue-100/40 text-xs flex flex-col md:flex-row justify-between items-center gap-4">
                    <p>&copy; {{ date('Y') }} PT. Unggul Cipta Indah. Hak Cipta Dilindungi.</p>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection