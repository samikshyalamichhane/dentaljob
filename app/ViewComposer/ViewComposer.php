<?php

namespace App\ViewComposer;

use Illuminate\View\View;
use Modules\EmploymentSalaryType\Repositories\EmploymentSalaryTypeRepository;
use Modules\Setting\Repositories\SettingRepository;
use Illuminate\Support\Facades\Auth;
use DB;
use Modules\Jobseeker\Entities\Jobseeker;
use Modules\Employer\Repositories\EmployerRepository;
use Modules\Job\Repositories\JobRepository;
use Modules\Advertisement\Entities\Advertisement;



class ViewComposer
{
    protected $profile_progress = null;
    public function __construct(SettingRepository $setting, EmploymentSalaryTypeRepository $employmentSalaryType, Jobseeker $jobseeker, EmployerRepository $employer,  JobRepository $job)
    {
        $this->setting = $setting;
        $this->employmentSalaryType = $employmentSalaryType;
        $this->jobseeker = $jobseeker;
        $this->employer = $employer;
        $this->job = $job;
    }

    public function compose(View $view)
    {
        $profile_progress = 0;
        if (auth()->user() && (auth()->user()->role == 'jobseeker' || auth()->user()->role == 'employer')) {
            $profile_progress = $this->profile(Auth::id(), auth()->user()->role);
        }
        // dd($profile_progress);
        $dt = \Carbon\Carbon::now();
        $job_locations = DB::table('jobs')->select('town_city')->latest()->take(6)->get();
        $locations = DB::table('jobs')->select('town_city')->latest()->get();
        $job_categories = DB::table('jobcategories')->latest()->take(6)->get();
        $categories = DB::table('jobcategories')->latest()->get();
        $advertisement = Advertisement::Published()
            ->where('place', 'top_navbar')
            ->whereDate('expire_date', '>', $dt->format('Y-m-d'))
            ->first();
        // dd($job_categories);
        $settings = $this->setting->first();
        $roles = ['employer', 'jobseeker',];
        $employees_size = ['1-49', '50-149', '150-249', '250-449', '450-749', '750-1000', '1000+',];
        $salaryRange = ['Negotiable', '10-20K', '20-30K', '30-40K', '40-50K', '50-60K', '60-70K', '70-80K', 'More than 80K'];
        $countries = [
            'england' => 'England',
            'scotland' => 'Scotland',
            'wales' => 'Wales',
            'northern-ireland' => 'Northern Ireland',
        ];

        $time_periods = [
            'annually' => 'Annually',
            'monthly' => 'Monthly',
            'weekly' => 'Weekly',
            'hourly' => 'Hourly',
            'contract' => 'Contract',
        ];

        $currencies = [
            'euro' => 'Euro',
            'american_dollar' => 'American Dollar',
            'pound' => 'Pound',
        ];

        $employmentTypes = $this->employmentSalaryType->where('type', 'employment')->get();
        $salaryTypes = $this->employmentSalaryType->where('type', 'salary')->get();
        // dd($salaryTypes);
        $view->with([
            'dashboard_composer' => $settings,
            'dashboard_roles' => $roles,
            'dashboard_employees_size' => $employees_size,
            'dashboard_employmentTypes' => $employmentTypes,
            'dashboard_salaryTypes' => $salaryTypes,
            'dashboard_salary' => $salaryRange,
            'dashboard_countries' => $countries,
            'profile_progres' => $profile_progress,
            'dashboard_time_periods' => $time_periods,
            'dashboard_currencies' => $currencies,
            'footer_locations' => $job_locations,
            'locations' => $locations,
            'categories' => $categories,
            'footer_categories' => $job_categories,
            'advertisement' => $advertisement,

        ]);
    }

    public function profile($id, string $role)
    {
        $profile_progress = 0;
        $total_field = 21;
        // $percent = $field / $total_field * 100;
        $null_field_count = 0;

        $employers_filtered = $this->get_filtered_fields('employers', ['id', 'user_id', 'created_at', 'updated_at', 'publish', 'show_in_home']);
        if ($id != null && $role == 'employer') {
            $profile_progress = $this->get_profile_progress($this->employer, $id, $employers_filtered);
            return $profile_progress;
        }

        $job_seeker_filtered = $this->get_filtered_fields('jobseekers', ['user_id', 'middle_name', 'id', 'cv', 'created_at', 'updated_at', 'mobile_number', 'city', 'preferred_time', 'interest']);

        $past_experience_filtered = $this->get_filtered_fields('past_experiences', ['jobseeker_id', '_token', 'id', 'current_working', 'work_duration_from', 'work_duration_to', 'job_description', 'created_at', 'updated_at']);

        $additional_docs_filtered = $this->get_filtered_fields('additional_documents', ['jobseeker_id', 'id', 'created_at', 'updated_at']);

        if ($id != null && $role == 'jobseeker') {
            $jobseeker = Jobseeker::where('user_id', $id)->with('experiences')->with('documents')->first();
            // dd(count($filtered));
            for ($i = 0; $i < count($job_seeker_filtered); $i++) {
                if ($jobseeker[array_values($job_seeker_filtered)[$i]] == null) {
                    $null_field_count += 1;
                }
            }
            if ($jobseeker->experiences->isEmpty()) {
                $null_field_count += 4;
            } else {
                foreach ($jobseeker->experiences as $exp) {
                    for ($i = 0; $i < count($past_experience_filtered); $i++) {
                        // dd($jobseeker->experiences[array_values($past_experience_filtered)[$i]]);
                        // dd($exp);
                        if ($exp[array_values($past_experience_filtered)[$i]] == null) {
                            $null_field_count += 1;
                        }
                    }
                }
            }


            if ($jobseeker->documents->isEmpty()) {
                $null_field_count += 1;
            } else {
                foreach ($jobseeker->documents as $doc) {
                    for ($i = 0; $i < count($additional_docs_filtered); $i++) {
                        if ($doc[array_values($additional_docs_filtered)[$i]] == null) {
                            $null_field_count += 1;
                        }
                    }
                }
            }

            $profile_progress = (($total_field - $null_field_count) / $total_field) * 100;
            $profile_progress = number_format((float)$profile_progress);
        }

        return $profile_progress;
    }

    public function get_filtered_fields(string $table, array $excludedFields)
    {
        $allFields = DB::getSchemaBuilder()->getColumnListing($table);
        $filtered = array_diff($allFields, $excludedFields);
        return $filtered;
    }

    public function get_profile_progress(object $model, string $id, array $filtered)
    {
        $null_field_count = 0;
        $total_fields = count($filtered);
        $oldRecord = $model->where('user_id', $id)->first();

        for ($i = 0; $i < count($filtered); $i++) {
            if ($oldRecord[array_values($filtered)[$i]] == null) {
                $null_field_count += 1;
            }
        }

        $profile_progress = ($total_fields - $null_field_count) / $total_fields * 100;
        $profile_progress = number_format((float)$profile_progress);
        return $profile_progress;
    }
}
