<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PelamarLowonganController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()?->role !== 'pelamar') {
                return redirect()->route('hrd.dashboard');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $today = Carbon::today();
        $postings = JobPosting::where('is_active', true)
            ->where(function ($query) use ($today) {
                $query->whereNull('active_until')
                    ->orWhere('active_until', '>=', $today);
            })
            ->latest()
            ->get();

        $appliedJobIds = auth()->check()
            ? JobApplication::where('user_id', auth()->id())->pluck('job_posting_id')->toArray()
            : [];

        return view('pelamar.lowongan', [
            'postings' => $postings,
            'appliedJobIds' => $appliedJobIds,
        ]);
    }

    public function create(JobPosting $jobPosting)
    {
        $today = Carbon::today();
        if (!$jobPosting->is_active || ($jobPosting->active_until && $jobPosting->active_until->lt($today))) {
            return redirect()->route('pelamar.lowongan')->with('error', 'Lowongan ini sudah ditutup atau tidak aktif lagi.');
        }

        $existingApp = JobApplication::where('job_posting_id', $jobPosting->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingApp) {
            $defaults = [
                'gender' => $existingApp->gender,
                'birth_date' => $existingApp->birth_date?->format('Y-m-d'),
                'education_level' => $existingApp->education_level,
                'experience_years' => $existingApp->experience_years,
                'has_agd' => $existingApp->has_agd,
                'placement_ready' => $existingApp->placement_ready,
                'agd_certificate_path' => $existingApp->agd_certificate_path,
                'sim_c_path' => $existingApp->sim_c_path,
                'sim_b1_path' => $existingApp->sim_b1_path,
            ];
        } else {
            $profile = auth()->user()->profile;
            $defaults = [
                'gender' => $profile?->gender,
                'birth_date' => $profile?->birth_date?->format('Y-m-d'),
                'education_level' => $profile?->education_level,
                'experience_years' => $profile?->experience_years ?? 0,
                'has_agd' => false,
                'placement_ready' => false,
                'agd_certificate_path' => null,
                'sim_c_path' => null,
                'sim_b1_path' => null,
            ];
        }

        return view('pelamar.lowongan-apply', [
            'posting' => $jobPosting,
            'educationLevels' => ['SMA/SMK', 'D3', 'S1', 'S2', 'S3'],
            'defaults' => $defaults,
            'isEdit' => (bool)$existingApp,
        ]);
    }

    public function store(Request $request, JobPosting $jobPosting)
    {
        $today = Carbon::today();
        if (!$jobPosting->is_active || ($jobPosting->active_until && $jobPosting->active_until->lt($today))) {
            return redirect()->route('pelamar.lowongan')->with('error', 'Lowongan ini sudah ditutup atau tidak aktif lagi.');
        }

        $existingApp = JobApplication::where('job_posting_id', $jobPosting->id)
            ->where('user_id', auth()->id())
            ->first();

        // Intercept and auto-calculate experience_years from inputs before validation
        if ($request->boolean('has_experience')) {
            $startDates = $request->input('tanggal_mulai', []);
            $endDates = $request->input('tanggal_selesai', []);
            $durations = [];
            $count = max(count($startDates), count($endDates));
            for ($i = 0; $i < $count; $i++) {
                $startVal = $startDates[$i] ?? null;
                $endVal = $endDates[$i] ?? null;
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

                        $durations[] = implode(' ', $parts);
                    } catch (\Exception $e) {
                        $durations[] = '';
                    }
                } else {
                    $durations[] = '';
                }
            }

            $years = $this->estimateExperienceYears($durations);
            $request->merge(['experience_years' => $years]);
        } else {
            $request->merge(['experience_years' => 0]);
        }

        $data = $request->validate([
            'gender' => ['required', 'in:male,female'],
            'birth_date' => ['required', 'date'],
            'education_level' => ['required', 'string', 'max:20'],
            'has_agd' => ['nullable'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:50'],
            'placement_ready' => ['nullable'],
            'agd_certificate' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'sim_c_photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'sim_b1_photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'perusahaan' => ['nullable', 'array'],
            'perusahaan.*' => ['nullable', 'string', 'max:120'],
            'posisi' => ['nullable', 'array'],
            'posisi.*' => ['nullable', 'string', 'max:120'],
            'tanggal_mulai' => ['nullable', 'array'],
            'tanggal_mulai.*' => ['nullable', 'string', 'regex:/^\d{4}-\d{2}$/'],
            'tanggal_selesai' => ['nullable', 'array'],
            'tanggal_selesai.*' => ['nullable', 'string', 'regex:/^\d{4}-\d{2}$/'],
            'deskripsi_pekerjaan' => ['nullable', 'array'],
            'deskripsi_pekerjaan.*' => ['nullable', 'string', 'max:1000'],
        ]);

        $isUpdate = (bool)$existingApp;

        if ($isUpdate) {
            $application = $existingApp;
            $application->gender = $data['gender'];
            $application->birth_date = $data['birth_date'];
            $application->education_level = $data['education_level'];
            $application->has_agd = $request->boolean('has_agd');
            $application->experience_years = $data['experience_years'];
            $application->placement_ready = $request->boolean('placement_ready');
        } else {
            $application = new JobApplication([
                'job_posting_id' => $jobPosting->id,
                'user_id' => auth()->id(),
                'gender' => $data['gender'],
                'birth_date' => $data['birth_date'],
                'education_level' => $data['education_level'],
                'has_agd' => $request->boolean('has_agd'),
                'experience_years' => $data['experience_years'],
                'placement_ready' => $request->boolean('placement_ready'),
                'is_priority' => false,
            ]);
        }

        $application->save();

        // Update UserProfile extras experiences dynamically
        if ($request->boolean('has_experience')) {
            $companies = $request->input('perusahaan', []);
            $positions = $request->input('posisi', []);
            $startDates = $request->input('tanggal_mulai', []);
            $endDates = $request->input('tanggal_selesai', []);
            $descriptions = $request->input('deskripsi_pekerjaan', []);

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

                $payload[] = [
                    'company' => $companies[$i] ?? null,
                    'position' => $positions[$i] ?? null,
                    'start_date' => $startVal,
                    'end_date' => $endVal,
                    'duration' => $durationString,
                    'description' => $descriptions[$i] ?? null,
                ];
            }

            $profile = auth()->user()->profile;
            if ($profile) {
                $extras = $profile->extras ?? [];
                $extras['experiences'] = $payload;
                $extras['has_experience'] = true;
                $profile->extras = $extras;
                $profile->experience_years = $data['experience_years'];
                $profile->save();
            }
        }

        $folder = "applications/{$jobPosting->id}/{$application->id}";
        if ($request->hasFile('agd_certificate')) {
            $application->agd_certificate_path = $request->file('agd_certificate')->store($folder, 'public');
        }
        if ($request->hasFile('sim_c_photo')) {
            $application->sim_c_path = $request->file('sim_c_photo')->store($folder, 'public');
        }
        if ($request->hasFile('sim_b1_photo')) {
            $application->sim_b1_path = $request->file('sim_b1_photo')->store($folder, 'public');
        }

        $spk = $jobPosting->calculateSpkScore($application);
        $application->is_priority = $spk['is_priority'];
        $application->matching_score = $spk['matching_score'];
        $application->save();

        $msg = $isUpdate ? 'Lamaran Anda berhasil diperbarui.' : 'Lamaran berhasil dikirim.';
        return redirect()->route('pelamar.lowongan')->with('success', $msg);
    }

    public function dashboard()
    {
        $today = Carbon::today();
        
        $postings = JobPosting::where('is_active', true)
            ->where(function ($query) use ($today) {
                $query->whereNull('active_until')
                    ->orWhere('active_until', '>=', $today);
            })
            ->latest()
            ->take(2)
            ->get();

        $activeApplicationsCount = JobApplication::where('user_id', auth()->id())->count();

        return view('pelamar.dashboard', [
            'postings' => $postings,
            'activeApplicationsCount' => $activeApplicationsCount,
        ]);
    }

    public function history()
    {
        $applications = JobApplication::with('posting')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pelamar.riwayat', [
            'applications' => $applications,
        ]);
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

            if (preg_match('/(\d+)\s*(?:tahun|thn|year|yr)/', $text, $matches)) {
                $years = (int) $matches[1];
            }

            if (preg_match('/(\d+)\s*(?:bulan|bln|month|mo)/', $text, $matches)) {
                $months = (int) $matches[1];
            }

            if (!$years && !$months && preg_match('/^\d+$/', trim($text))) {
                $years = (int) trim($text);
            }

            $totalYears += $years + ($months / 12);
        }

        return (int) min(50, floor($totalYears));
    }
}
