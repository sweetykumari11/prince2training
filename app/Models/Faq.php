<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Faq extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'entity_type',
        'entity_id',
        'question',
        'answer',
        'is_active',
        'created_by',
        'created_at',
        'updated_at'
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     // create a event  on saving
    //     static::saving(function ($faq) {
    //         $faq->created_by = Auth::user()->id;
    //     });
    // }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function entity()
    {
        return $this->morphTo();
    }
    public function logActivities()
    {
        return $this->morphMany(LogActivity::class, 'module');
    }
}
