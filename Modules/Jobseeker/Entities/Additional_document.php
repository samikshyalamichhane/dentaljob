<?php

namespace Modules\Jobseeker\Entities;

use Illuminate\Database\Eloquent\Model;


class Additional_document extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];   

    public function jobseeker()
    {
      return $this->belongsTo('Modules\Jobseeker\Entities\Jobseeker', 'jobseeker_id');
    }
}

