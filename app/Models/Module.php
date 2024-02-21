<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission;

class Module extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'module';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'is_active'
    ];
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id');
    }

}
