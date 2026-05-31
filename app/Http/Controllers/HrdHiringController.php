<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class HrdHiringController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()?->role !== 'hrd') {
                return redirect()->route('pelamar.dashboard');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $postings = JobPosting::latest()->get();

        return view('hrd.hiring', [
            'postings' => $postings,
        ]);
    }

    public function create()
    {
        return view('hrd.hiring.create', [
            'categories' => $this->categories(),
            'educationLevels' => $this->educationLevels(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatePosting($request);
        
        $data['created_by'] = auth()->id();
        $data['is_active'] = $request->boolean('is_active', true);
        $data['salary_hidden'] = $request->boolean('salary_hidden');

        // Extract requirements config status and values
        $config = [
            'gender' => [
                'status' => $request->input('req_gender_status', 'nonaktif'),
                'value' => $request->input('req_gender_value', 'male'),
            ],
            'age' => [
                'status' => $request->input('req_age_status', 'nonaktif'),
                'min' => $request->input('req_age_min', 18),
                'max' => $request->input('req_age_max', 65),
            ],
            'education' => [
                'status' => $request->input('req_education_status', 'nonaktif'),
                'value' => $request->input('req_education_value', 'SMA/SMK'),
            ],
            'agd' => [
                'status' => $request->input('req_agd_status', 'nonaktif'),
            ],
            'sim_c' => [
                'status' => $request->input('req_sim_c_status', 'nonaktif'),
            ],
            'sim_b1' => [
                'status' => $request->input('req_sim_b1_status', 'nonaktif'),
            ],
            'experience' => [
                'status' => $request->input('req_experience_status', 'nonaktif'),
                'value' => $request->input('req_experience_value', 0),
            ],
            'placement_ready' => [
                'status' => $request->input('req_placement_ready_status', 'nonaktif'),
            ],
            'major' => [
                'status' => $request->input('req_major_status', 'nonaktif'),
                'value' => $request->input('req_major_value'),
            ],
            'placement_choices' => [
                'status' => $request->input('req_placement_choices_status', 'nonaktif'),
                'value' => $request->input('req_placement_choices_value'),
            ],
            'medical_support' => [
                'status' => $request->input('req_medical_support_status', 'nonaktif'),
            ],
            'medical_terms' => [
                'status' => $request->input('req_medical_terms_status', 'nonaktif'),
            ],
            'gardener_tech_understanding' => [
                'status' => $request->input('req_gardener_tech_understanding_status', 'nonaktif'),
            ],
            'gardener_nursery_skill' => [
                'status' => $request->input('req_gardener_nursery_skill_status', 'nonaktif'),
            ],
            'gardener_tools_skill' => [
                'status' => $request->input('req_gardener_tools_skill_status', 'nonaktif'),
            ],
        ];

        $customDocs = [];
        $docKeys = $request->input('req_custom_doc_keys', []);
        $docLabels = $request->input('req_custom_doc_labels', []);
        $docStatuses = $request->input('req_custom_doc_statuses', []);
        for ($i = 0; $i < count($docKeys); $i++) {
            if (!empty($docKeys[$i])) {
                $customDocs[] = [
                    'key' => trim($docKeys[$i]),
                    'label' => trim($docLabels[$i] ?? $docKeys[$i]),
                    'status' => $docStatuses[$i] ?? 'core',
                ];
            }
        }
        $config['custom_documents'] = $customDocs;

        $data['requirements_config'] = $config;

        // Also fill existing DB columns for backward compatibility / fallback
        $data['core_gender'] = $config['gender']['status'] !== 'nonaktif' ? $config['gender']['value'] : 'male';
        $data['core_min_age'] = $config['age']['status'] !== 'nonaktif' ? $config['age']['min'] : 18;
        $data['core_max_age'] = $config['age']['status'] !== 'nonaktif' ? $config['age']['max'] : 65;
        $data['core_min_education'] = $config['education']['status'] !== 'nonaktif' ? $config['education']['value'] : 'SMA/SMK';
        $data['core_requires_agd'] = $config['agd']['status'] === 'core';
        $data['core_requires_sim_c'] = $config['sim_c']['status'] === 'core';
        $data['core_requires_sim_b1'] = $config['sim_b1']['status'] === 'core';
        $data['second_min_experience'] = $config['experience']['status'] !== 'nonaktif' ? $config['experience']['value'] : 0;
        $data['second_requires_placement_ready'] = $config['placement_ready']['status'] === 'core';

        if ($data['second_requires_placement_ready']) {
            $data['location_city'] = null;
        }

        if (($data['shift_type'] ?? null) === 'none') {
            $data['shift_type'] = null;
        }

        if ($data['salary_hidden']) {
            $data['salary_min'] = null;
            $data['salary_max'] = null;
        }

        JobPosting::create($data);

        return redirect()->route('hrd.hiring')->with('success', 'Lowongan berhasil dibuat.');
    }

    public function show(JobPosting $jobPosting)
    {
        $priorityApplications = $jobPosting->applications()
            ->with(['user.profile'])
            ->where('is_priority', true)
            ->orderBy('matching_score', 'desc')
            ->orderBy('birth_date', 'desc')
            ->orderBy('experience_years', 'desc')
            ->orderBy('placement_ready', 'desc')
            ->get();

        $nonPriorityApplications = $jobPosting->applications()
            ->with(['user.profile'])
            ->where('is_priority', false)
            ->orderBy('matching_score', 'desc')
            ->latest()
            ->get();

        return view('hrd.hiring.show', [
            'posting' => $jobPosting,
            'priorityApplications' => $priorityApplications,
            'nonPriorityApplications' => $nonPriorityApplications,
        ]);
    }

    public function edit(JobPosting $jobPosting)
    {
        return view('hrd.hiring.edit', [
            'posting' => $jobPosting,
            'categories' => $this->categories(),
            'educationLevels' => $this->educationLevels(),
        ]);
    }

    public function update(Request $request, JobPosting $jobPosting)
    {
        $data = $this->validatePosting($request);
        
        $data['is_active'] = $request->boolean('is_active', true);
        $data['salary_hidden'] = $request->boolean('salary_hidden');

        // Extract requirements config status and values
        $config = [
            'gender' => [
                'status' => $request->input('req_gender_status', 'nonaktif'),
                'value' => $request->input('req_gender_value', 'male'),
            ],
            'age' => [
                'status' => $request->input('req_age_status', 'nonaktif'),
                'min' => $request->input('req_age_min', 18),
                'max' => $request->input('req_age_max', 65),
            ],
            'education' => [
                'status' => $request->input('req_education_status', 'nonaktif'),
                'value' => $request->input('req_education_value', 'SMA/SMK'),
            ],
            'agd' => [
                'status' => $request->input('req_agd_status', 'nonaktif'),
            ],
            'sim_c' => [
                'status' => $request->input('req_sim_c_status', 'nonaktif'),
            ],
            'sim_b1' => [
                'status' => $request->input('req_sim_b1_status', 'nonaktif'),
            ],
            'experience' => [
                'status' => $request->input('req_experience_status', 'nonaktif'),
                'value' => $request->input('req_experience_value', 0),
            ],
            'placement_ready' => [
                'status' => $request->input('req_placement_ready_status', 'nonaktif'),
            ],
            'major' => [
                'status' => $request->input('req_major_status', 'nonaktif'),
                'value' => $request->input('req_major_value'),
            ],
            'placement_choices' => [
                'status' => $request->input('req_placement_choices_status', 'nonaktif'),
                'value' => $request->input('req_placement_choices_value'),
            ],
            'medical_support' => [
                'status' => $request->input('req_medical_support_status', 'nonaktif'),
            ],
            'medical_terms' => [
                'status' => $request->input('req_medical_terms_status', 'nonaktif'),
            ],
            'gardener_tech_understanding' => [
                'status' => $request->input('req_gardener_tech_understanding_status', 'nonaktif'),
            ],
            'gardener_nursery_skill' => [
                'status' => $request->input('req_gardener_nursery_skill_status', 'nonaktif'),
            ],
            'gardener_tools_skill' => [
                'status' => $request->input('req_gardener_tools_skill_status', 'nonaktif'),
            ],
        ];

        $customDocs = [];
        $docKeys = $request->input('req_custom_doc_keys', []);
        $docLabels = $request->input('req_custom_doc_labels', []);
        $docStatuses = $request->input('req_custom_doc_statuses', []);
        for ($i = 0; $i < count($docKeys); $i++) {
            if (!empty($docKeys[$i])) {
                $customDocs[] = [
                    'key' => trim($docKeys[$i]),
                    'label' => trim($docLabels[$i] ?? $docKeys[$i]),
                    'status' => $docStatuses[$i] ?? 'core',
                ];
            }
        }
        $config['custom_documents'] = $customDocs;

        $data['requirements_config'] = $config;

        // Also fill existing DB columns for backward compatibility / fallback
        $data['core_gender'] = $config['gender']['status'] !== 'nonaktif' ? $config['gender']['value'] : 'male';
        $data['core_min_age'] = $config['age']['status'] !== 'nonaktif' ? $config['age']['min'] : 18;
        $data['core_max_age'] = $config['age']['status'] !== 'nonaktif' ? $config['age']['max'] : 65;
        $data['core_min_education'] = $config['education']['status'] !== 'nonaktif' ? $config['education']['value'] : 'SMA/SMK';
        $data['core_requires_agd'] = $config['agd']['status'] === 'core';
        $data['core_requires_sim_c'] = $config['sim_c']['status'] === 'core';
        $data['core_requires_sim_b1'] = $config['sim_b1']['status'] === 'core';
        $data['second_min_experience'] = $config['experience']['status'] !== 'nonaktif' ? $config['experience']['value'] : 0;
        $data['second_requires_placement_ready'] = $config['placement_ready']['status'] === 'core';

        if ($data['second_requires_placement_ready']) {
            $data['location_city'] = null;
        }

        if (($data['shift_type'] ?? null) === 'none') {
            $data['shift_type'] = null;
        }

        if ($data['salary_hidden']) {
            $data['salary_min'] = null;
            $data['salary_max'] = null;
        }

        $jobPosting->update($data);

        return redirect()->route('hrd.hiring')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();

        return redirect()->route('hrd.hiring')->with('success', 'Lowongan berhasil dihapus.');
    }

    /**
     * Toggle the is_active status of a job posting.
     * If active → deactivate (hidden from public).
     * If inactive → activate (visible to public).
     */
    public function toggleActive(JobPosting $jobPosting)
    {
        $jobPosting->update(['is_active' => !$jobPosting->is_active]);

        $status = $jobPosting->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Lowongan \"{$jobPosting->title}\" berhasil {$status}.");
    }

    private function validatePosting(Request $request): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:60'],
            'description' => ['nullable', 'string', 'max:2000'],
            'location_city' => ['nullable', 'string', 'max:120'],
            'shift_type' => ['nullable', 'in:shift,non_shift,none'],
            'salary_min' => ['nullable', 'integer', 'min:0'],
            'salary_max' => ['nullable', 'integer', 'min:0'],
            'salary_hidden' => ['nullable'],
            'is_active' => ['nullable'],
            'active_until' => ['nullable', 'date'],
        ];

        if ($request->input('category') !== 'Cleaning Service' && $request->input('req_placement_ready_status') === 'nonaktif') {
            $rules['location_city'] = ['required', 'string', 'max:120'];
        }

        $category = $request->input('category');
        $isDriverNurseOrCS = in_array($category, ['Driver Ambulance', 'Asisten Keperawatan', 'Cleaning Service', 'Runner', 'Gardener']);
        $salaryHidden = $request->boolean('salary_hidden');

        if ($isDriverNurseOrCS) {
            $rules['shift_type'] = ['required', 'in:shift,non_shift,none'];
            if (!$salaryHidden) {
                $rules['salary_min'] = ['required', 'integer', 'min:0'];
                $rules['salary_max'] = ['required', 'integer', 'min:0', 'gte:salary_min'];
            }
        }

        return $request->validate($rules, [
            'location_city.required' => 'Lokasi Penempatan Kerja wajib dipilih jika Kesiapan Penempatan UCI dinonaktifkan.',
            'shift_type.required' => 'Jenis Shift wajib dipilih untuk posisi operasional (Driver Ambulance, Asisten Keperawatan, Cleaning Service, Runner, Gardener).',
            'salary_min.required' => 'Gaji Minimum wajib diisi, atau silakan centang "Sembunyikan Rentang Gaji".',
            'salary_max.required' => 'Gaji Maksimum wajib diisi, atau silakan centang "Sembunyikan Rentang Gaji".',
            'salary_max.gte' => 'Gaji Maksimum harus lebih besar atau sama dengan Gaji Minimum.',
        ]);
    }

    private function categories(): array
    {
        return [
            'Driver Ambulance',
            'Cleaning Service',
            'Asisten Keperawatan',
            'Runner',
            'Gardener',
            'Bell Boy',
        ];
    }

    private function educationLevels(): array
    {
        return ['SMA/SMK', 'D3', 'S1', 'S2', 'S3'];
    }

    /**
     * Display HRD Dashboard with dynamic stats and latest applicants.
     */
    public function dashboard()
    {
        $activePostingsCount = JobPosting::where('is_active', true)->count();
        $totalApplicantsCount = \App\Models\JobApplication::count();
        $priorityCount = \App\Models\JobApplication::where('is_priority', true)->count();
        $nonPriorityCount = \App\Models\JobApplication::where('is_priority', false)->count();

        $latestApplications = \App\Models\JobApplication::with(['user.profile', 'posting'])
            ->latest()
            ->take(5)
            ->get();

        // Calculate daily stats for the last 30 days
        $dates = [];
        for ($i = 29; $i >= 0; $i--) {
            $dates[] = date('Y-m-d', strtotime("-$i days"));
        }

        $registrationsRaw = \App\Models\User::where('created_at', '>=', now()->subDays(30)->startOfDay())->get();
        $applicationsRaw = \App\Models\JobApplication::where('created_at', '>=', now()->subDays(30)->startOfDay())->get();

        $registrations = [];
        foreach ($registrationsRaw as $u) {
            $d = $u->created_at->format('Y-m-d');
            $registrations[$d] = ($registrations[$d] ?? 0) + 1;
        }

        $applications = [];
        foreach ($applicationsRaw as $app) {
            $d = $app->created_at->format('Y-m-d');
            $applications[$d] = ($applications[$d] ?? 0) + 1;
        }

        $chartData = [];
        foreach ($dates as $date) {
            $chartData[] = [
                'raw_date' => $date,
                'label' => date('d M', strtotime($date)),
                'registrations' => $registrations[$date] ?? 0,
                'applications' => $applications[$date] ?? 0,
            ];
        }

        return view('hrd.dashboard', [
            'activePostingsCount' => $activePostingsCount,
            'totalApplicantsCount' => $totalApplicantsCount,
            'priorityCount' => $priorityCount,
            'nonPriorityCount' => $nonPriorityCount,
            'latestApplications' => $latestApplications,
            'chartData' => $chartData,
        ]);
    }

    /**
     * Display all registered applicants in the database.
     */
    public function pelamarAktif(Request $request)
    {
        $query = \App\Models\User::where('role', 'pelamar')
            ->with(['profile', 'applications.posting']);

        // Search filter
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('profile', function($qp) use ($search) {
                      $qp->where('city', 'like', "%{$search}%")
                         ->orWhere('province', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%")
                         ->orWhere('education_level', 'like', "%{$search}%");
                  });
            });
        }

        // Education filter
        if ($request->has('education') && $request->get('education') !== 'all') {
            $education = $request->get('education');
            $query->whereHas('profile', function($q) use ($education) {
                $q->where('education_level', $education);
            });
        }

        $pelamarList = $query->latest()->paginate(10)->withQueryString();

        // Get unique educations for filter dropdown
        $educations = \App\Models\UserProfile::whereNotNull('education_level')
            ->select('education_level')
            ->distinct()
            ->pluck('education_level')
            ->sort();

        return view('hrd.pelamar-aktif', [
            'pelamarList' => $pelamarList,
            'educations' => $educations,
        ]);
    }
}
