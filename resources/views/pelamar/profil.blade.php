@extends('layouts.dashboard')

@section('dashboard-title', 'Pengaturan Profil')

@section('dashboard-content')
@php
    $profile = Auth::user()->profile;
    $citizenship = $profile->extras['citizenship'] ?? 'WNI';
    $hasExp = ($profile->experience_years ?? 0) > 0 || !empty($profile->extras['experiences'] ?? []) ? 'IYA' : 'TIDAK';
    $experiences = $profile->extras['experiences'] ?? [];
@endphp
<div class="space-y-6 animate-fade-in" x-data="{ 
    kewarganegaraan: '{{ $citizenship }}',
    punyaPengalaman: '{{ $hasExp }}',
    pengalamanList: [
        @if(count($experiences) > 0)
            @foreach($experiences as $exp)
                { 
                    id: {{ $loop->iteration }}, 
                    company: '{{ addslashes($exp['company'] ?? '') }}', 
                    position: '{{ addslashes($exp['position'] ?? '') }}', 
                    start_date: '{{ $exp['start_date'] ?? '' }}', 
                    end_date: '{{ $exp['end_date'] ?? '' }}', 
                    description: '{{ addslashes(str_replace(["\r", "\n"], ' ', $exp['description'] ?? '')) }}' 
                },
            @endforeach
        @else
            { id: Date.now(), company: '', position: '', start_date: '', end_date: '', description: '' }
        @endif
    ]
}">

    <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-bl-full -z-10 opacity-50"></div>
        
        <div class="mb-8">
            <h3 class="text-2xl font-extrabold text-[#003d7c]">Data Pribadi Pelamar / Applicant Personal Data</h3>
            <p class="text-sm text-slate-500 mt-1">Lengkapi dan perbarui data diri Anda sesuai dengan identitas resmi. / Complete and update your personal data according to your official identity.</p>
        </div>

        <form action="{{ route('pelamar.profil.update') }}" method="POST" id="form-profil-pelamar" enctype="multipart/form-data" class="space-y-8" @submit.prevent="$dispatch('open-confirm-modal', {
            title: 'Simpan Perubahan Profil?',
            message: 'Apakah Anda yakin ingin memperbarui data profil Anda? Pastikan semua informasi sudah benar dan sesuai identitas.',
            confirmText: 'Ya, Simpan',
            type: 'info',
            actionType: 'submit',
            formElement: document.getElementById('form-profil-pelamar')
        })">
            @csrf
            
            <!-- Section 1: Nama & Kontak -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-200 pb-2">Informasi Dasar / Basic Information</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Depan / First Name *</label>
                        <input type="text" name="nama_depan" value="{{ explode(' ', Auth::user()->name)[0] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Belakang / Last Name</label>
                        <input type="text" name="nama_belakang" value="{{ explode(' ', Auth::user()->name)[1] ?? '' }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full bg-slate-100 border border-slate-200 text-slate-500 text-sm rounded-xl focus:ring-transparent focus:border-slate-200 block p-3 cursor-not-allowed" readonly title="Email tidak dapat diubah">
                        <p class="text-[10px] text-slate-400 mt-1">Email digunakan sebagai identitas login utama. / Email is used as the main login identity.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nomor HP / WhatsApp Number *</label>
                        <input type="text" name="no_hp" value="{{ $profile->phone ?? '' }}" placeholder="Contoh: 08123456789" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                    </div>
                </div>
            </div>

            <!-- Section 2: Kelahiran & Domisili -->
            <div class="space-y-4 pt-4">
                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-200 pb-2">Kelahiran & Domisili / Birth & Domicile</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Lahir / Place of Birth *</label>
                        <input type="text" name="tempat_lahir" value="{{ $profile->birth_place ?? '' }}" placeholder="Kota Kelahiran" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir / Date of Birth *</label>
                        <!-- Menggunakan onClick="this.showPicker()" agar langsung keluar kalender saat diklik di manapun pada input -->
                        <input type="date" name="tanggal_lahir" value="{{ $profile?->birth_date?->format('Y-m-d') ?? '' }}" onclick="this.showPicker()" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors cursor-pointer" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin / Gender *</label>
                        <select name="jenis_kelamin" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                            <option value="">Pilih Jenis Kelamin... / Select Gender...</option>
                            <option value="Pria" {{ ($profile->gender ?? '') === 'male' ? 'selected' : '' }}>Pria (Male)</option>
                            <option value="Wanita" {{ ($profile->gender ?? '') === 'female' ? 'selected' : '' }}>Wanita (Female)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Pendidikan Terakhir / Last Education *</label>
                        <select name="pendidikan" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                            <option value="">Pilih Pendidikan... / Select Education...</option>
                            <option value="SMA/SMK" {{ ($profile->education_level ?? '') === 'SMA/SMK' ? 'selected' : '' }}>SMA / SMK Sederajat</option>
                            <option value="D3" {{ ($profile->education_level ?? '') === 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                            <option value="S1" {{ ($profile->education_level ?? '') === 'S1' ? 'selected' : '' }}>Strata 1 (S1) / D4</option>
                            <option value="S2" {{ ($profile->education_level ?? '') === 'S2' ? 'selected' : '' }}>Strata 2 (S2)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Domisili Lengkap / Complete Domicile Address *</label>
                    <textarea name="alamat" rows="3" placeholder="Masukkan alamat tempat tinggal Anda saat ini..." class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>{{ $profile->address ?? '' }}</textarea>
                </div>
            </div>

            <!-- Section 3: Kewarganegaraan & Identitas -->
            <div class="space-y-4 pt-4 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-200 pb-2">Status Kewarganegaraan / Citizenship Status</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kewarganegaraan (Nationality) *</label>
                        <select x-model="kewarganegaraan" name="status_kewarganegaraan" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                            <option value="WNI" {{ $citizenship === 'WNI' ? 'selected' : '' }}>WNI (Warga Negara Indonesia)</option>
                            <option value="WNA" {{ $citizenship === 'WNA' ? 'selected' : '' }}>WNA (Warga Negara Asing / Foreigner)</option>
                        </select>
                    </div>
                    
                    <!-- Dinamis: NIK atau Passport -->
                    <div x-show="kewarganegaraan === 'WNI'" x-transition>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nomor NIK / National ID Number *</label>
                        <input type="text" name="nik" value="{{ $profile->extras['nik'] ?? '' }}" placeholder="16 Digit NIK KTP" maxlength="16" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>

                    <div x-show="kewarganegaraan === 'WNA'" x-transition style="display: none;">
                        <label class="block text-sm font-bold text-slate-700 mb-2">No. Passport *</label>
                        <input type="text" name="passport" value="{{ $profile->extras['paspor'] ?? '' }}" placeholder="Nomor Passport" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>
                </div>

                <!-- Tambahan Form jika WNA -->
                <div x-show="kewarganegaraan === 'WNA'" x-transition style="display: none;" class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-slate-200/60 mt-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Asal Negara / Country *</label>
                        <input type="text" name="negara_asal" value="{{ $profile->extras['asal_negara'] ?? '' }}" placeholder="Origin Country" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Provinsi / Province *</label>
                        <input type="text" name="provinsi_wna" value="{{ $profile->province ?? '' }}" placeholder="Province / State" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kota / City *</label>
                        <input type="text" name="kota_wna" value="{{ $profile->city ?? '' }}" placeholder="City" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>
                </div>
            </div>

            <!-- Section 4: Pengalaman Kerja -->
            <div class="space-y-4 pt-4">
                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-200 pb-2">Pengalaman Kerja / Work Experience</h4>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Apakah Anda Memiliki Pengalaman Kerja? / Do you have work experience? *</label>
                    <select x-model="punyaPengalaman" name="punya_pengalaman" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                        <option value="TIDAK">TIDAK (Belum Berpengalaman / No work experience)</option>
                        <option value="IYA">Saya memiliki pengalaman kerja / I have work experience</option>
                    </select>
                </div>

                <!-- Dinamis: Detail Pengalaman Kerja Multiple -->
                <div x-show="punyaPengalaman === 'IYA'" x-transition style="display: none;" class="space-y-6 pt-4 border-t border-slate-200/60 mt-4">
                    
                    <template x-for="(item, index) in pengalamanList" :key="item.id">
                        <div class="bg-slate-50/70 border border-slate-200 rounded-2xl p-6 relative group">
                            <!-- Hapus Tombol (Hanya muncul jika lebih dari 1) -->
                            <button type="button" @click="pengalamanList.splice(index, 1)" x-show="pengalamanList.length > 1" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 transition-colors" title="Hapus Pengalaman">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            
                            <h5 class="text-[#003d7c] font-extrabold mb-4 flex items-center gap-2">
                                <span class="bg-blue-100 text-[#003d7c] w-6 h-6 rounded-full flex items-center justify-center text-xs" x-text="index + 1"></span>
                                Pengalaman Kerja
                            </h5>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Pekerjaan / Job Title *</label>
                                    <input type="text" :name="'pengalaman['+index+'][posisi_pekerjaan]'" x-model="item.position" placeholder="Contoh / Example: Staff Administrasi" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" :required="punyaPengalaman === 'IYA'">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Perusahaan / Company Name *</label>
                                    <input type="text" :name="'pengalaman['+index+'][nama_perusahaan]'" x-model="item.company" placeholder="Nama Tempat Bekerja / Workplace Name" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" :required="punyaPengalaman === 'IYA'">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Mulai / Start Date *</label>
                                    <input type="month" :name="'pengalaman['+index+'][tanggal_mulai]'" x-model="item.start_date" onclick="this.showPicker()" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors cursor-pointer" :required="punyaPengalaman === 'IYA'">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Selesai / End Date *</label>
                                    <input type="month" :name="'pengalaman['+index+'][tanggal_selesai]'" x-model="item.end_date" onclick="this.showPicker()" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors cursor-pointer" :required="punyaPengalaman === 'IYA'">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Pekerjaan / Job Description *</label>
                                <textarea :name="'pengalaman['+index+'][deskripsi_pekerjaan]'" x-model="item.description" rows="3" placeholder="Gambarkan secara singkat tugas dan tanggung jawab Anda..." class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" :required="punyaPengalaman === 'IYA'"></textarea>
                            </div>
                        </div>
                    </template>

                    <!-- Tombol Tambah Pengalaman -->
                    <button type="button" @click="pengalamanList.push({ id: Date.now(), company: '', position: '', start_date: '', end_date: '', description: '' })" class="w-full py-4 border-2 border-dashed border-blue-200 text-blue-600 hover:bg-blue-50 hover:border-blue-400 rounded-2xl font-bold transition-all flex items-center justify-center gap-2 group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Pengalaman Kerja Lainnya
                    </button>
                    
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 flex justify-end gap-3 border-t border-slate-200">
                <button type="reset" class="px-6 py-3 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</button>
                <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-[#003d7c] hover:bg-blue-800 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
