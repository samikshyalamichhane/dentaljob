<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
