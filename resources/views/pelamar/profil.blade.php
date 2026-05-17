@extends('layouts.dashboard')

@section('dashboard-title', 'Pengaturan Profil')

@section('dashboard-content')
<div class="space-y-6 animate-fade-in" x-data="{ 
    kewarganegaraan: 'WNI',
    punyaPengalaman: 'TIDAK',
    pengalamanList: [{ id: Date.now() }]
}">

    <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-bl-full -z-10 opacity-50"></div>
        
        <div class="mb-8">
            <h3 class="text-2xl font-extrabold text-[#003d7c]">Data Pribadi Pelamar / Applicant Personal Data</h3>
            <p class="text-sm text-slate-500 mt-1">Lengkapi dan perbarui data diri Anda sesuai dengan identitas resmi. / Complete and update your personal data according to your official identity.</p>
        </div>

        <form action="#" method="POST" id="form-profil-pelamar" enctype="multipart/form-data" class="space-y-8" @submit.prevent="$dispatch('open-confirm-modal', {
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
                        <input type="text" name="no_hp" placeholder="Contoh: 08123456789" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                    </div>
                </div>
            </div>

            <!-- Section 2: Kelahiran & Domisili -->
            <div class="space-y-4 pt-4">
                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-200 pb-2">Kelahiran & Domisili / Birth & Domicile</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Lahir / Place of Birth *</label>
                        <input type="text" name="tempat_lahir" placeholder="Kota Kelahiran" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir / Date of Birth *</label>
                        <!-- Menggunakan onClick="this.showPicker()" agar langsung keluar kalender saat diklik di manapun pada input -->
                        <input type="date" name="tanggal_lahir" onclick="this.showPicker()" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors cursor-pointer" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin / Gender *</label>
                        <select name="jenis_kelamin" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                            <option value="">Pilih Jenis Kelamin... / Select Gender...</option>
                            <option value="Pria">Pria (Male)</option>
                            <option value="Wanita">Wanita (Female)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Pendidikan Terakhir / Last Education *</label>
                        <select name="pendidikan" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                            <option value="">Pilih Pendidikan... / Select Education...</option>
                            <option value="SMA/SMK">SMA / SMK Sederajat</option>
                            <option value="D3">Diploma 3 (D3)</option>
                            <option value="S1">Strata 1 (S1) / D4</option>
                            <option value="S2">Strata 2 (S2)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Domisili Lengkap / Complete Domicile Address *</label>
                    <textarea name="alamat" rows="3" placeholder="Masukkan alamat tempat tinggal Anda saat ini..." class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required></textarea>
                </div>
            </div>

            <!-- Section 3: Kewarganegaraan & Identitas -->
            <div class="space-y-4 pt-4 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-200 pb-2">Status Kewarganegaraan / Citizenship Status</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kewarganegaraan (Nationality) *</label>
                        <select x-model="kewarganegaraan" name="status_kewarganegaraan" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" required>
                            <option value="WNI">WNI (Warga Negara Indonesia)</option>
                            <option value="WNA">WNA (Warga Negara Asing / Foreigner)</option>
                        </select>
                    </div>
                    
                    <!-- Dinamis: NIK atau Passport -->
                    <div x-show="kewarganegaraan === 'WNI'" x-transition>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nomor NIK / National ID Number *</label>
                        <input type="text" name="nik" placeholder="16 Digit NIK KTP" maxlength="16" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>

                    <div x-show="kewarganegaraan === 'WNA'" x-transition style="display: none;">
                        <label class="block text-sm font-bold text-slate-700 mb-2">No. Passport *</label>
                        <input type="text" name="passport" placeholder="Nomor Passport" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>
                </div>

                <!-- Tambahan Form jika WNA -->
                <div x-show="kewarganegaraan === 'WNA'" x-transition style="display: none;" class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-slate-200/60 mt-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Asal Negara / Country *</label>
                        <input type="text" name="negara_asal" placeholder="Origin Country" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Provinsi / Province *</label>
                        <input type="text" name="provinsi_wna" placeholder="Province / State" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kota / City *</label>
                        <input type="text" name="kota_wna" placeholder="City" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors">
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
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Perusahaan / Company Name *</label>
                                    <input type="text" :name="'pengalaman['+index+'][nama_perusahaan]'" placeholder="Nama Tempat Bekerja / Workplace Name" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" :required="punyaPengalaman === 'IYA'">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Posisi / Jabatan / Position *</label>
                                    <input type="text" :name="'pengalaman['+index+'][posisi_pekerjaan]'" placeholder="Contoh / Example: Staff Administrasi" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" :required="punyaPengalaman === 'IYA'">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Lama Bekerja / Duration of Work *</label>
                                <input type="text" :name="'pengalaman['+index+'][lama_bekerja]'" placeholder="Contoh / Example: 2 Tahun 6 Bulan / 2 Years 6 Months" class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" :required="punyaPengalaman === 'IYA'">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Singkat Pekerjaan / Brief Job Description *</label>
                                <textarea :name="'pengalaman['+index+'][deskripsi_pekerjaan]'" rows="3" placeholder="Gambarkan secara singkat tugas dan tanggung jawab Anda..." class="w-full bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-[#003d7c] focus:border-[#003d7c] block p-3 transition-colors" :required="punyaPengalaman === 'IYA'"></textarea>
                            </div>
                        </div>
                    </template>

                    <!-- Tombol Tambah Pengalaman -->
                    <button type="button" @click="pengalamanList.push({ id: Date.now() })" class="w-full py-4 border-2 border-dashed border-blue-200 text-blue-600 hover:bg-blue-50 hover:border-blue-400 rounded-2xl font-bold transition-all flex items-center justify-center gap-2 group">
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
