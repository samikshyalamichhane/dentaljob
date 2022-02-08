<?php

namespace Modules\Employer\Entities;

use App\Models\User;
use Modules\Job\Entities\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'employer');
    }


    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function opened_jobs()
    {
        return $this->hasMany(Job::class)->where('job_status', 'open');
    }

    public function paused_jobs()
    {
        return $this->hasMany(Job::class)->where('job_status', 'paused');
    }

    public function closed_jobs()
    {
        return $this->hasMany(Job::class)->where('job_status', 'closed');
    }

    // public function applications()
    // {
    //     return $this->hasMany(Application::class, 'employer_id');
    // }
}
