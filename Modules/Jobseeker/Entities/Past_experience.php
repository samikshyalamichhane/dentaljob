<?php

namespace Modules\Jobseeker\Entities;

use Illuminate\Database\Eloquent\Model;


class Past_experience extends Model
{
  protected $table = 'past_experiences';
    protected $guarded = ['id', 'created_at', 'updated_at'];  
    
    public function jobseeker()
    {
      return $this->belongsTo('Modules\Jobseeker\Entities\Jobseeker', 'jobseeker_id');
    }
}
