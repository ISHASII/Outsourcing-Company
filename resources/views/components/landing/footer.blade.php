@props(['brand', 'footer'])

<footer id="kontak" class="border-t border-primary-500/40 bg-slate-950 text-white">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.1fr_0.8fr_0.9fr_1fr]">
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <span
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-primary-600 shadow-[0_18px_32px_rgba(255,255,255,0.08)]">
                        <x-landing.icon name="briefcase" class="h-6 w-6" />
                    </span>
                    <div>
                        <div class="text-xl font-extrabold tracking-tight">{{ $brand['name'] }}</div>
                        <div class="text-[11px] font-semibold uppercase tracking-[0.24em] text-primary-300">
                            {{ $brand['tagline'] }}</div>
                    </div>
                </div>
                <p class="max-w-sm text-sm leading-7 text-slate-300">{{ $footer['description'] }}</p>
            </div>

            <div>
                <h3 class="text-xl font-bold">Perusahaan</h3>
                <ul class="mt-6 space-y-4 text-sm text-slate-300">
                    @foreach ($footer['links'] as $link)
                        <li><a href="{{ $link['href'] }}"
                                class="transition-colors duration-200 hover:text-white">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-bold">Layanan Kami</h3>
                <ul class="mt-6 space-y-4 text-sm text-slate-300">
                    @foreach ($footer['services'] as $service)
                        <li><a href="{{ $service['href'] }}"
                                class="transition-colors duration-200 hover:text-white">{{ $service['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-bold">Hubungi Kami</h3>
                <div class="mt-6 space-y-5 text-sm text-slate-300">
                    <div class="flex gap-3">
                        <x-landing.icon name="pin" class="mt-1 h-5 w-5 shrink-0 text-primary-400" />
                        <p class="leading-7">{{ $footer['contact']['address'] }}</p>
                    </div>
                    <div class="flex gap-3">
                        <x-landing.icon name="phone" class="mt-1 h-5 w-5 shrink-0 text-primary-400" />
                        <p>{{ $footer['contact']['phone'] }}</p>
                    </div>
                    <div class="flex gap-3">
                        <x-landing.icon name="mail" class="mt-1 h-5 w-5 shrink-0 text-primary-400" />
                        <p>{{ $footer['contact']['email'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>