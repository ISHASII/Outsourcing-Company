@extends('layouts.dashboard')

@section('dashboard-title', 'Buat Lowongan')

@section('dashboard-content')
    <div class="space-y-6 animate-fade-in">
        <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden">
            <!-- Decorative gradient banner top -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600"></div>

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight">Buat Lowongan Baru</h3>
                    <p class="text-xs text-slate-500 mt-1">Konfigurasikan detail lowongan dan kriteria SPK (Core vs Secondary Factor).</p>
                </div>
                <a href="{{ route('hrd.hiring') }}"
                    class="text-xs font-bold text-slate-500 hover:text-slate-800 bg-slate-50 hover:bg-slate-100 px-4 py-2 rounded-xl transition-all border border-slate-100">
                    Kembali
                </a>
            </div>

            <form action="{{ route('hrd.hiring.store') }}" method="POST" class="space-y-8" x-data="{
                genderStatus: '{{ old('req_gender_status', 'core') }}',
                ageStatus: '{{ old('req_age_status', 'core') }}',
                educationStatus: '{{ old('req_education_status', 'core') }}',
                agdStatus: '{{ old('req_agd_status', 'secondary') }}',
                simcStatus: '{{ old('req_sim_c_status', 'secondary') }}',
                simb1Status: '{{ old('req_sim_b1_status', 'secondary') }}',
                experienceStatus: '{{ old('req_experience_status', 'secondary') }}',
                placementStatus: '{{ old('req_placement_ready_status', 'core') }}',
                salaryHidden: {{ old('salary_hidden') ? 'true' : 'false' }}
            }">
                @csrf
                
                <!-- Section 1: Informasi Dasar -->
                <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100 space-y-4">
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider border-b border-slate-200/55 pb-2">Informasi Dasar Lowongan</h4>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-600">Judul Lowongan</label>
                            <input type="text" name="title" value="{{ old('title', 'Driver Ambulance') }}"
                                class="w-full mt-2 px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm transition-all" required>
                            @error('title')<p class="text-xs text-rose-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-600">Kategori Pekerjaan</label>
                            <select name="category" id="category-select"
                                class="w-full mt-2 px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 text-sm transition-all" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" @selected(old('category', 'Driver Ambulance') === $category)>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')<p class="text-xs text-rose-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-600">Deskripsi Lowongan (Opsional)</label>
                        <textarea name="description" rows="3"
                            class="w-full mt-2 px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 text-sm transition-all">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Section 2: Kriteria Persyaratan SPK (Dinamis) -->
                <div>
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4">Pengaturan Kriteria Kualifikasi (SPK)</h4>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        
                        <!-- Kriteria 1: Gender -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between transition-all" :class="genderStatus === 'nonaktif' ? 'opacity-60 bg-slate-50/20' : ''">
                            <div>
                                <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-extrabold text-slate-700 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Kriteria Gender
                                    </span>
                                    <select name="req_gender_status" x-model="genderStatus" class="text-xs font-bold px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 focus:outline-none">
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="core">Wajib (Core)</option>
                                        <option value="secondary">Nilai Tambah (Secondary)</option>
                                    </select>
                                </div>
                                <p class="text-[11px] text-slate-400">Batasi lowongan berdasarkan jenis kelamin pelamar.</p>
                            </div>
                            
                            <div class="mt-4" x-show="genderStatus !== 'nonaktif'" x-transition>
                                <label class="text-[11px] font-bold text-slate-500">Jenis Kelamin yang Dicari</label>
                                <select name="req_gender_value" class="w-full mt-1.5 px-3 py-2 rounded-lg border border-slate-200 text-xs">
                                    <option value="male" @selected(old('req_gender_value') === 'male')>Pria saja</option>
                                    <option value="female" @selected(old('req_gender_value') === 'female')>Wanita saja</option>
                                    <option value="both" @selected(old('req_gender_value') === 'both')>Pria dan Wanita</option>
                                </select>
                            </div>
                        </div>

                        <!-- Kriteria 2: Usia -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between transition-all" :class="ageStatus === 'nonaktif' ? 'opacity-60 bg-slate-50/20' : ''">
                            <div>
                                <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-extrabold text-slate-700 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Batasan Usia
                                    </span>
                                    <select name="req_age_status" x-model="ageStatus" class="text-xs font-bold px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 focus:outline-none">
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="core">Wajib (Core)</option>
                                        <option value="secondary">Nilai Tambah (Secondary)</option>
                                    </select>
                                </div>
                                <p class="text-[11px] text-slate-400">Tentukan rentang usia pelamar yang ideal untuk posisi ini.</p>
                            </div>
                            
                            <div class="mt-4 grid grid-cols-2 gap-3" x-show="ageStatus !== 'nonaktif'" x-transition>
                                <div>
                                    <label class="text-[11px] font-bold text-slate-500">Usia Minimum</label>
                                    <input type="number" name="req_age_min" value="{{ old('req_age_min', 25) }}" min="18" max="60" class="w-full mt-1.5 px-3 py-2 rounded-lg border border-slate-200 text-xs">
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-slate-500">Usia Maksimum</label>
                                    <input type="number" name="req_age_max" value="{{ old('req_age_max', 35) }}" min="18" max="65" class="w-full mt-1.5 px-3 py-2 rounded-lg border border-slate-200 text-xs">
                                </div>
                            </div>
                        </div>

                        <!-- Kriteria 3: Pendidikan -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between transition-all" :class="educationStatus === 'nonaktif' ? 'opacity-60 bg-slate-50/20' : ''">
                            <div>
                                <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-extrabold text-slate-700 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Pendidikan Minimal
                                    </span>
                                    <select name="req_education_status" x-model="educationStatus" class="text-xs font-bold px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 focus:outline-none">
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="core">Wajib (Core)</option>
                                        <option value="secondary">Nilai Tambah (Secondary)</option>
                                    </select>
                                </div>
                                <p class="text-[11px] text-slate-400">Pendidikan minimal yang harus dipunyai oleh kandidat pelamar.</p>
                            </div>
                            
                            <div class="mt-4" x-show="educationStatus !== 'nonaktif'" x-transition>
                                <label class="text-[11px] font-bold text-slate-500">Pendidikan Minimal</label>
                                <select name="req_education_value" class="w-full mt-1.5 px-3 py-2 rounded-lg border border-slate-200 text-xs">
                                    @foreach($educationLevels as $level)
                                        <option value="{{ $level }}" @selected(old('req_education_value', 'SMA/SMK') === $level)>{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Kriteria 4: Sertifikat AGD -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between transition-all" :class="agdStatus === 'nonaktif' ? 'opacity-60 bg-slate-50/20' : ''">
                            <div>
                                <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-extrabold text-slate-700 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Sertifikat AGD (Ambulance)
                                    </span>
                                    <select name="req_agd_status" x-model="agdStatus" class="text-xs font-bold px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 focus:outline-none">
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="core">Wajib (Core)</option>
                                        <option value="secondary">Nilai Tambah (Secondary)</option>
                                    </select>
                                </div>
                                <p class="text-[11px] text-slate-400">Pelamar wajib memiliki sertifikasi Ambulance Gawat Darurat (AGD) yang masih aktif.</p>
                            </div>
                            <div class="mt-4" x-show="agdStatus !== 'nonaktif'" x-transition>
                                <p class="text-[11px] text-blue-600 bg-blue-50/80 px-3 py-2 rounded-lg font-semibold flex items-center gap-2">
                                    <svg class="text-blue-600 shrink-0" style="width: 20px; height: 20px; min-width: 20px; min-height: 20px;" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Upload sertifikat AGD wajib diisi di form pendaftaran pelamar.
                                </p>
                            </div>
                        </div>

                        <!-- Kriteria 5: SIM C -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between transition-all" :class="simcStatus === 'nonaktif' ? 'opacity-60 bg-slate-50/20' : ''">
                            <div>
                                <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-extrabold text-slate-700 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Lisensi SIM C
                                    </span>
                                    <select name="req_sim_c_status" x-model="simcStatus" class="text-xs font-bold px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 focus:outline-none">
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="core">Wajib (Core)</option>
                                        <option value="secondary">Nilai Tambah (Secondary)</option>
                                    </select>
                                </div>
                                <p class="text-[11px] text-slate-400">Kandidat wajib menyertakan foto Surat Izin Mengemudi motor (SIM C) yang aktif.</p>
                            </div>
                            <div class="mt-4" x-show="simcStatus !== 'nonaktif'" x-transition>
                                <p class="text-[11px] text-blue-600 bg-blue-50/80 px-3 py-2 rounded-lg font-semibold flex items-center gap-2">
                                    <svg class="text-blue-600 shrink-0" style="width: 20px; height: 20px; min-width: 20px; min-height: 20px;" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Upload berkas foto SIM C wajib diisi di form lamaran pelamar.
                                </p>
                            </div>
                        </div>

                        <!-- Kriteria 6: SIM B1 -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between transition-all" :class="simb1Status === 'nonaktif' ? 'opacity-60 bg-slate-50/20' : ''">
                            <div>
                                <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-extrabold text-slate-700 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Lisensi SIM B1
                                    </span>
                                    <select name="req_sim_b1_status" x-model="simb1Status" class="text-xs font-bold px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 focus:outline-none">
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="core">Wajib (Core)</option>
                                        <option value="secondary">Nilai Tambah (Secondary)</option>
                                    </select>
                                </div>
                                <p class="text-[11px] text-slate-400">Kandidat wajib menyertakan foto Surat Izin Mengemudi mobil berat (SIM B1) yang aktif.</p>
                            </div>
                            <div class="mt-4" x-show="simb1Status !== 'nonaktif'" x-transition>
                                <p class="text-[11px] text-blue-600 bg-blue-50/80 px-3 py-2 rounded-lg font-semibold flex items-center gap-2">
                                    <svg class="text-blue-600 shrink-0" style="width: 20px; height: 20px; min-width: 20px; min-height: 20px;" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Upload berkas foto SIM B1 wajib diisi di form lamaran pelamar.
                                </p>
                            </div>
                        </div>

                        <!-- Kriteria 7: Pengalaman -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between transition-all" :class="experienceStatus === 'nonaktif' ? 'opacity-60 bg-slate-50/20' : ''">
                            <div>
                                <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-extrabold text-slate-700 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Minimal Pengalaman Kerja
                                    </span>
                                    <select name="req_experience_status" x-model="experienceStatus" class="text-xs font-bold px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 focus:outline-none">
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="core">Wajib (Core)</option>
                                        <option value="secondary">Nilai Tambah (Secondary)</option>
                                    </select>
                                </div>
                                <p class="text-[11px] text-slate-400">Tentukan durasi kerja minimum (tahun) yang harus dikantongi pelamar.</p>
                            </div>
                            
                            <div class="mt-4" x-show="experienceStatus !== 'nonaktif'" x-transition>
                                <label class="text-[11px] font-bold text-slate-500">Pengalaman Minimum (Tahun)</label>
                                <input type="number" name="req_experience_value" value="{{ old('req_experience_value', 0) }}" min="0" max="50" class="w-full mt-1.5 px-3 py-2 rounded-lg border border-slate-200 text-xs">
                            </div>
                        </div>

                        <!-- Kriteria 8: Penempatan -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between transition-all" :class="placementStatus === 'nonaktif' ? 'opacity-60 bg-slate-50/20' : ''">
                            <div>
                                <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-extrabold text-slate-700 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Kesiapan Penempatan
                                    </span>
                                    <select name="req_placement_ready_status" x-model="placementStatus" class="text-xs font-bold px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 focus:outline-none">
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="core">Wajib (Core)</option>
                                        <option value="secondary">Nilai Tambah (Secondary)</option>
                                    </select>
                                </div>
                                <p class="text-[11px] text-slate-400">Kandidat harus siap ditempatkan di mana saja di area kerja UCI.</p>
                            </div>
                            <div class="mt-4" x-show="placementStatus !== 'nonaktif'" x-transition>
                                <p class="text-[11px] text-blue-600 bg-blue-50/80 px-3 py-2 rounded-lg font-semibold flex items-center gap-2">
                                    <svg class="text-blue-600 shrink-0" style="width: 20px; height: 20px; min-width: 20px; min-height: 20px;" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Menuntut pelamar siap ditempatkan sesuai arahan operasional.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Section 3: Informasi Pendukung (Lokasi, Shift, Gaji) -->
                <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100 space-y-5">
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider border-b border-slate-200/55 pb-2">Informasi Operasional & Finansial</h4>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Batas Waktu & Lokasi -->
                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-bold text-slate-600">Lowongan Aktif Sampai</label>
                                <input type="date" name="active_until" value="{{ old('active_until') }}"
                                    class="w-full mt-2 px-4 py-2 rounded-xl border border-slate-200 text-sm">
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-600">Lokasi Penempatan Kerja</label>
                                <div class="grid grid-cols-2 gap-3 mt-2">
                                    <select id="location-province" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                    <select id="location-city" name="location_city"
                                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-2" id="location-helper">Biarkan kosong jika bebas ditempatkan di mana saja.</p>
                            </div>
                        </div>

                        <!-- Shift & Finansial -->
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs font-bold text-slate-600">Jenis Shift</label>
                                    <select name="shift_type" class="w-full mt-2 px-3 py-2 rounded-xl border border-slate-200 text-sm">
                                        <option value="none" @selected(old('shift_type', 'none') === 'none')>Tidak ada</option>
                                        <option value="shift" @selected(old('shift_type') === 'shift')>Menggunakan Shift</option>
                                        <option value="non_shift" @selected(old('shift_type') === 'non_shift')>Non-Shift (Reguler)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-600">Visibilitas Gaji</label>
                                    <label class="mt-3.5 flex items-center gap-2 text-xs text-slate-600 cursor-pointer">
                                        <input type="checkbox" name="salary_hidden" value="1" class="rounded border-slate-300"
                                            x-model="salaryHidden">
                                        Sembunyikan Rentang Gaji
                                    </label>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 transition-all" :class="salaryHidden ? 'opacity-40 pointer-events-none' : ''">
                                <div>
                                    <label class="text-xs font-bold text-slate-600">Gaji Minimum (Rupiah)</label>
                                    <input type="number" name="salary_min" min="0" value="{{ old('salary_min') }}"
                                        ::disabled="salaryHidden"
                                        class="w-full mt-2 px-3 py-2.5 rounded-xl border border-slate-200 text-sm placeholder-slate-350"
                                        placeholder="Contoh: 4000000">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-600">Gaji Maksimum (Rupiah)</label>
                                    <input type="number" name="salary_max" min="0" value="{{ old('salary_max') }}"
                                        ::disabled="salaryHidden"
                                        class="w-full mt-2 px-3 py-2.5 rounded-xl border border-slate-200 text-sm placeholder-slate-350"
                                        placeholder="Contoh: 6000000">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="is_active" value="1">
                </div>

                <div class="flex justify-end gap-3 border-t border-slate-100 pt-6">
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-gradient-to-r from-[#003d7c] to-[#005fb8] text-white text-sm font-bold shadow-md hover:shadow-lg hover:brightness-105 active:scale-95 transition-all">
                        Simpan Lowongan Kerja
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const locationCity = document.getElementById('location-city');
            const locationProvince = document.getElementById('location-province');

            if (locationProvince && locationCity) {
                fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                    .then((response) => response.json())
                    .then((provinces) => {
                        provinces.forEach((province) => {
                            const option = document.createElement('option');
                            option.value = province.id;
                            option.textContent = province.name;
                            locationProvince.appendChild(option);
                        });
                    });

                locationProvince.addEventListener('change', function () {
                    const provinceId = this.value;
                    locationCity.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    if (!provinceId) return;

                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                        .then((response) => response.json())
                        .then((cities) => {
                            cities.forEach((city) => {
                                const option = document.createElement('option');
                                option.value = city.name;
                                option.textContent = city.name;
                                locationCity.appendChild(option);
                            });
                        });
                });
            }
        });
    </script>
@endsection
