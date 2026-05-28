<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle pelamar registration.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:120', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'kewarganegaraan' => ['required', 'in:WNI,WNA'],
            'nik' => ['nullable', 'string', 'max:20'],
            'paspor' => ['nullable', 'string', 'max:20'],
            'asal_negara' => ['nullable', 'string', 'max:80'],
            'tempat_lahir' => ['required', 'string', 'max:80'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string', 'max:500'],
            'provinsi' => ['required', 'string', 'max:80'],
            'kota' => ['required', 'string', 'max:80'],
            'kode_pos' => ['required', 'string', 'max:10'],
            'pendidikan' => ['required', 'string', 'max:20'],
            'tahun_lulus' => ['required', 'integer', 'min:1980', 'max:' . date('Y')],
            'sekolah' => ['required', 'string', 'max:120'],
            'jurusan' => ['required', 'string', 'max:120'],
            'has_experience' => ['nullable'],
            'perusahaan' => ['array'],
            'perusahaan.*' => ['nullable', 'string', 'max:120'],
            'posisi' => ['array'],
            'posisi.*' => ['nullable', 'string', 'max:120'],
            'tanggal_mulai' => ['array'],
            'tanggal_mulai.*' => ['nullable', 'string', 'regex:/^\d{4}-\d{2}$/'],
            'tanggal_selesai' => ['array'],
            'tanggal_selesai.*' => ['nullable', 'string', 'regex:/^\d{4}-\d{2}$/'],
            'deskripsi_pekerjaan' => ['array'],
            'deskripsi_pekerjaan.*' => ['nullable', 'string', 'max:1000'],
            'file_cv' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'file_foto' => ['required', 'image', 'max:2048'],
            'role' => ['nullable', 'string'],
        ]);

        if ($data['kewarganegaraan'] === 'WNI' && empty($data['nik'])) {
            return back()->withErrors(['nik' => 'NIK wajib diisi untuk WNI.'])->withInput();
        }

        if ($data['kewarganegaraan'] === 'WNA' && (empty($data['paspor']) || empty($data['asal_negara']))) {
            return back()->withErrors(['paspor' => 'Paspor dan asal negara wajib diisi untuk WNA.'])->withInput();
        }

        $user = User::create([
            'name' => trim($data['first_name'] . ' ' . $data['last_name']),
            'email' => $data['email'],
            'role' => 'pelamar',
            'password' => Hash::make($data['password']),
        ]);

        $experiences = $this->buildExperiencePayload($data);
        $experienceYears = $this->estimateExperienceYears(array_column($experiences, 'duration'));

        $cvPath = $request->file('file_cv')->store('profiles/cv', 'public');
        $photoPath = $request->file('file_foto')->store('profiles/photos', 'public');

        UserProfile::create([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'birth_place' => $data['tempat_lahir'],
            'birth_date' => $data['tanggal_lahir'],
            'gender' => $this->normalizeGender($data['jenis_kelamin']),
            'education_level' => $this->normalizeEducation($data['pendidikan']),
            'experience_years' => $experienceYears,
            'address' => $data['alamat'],
            'province' => $data['provinsi'],
            'city' => $data['kota'],
            'postal_code' => $data['kode_pos'],
            'cv_path' => $cvPath,
            'photo_path' => $photoPath,
            'extras' => [
                'citizenship' => $data['kewarganegaraan'],
                'nik' => $data['nik'] ?? null,
                'paspor' => $data['paspor'] ?? null,
                'asal_negara' => $data['asal_negara'] ?? null,
                'graduation_year' => $data['tahun_lulus'],
                'school_name' => $data['sekolah'],
                'major' => $data['jurusan'],
                'has_experience' => $request->boolean('has_experience'),
                'experiences' => $experiences,
            ],
        ]);

        Auth::login($user);

        return redirect()->route('pelamar.dashboard')->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on role
            if ($user->role === 'hrd') {
                return redirect()->route('hrd.dashboard')->with('success', 'Selamat datang HRD, Anda berhasil masuk!');
            }

            return redirect()->route('pelamar.dashboard')->with('success', 'Selamat datang Pelamar, Anda berhasil masuk!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }

    private function normalizeGender(string $value): string
    {
        $lower = strtolower($value);
        if (str_contains($lower, 'laki')) {
            return 'male';
        }

        return 'female';
    }

    private function normalizeEducation(string $value): string
    {
        $normalized = strtoupper(trim($value));

        if (str_contains($normalized, 'SMA') || str_contains($normalized, 'SMK')) {
            return 'SMA/SMK';
        }

        if ($normalized === 'D3') {
            return 'D3';
        }

        if (str_contains($normalized, 'D4') || str_contains($normalized, 'S1')) {
            return 'S1';
        }

        if (str_contains($normalized, 'S2')) {
            return 'S2';
        }

        if (str_contains($normalized, 'S3')) {
            return 'S3';
        }

        return 'SMA/SMK';
    }

    private function estimateExperienceYears(array $durations): int
    {
        $totalYears = 0.0;

        foreach ($durations as $duration) {
            if (!$duration) {
                continue;
            }

            $text = strtolower($duration);
            $years = 0;
            $months = 0;

            if (preg_match('/(\d+)\s*tahun/', $text, $matches)) {
                $years = (int) $matches[1];
            }

            if (preg_match('/(\d+)\s*bulan/', $text, $matches)) {
                $months = (int) $matches[1];
            }

            $totalYears += $years + ($months / 12);
        }

        return (int) min(50, floor($totalYears));
    }

    private function buildExperiencePayload(array $data): array
    {
        $companies = $data['perusahaan'] ?? [];
        $positions = $data['posisi'] ?? [];
        $startDates = $data['tanggal_mulai'] ?? [];
        $endDates = $data['tanggal_selesai'] ?? [];
        $descriptions = $data['deskripsi_pekerjaan'] ?? [];

        $payload = [];
        $count = max(count($companies), count($positions), count($startDates), count($endDates), count($descriptions));
        for ($i = 0; $i < $count; $i++) {
            if (!($companies[$i] ?? null) && !($positions[$i] ?? null) && !($startDates[$i] ?? null) && !($endDates[$i] ?? null) && !($descriptions[$i] ?? null)) {
                continue;
            }

            $durationString = '';
            $startVal = $startDates[$i] ?? null;
            $endVal = $endDates[$i] ?? null;

            if ($startVal && $endVal) {
                try {
                    $start = \Carbon\Carbon::createFromFormat('Y-m', $startVal);
                    $end = \Carbon\Carbon::createFromFormat('Y-m', $endVal);

                    $monthsDiff = (($end->year - $start->year) * 12 + ($end->month - $start->month)) + 1;
                    if ($monthsDiff < 0) {
                        $monthsDiff = 0;
                    }

                    $y = floor($monthsDiff / 12);
                    $m = $monthsDiff % 12;

                    $parts = [];
                    if ($y > 0) {
                        $parts[] = "$y Tahun";
                    }
                    if ($m > 0 || empty($parts)) {
                        $parts[] = "$m Bulan";
                    }
                    $durationString = implode(' ', $parts);
                } catch (\Exception $e) {
                    $durationString = '';
                }
            }

            $payload[] = [
                'company' => $companies[$i] ?? null,
                'position' => $positions[$i] ?? null,
                'start_date' => $startVal,
                'end_date' => $endVal,
                'duration' => $durationString,
                'description' => $descriptions[$i] ?? null,
            ];
        }

        return $payload;
    }

    public function updatePelamarProfile(Request $request)
    {
        if (Auth::user()->role !== 'pelamar') {
            abort(403);
        }

        $data = $request->validate([
            'nama_depan' => ['required', 'string', 'max:80'],
            'nama_belakang' => ['nullable', 'string', 'max:80'],
            'no_hp' => ['required', 'string', 'max:20'],
            'tempat_lahir' => ['required', 'string', 'max:80'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'pendidikan' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string', 'max:500'],
            'status_kewarganegaraan' => ['required', 'in:WNI,WNA'],
            'nik' => ['nullable', 'string', 'max:20'],
            'passport' => ['nullable', 'string', 'max:20'],
            'negara_asal' => ['nullable', 'string', 'max:80'],
            'provinsi_wna' => ['nullable', 'string', 'max:80'],
            'kota_wna' => ['nullable', 'string', 'max:80'],
            'punya_pengalaman' => ['required', 'in:TIDAK,IYA'],
            'pengalaman' => ['nullable', 'array'],
            'pengalaman.*.nama_perusahaan' => ['nullable', 'string', 'max:120'],
            'pengalaman.*.posisi_pekerjaan' => ['nullable', 'string', 'max:120'],
            'pengalaman.*.tanggal_mulai' => ['nullable', 'string', 'regex:/^\d{4}-\d{2}$/'],
            'pengalaman.*.tanggal_selesai' => ['nullable', 'string', 'regex:/^\d{4}-\d{2}$/'],
            'pengalaman.*.deskripsi_pekerjaan' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($data['status_kewarganegaraan'] === 'WNI' && empty($data['nik'])) {
            return back()->withErrors(['nik' => 'NIK wajib diisi untuk WNI.'])->withInput();
        }

        if ($data['status_kewarganegaraan'] === 'WNA' && (empty($data['passport']) || empty($data['negara_asal']))) {
            return back()->withErrors(['passport' => 'Paspor dan asal negara wajib diisi untuk WNA.'])->withInput();
        }

        $user = Auth::user();
        $user->name = trim($data['nama_depan'] . ' ' . ($data['nama_belakang'] ?? ''));
        $user->save();

        // Process experiences
        $experiences = [];
        $experienceYears = 0;

        if ($data['punya_pengalaman'] === 'IYA' && !empty($data['pengalaman'])) {
            $inputExps = $data['pengalaman'];
            foreach ($inputExps as $exp) {
                $comp = $exp['nama_perusahaan'] ?? null;
                $pos = $exp['posisi_pekerjaan'] ?? null;
                $startVal = $exp['tanggal_mulai'] ?? null;
                $endVal = $exp['tanggal_selesai'] ?? null;
                $desc = $exp['deskripsi_pekerjaan'] ?? null;

                if (!$comp && !$pos && !$startVal && !$endVal && !$desc) {
                    continue;
                }

                $durationString = '';
                if ($startVal && $endVal) {
                    try {
                        $start = \Carbon\Carbon::createFromFormat('Y-m', $startVal);
                        $end = \Carbon\Carbon::createFromFormat('Y-m', $endVal);

                        $monthsDiff = (($end->year - $start->year) * 12 + ($end->month - $start->month)) + 1;
                        if ($monthsDiff < 0) $monthsDiff = 0;

                        $y = floor($monthsDiff / 12);
                        $m = $monthsDiff % 12;

                        $parts = [];
                        if ($y > 0) $parts[] = "$y Tahun";
                        if ($m > 0 || empty($parts)) $parts[] = "$m Bulan";

                        $durationString = implode(' ', $parts);
                    } catch (\Exception $e) {
                        $durationString = '';
                    }
                }

                $experiences[] = [
                    'company' => $comp,
                    'position' => $pos,
                    'start_date' => $startVal,
                    'end_date' => $endVal,
                    'duration' => $durationString,
                    'description' => $desc,
                ];
            }

            $computedDurations = array_column($experiences, 'duration');
            $experienceYears = $this->estimateExperienceYears($computedDurations);
        }

        $profile = $user->profile;
        if (!$profile) {
            $profile = new UserProfile(['user_id' => $user->id]);
        }

        $profile->phone = $data['no_hp'];
        $profile->birth_place = $data['tempat_lahir'];
        $profile->birth_date = $data['tanggal_lahir'];
        $profile->gender = $this->normalizeGender($data['jenis_kelamin']);
        $profile->education_level = $this->normalizeEducation($data['pendidikan']);
        $profile->experience_years = $experienceYears;
        $profile->address = $data['alamat'];

        if ($data['status_kewarganegaraan'] === 'WNA') {
            $profile->province = $data['provinsi_wna'] ?? null;
            $profile->city = $data['kota_wna'] ?? null;
        }

        $extras = $profile->extras ?? [];
        $extras['citizenship'] = $data['status_kewarganegaraan'];
        $extras['nik'] = $data['nik'] ?? null;
        $extras['paspor'] = $data['passport'] ?? null;
        $extras['asal_negara'] = $data['negara_asal'] ?? null;
        $extras['has_experience'] = ($data['punya_pengalaman'] === 'IYA');
        $extras['experiences'] = $experiences;

        $profile->extras = $extras;
        $profile->save();

        return back()->with('success', 'Profil Anda berhasil diperbarui.');
    }

    /**
     * Update HRD Profile/Account or password.
     */
    public function updateHrdProfile(Request $request)
    {
        if (Auth::user()->role !== 'hrd') {
            abort(403);
        }

        $type = $request->input('update_type', 'profile');

        if ($type === 'password') {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ], [
                'password.required' => 'Password baru wajib diisi.',
                'password.min' => 'Password baru harus minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            ]);

            $user = Auth::user();
            $user->password = \Illuminate\Support\Facades\Hash::make($request->input('password'));
            $user->save();

            return back()->with('success', 'Password akun HRD berhasil diperbarui.');
        }

        // Default: update profile details
        $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:120', 'unique:users,email,' . Auth::id()],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Alamat email ini sudah digunakan oleh pengguna lain.',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return back()->with('success', 'Profil akun HRD berhasil diperbarui.');
    }
}
