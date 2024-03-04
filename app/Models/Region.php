<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use SoftDeletes;

    protected $table = 'region';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'country_id',
        'created_by'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function logActivities()
    {
        return $this->morphMany(LogActivity::class, 'module');
    }
}
