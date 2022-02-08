<?php

namespace Modules\Job\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Employer\Entities\Employer;
use Modules\Jobseeker\Entities\Applied_job;
use Modules\Jobseeker\Entities\Jobseeker;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Job extends Model
{
    use Sluggable;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['published_date', 'deadline_date', 'start_date'];


    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => ['job_title']
    //         ],
    //         'town_city' => [
    //             'source' => ['town_city']
    //         ]
    //     ];
    // }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'job_title'
            ]
        ];
    }

    public function setTownCityAttribute($value)
    {
        $this->attributes['town_city'] = Str::slug($value, '-');
    }

    // public function getTownCityAttribute()
    // {
    //     $town_city = str_replace("-", " ", $this->town_city);
    //     return $town_city;
    // }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function employementSalaryType()
    {
        return $this->belongsTo('Modules\EmploymentSalaryType\Entities\EmploymentSalaryType', 'type_of_employment');
    }
    public function jobseekers()
    {
        return $this->belongsToMany('Modules\Jobseeker\Entities\Jobseeker', 'applied_jobs', 'jobseeker_id', 'job_id');
    }
    public function jobcategory()
    {
        return $this->belongsTo('Modules\Jobcategory\Entities\Jobcategory');
    }
    public function applications()
    {
        return $this->hasMany(Applied_job::class, 'job_id');
    }
    public function scopePublished($query)
    {
        return $query->wherePublish(1);
    }
    public function scopeOpen($query)
    {
        return $query->whereJob_status('open');
    }
    public function scopeClosed($query)
    {
        return $query->whereJob_status('closed');
    }
    public function scopePaused($query)
    {
        return $query->whereJob_status('paused');
    }
}
