<?php

namespace Modules\EmailSetting\Entities;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
