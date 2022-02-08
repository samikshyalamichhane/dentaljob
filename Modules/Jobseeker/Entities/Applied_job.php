<?php

namespace Modules\Jobseeker\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Job\Entities\Job;

class Applied_job extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function jobseeker()
    {
        return $this->belongsTo(Jobseeker::class, 'jobseeker_id');
    }
}
