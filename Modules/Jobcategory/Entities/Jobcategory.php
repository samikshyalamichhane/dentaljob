<?php

namespace Modules\Jobcategory\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Job\Entities\Job;
use Cviebrock\EloquentSluggable\Sluggable;

class Jobcategory extends Model
{
    use Sluggable;
    protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * Get the options for generating the slug.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'jobcategory_id');
    }
    public function scopePublished($query)
    {
        return $query->wherePublish(1);
    }
}
