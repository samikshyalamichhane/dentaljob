<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Employer\Entities\Employer;
use Modules\Jobseeker\Entities\Jobseeker;
use Modules\Title\Entities\Title;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employer()
    {
        return $this->hasOne(Employer::class, 'user_id');
    }

    public function title()
    {
        return $this->belongsTo(Title::class, 'user_id');
    } 

    public function jobseeker()
    {
        return $this->hasOne(Jobseeker::class, 'user_id');
    }
}
