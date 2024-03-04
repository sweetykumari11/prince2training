<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $table = 'locations';
    protected $fillable = [
        'name',
        'country_id',
        'region_id',
        'address',
        'slug',
        'phone',
        'intro',
        'image',
        'latitude',
        'longitude',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_popular',
        'created_by',
    ];

    /**
     * Get the creator of the location.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the region of the location.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the country of the location.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function slugs()
    {
        return $this->morphOne(Slug::class, 'entity');
    }
    public function logActivities()
    {
        return $this->morphMany(LogActivity::class, 'module');
    }

}
