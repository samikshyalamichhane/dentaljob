<?php

namespace Modules\Title\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class Title extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
    
}
