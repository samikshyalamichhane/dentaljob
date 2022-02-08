<?php

namespace Modules\Front\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Jobseeker\Entities\Jobseeker;
use Modules\Jobseeker\Entities\Past_experience;
use Modules\Jobseeker\Entities\Additional_document;
use Auth;
use Illuminate\Support\Facades\DB;

class Profile extends Model
{


    protected $fillable = [];
}
