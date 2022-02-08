<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Page extends Model
{
    use Sluggable;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopePublished($query)
    {
        return $query->wherePublish(1);
    }
}
