<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Country extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'country_code',
        'description',
        'currency',
        'iso3',
        'currency',
        'currency_symbol',
        'currency_symbol_html',
        'currency_title',
        'flagimage',
        'is_active',
        'is_popular',
        'created_by'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'country_category');
    }
    public function Blog()
    {
        return $this->belongsToMany(Blog::class, 'country_blog')->withTimestamps();
    }
    public function logActivities()
    {
        return $this->morphMany(LogActivity::class, 'module');
    }
    // public function courses()
    // {
    //     return $this->belongsToMany(Course::class, 'country_courses')->withTimestamps()->withPivot(['is_popular', 'deleted_at']);
    // }
    // public function topics()
    // {
    //     return $this->belongsToMany(Topic::class, 'country_topics')->withTimestamps();
    // }
}
