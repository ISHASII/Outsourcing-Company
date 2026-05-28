@props(['postings'])

<section id="lowongan-kerja" class="section-shell bg-white">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-slate-50/50 -skew-x-12 transform origin-top translate-x-20 z-0">
    </div>
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="flex flex-col lg:flex-row gap-20">
            <!-- Left Column: Context & Categories -->
            <div class="lg:w-[32%]">
                <div class="mb-10">
                    <span class="section-kicker mb-4">Portal Lowongan</span>
                    <h2 class="section-title mb-6 leading-[1.1]">Temukan Karier <br /> <span
                            class="text-primary-600">Impian Anda</span></h2>
                    <p class="section-copy">Jelajahi berbagai peluang karier dari perusahaan-perusahaan terkemuka yang
                        menjadi mitra strategis kami. Mulai langkah profesional Anda hari ini.</p>
                </div>

                <div class="relative group">
                    <div
                        class="absolute -inset-2 bg-gradient-to-r from-primary-600 to-blue-400 rounded-[2rem] opacity-20 blur-xl group-hover:opacity-30 transition duration-500">
                    </div>
                    <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxqb2IlMjByZWNydWl0bWVudCUyMGludGVydmlldyUyMGhyfGVufDF8fHx8MTc3ODQ3MTkwMnww&ixlib=rb-4.1.0&q=80&w=1080"
                        alt="Professional Recruitment"
                        class="relative rounded-[1.8rem] shadow-2xl w-full h-64 object-cover object-center" />
                </div>
            </div>

            <!-- Right Column: Job Listings -->
            <div class="lg:w-[68%]">
                <div class="flex items-end justify-between mb-10 pb-6 border-b border-slate-100">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-950">Lowongan Terbaru</h3>
                        <p class="text-slate-500 mt-1">Peluang kerja yang baru saja ditambahkan</p>
                    </div>
                    <a href="{{ route('pelamar.lowongan') }}"
                        class="flex items-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">
                        Lihat Semua
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="space-y-6">
                    @forelse(($postings ?? collect()) as $posting)
                        @php
                            $location = $posting->second_requires_placement_ready
                                ? 'Siap ditempatkan sesuai penempatan'
                                : ($posting->location_city ?: '-');
                            $shift = $posting->shift_type === 'shift' ? 'Shift' : ($posting->shift_type === 'non_shift' ? 'Non Shift' : null);
                            $salary = null;
                            if (!$posting->salary_hidden && $posting->salary_min && $posting->salary_max) {
                                $salary = 'Rp ' . number_format($posting->salary_min, 0, ',', '.') . ' - Rp ' . number_format($posting->salary_max, 0, ',', '.');
                            }
                            $applyUrl = auth()->check() && auth()->user()->role === 'pelamar'
                                ? route('pelamar.lowongan.apply', $posting)
                                : route('login');
                            $job = [
                                'title' => $posting->title,
                                'company' => 'PT. Unggul Cipta Indah',
                                'location' => $location,
                                'type' => $shift,
                                'posted' => $posting->created_at?->diffForHumans(),
                                'salary' => $salary,
                                'apply_url' => $applyUrl,
                            ];
                        @endphp
                        <x-landing.job-card :job="$job" />
                    @empty
                        <div
                            class="rounded-2xl border border-dashed border-slate-200 p-6 text-sm text-slate-500 text-center">
                            Belum ada lowongan aktif.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
