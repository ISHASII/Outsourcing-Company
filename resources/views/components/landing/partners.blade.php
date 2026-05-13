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