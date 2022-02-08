<?php

namespace Modules\Jobseeker\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Job\Entities\Job;

class Jobseeker extends Model
{
  protected $guarded = ['id', 'created_at', 'updated_at'];
  public function documents()
  {
    return $this->hasMany('Modules\Jobseeker\Entities\Additional_document', 'jobseeker_id');
  }

  public function experiences()
  {
    return $this->hasMany('Modules\Jobseeker\Entities\Past_experience', 'jobseeker_id');
  }

  public function jobs()
  {
    return $this->belongsToMany(Job::class, 'applied_jobs', 'jobseeker_id', 'job_id');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
