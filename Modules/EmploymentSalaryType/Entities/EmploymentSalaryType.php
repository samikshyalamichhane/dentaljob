<?php

namespace Modules\EmploymentSalaryType\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploymentSalaryType extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function newFactory()
    {
        return \Modules\EmploymentSalaryType\Database\factories\EmploymentSalaryTypeFactory::new();
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
