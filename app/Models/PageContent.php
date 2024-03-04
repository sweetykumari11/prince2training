<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'page_name',
        'section',
        'sub_section',
        'heading',
        'content',
        'page_tag_line',
        'image',
        'image_alt',
        'icon',
        'icon_alt',
        'created_by',
        'is_active',
        'heading_content1',
        'heading_subcontent1',
        'heading_content2',
        'heading_subcontent2',
        'heading_content3',
        'heading_subcontent3',
        'heading_content4',
        'heading_subcontent4',
    ];
    public function logActivities()
    {
        return $this->morphMany(LogActivity::class, 'module');
    }
}
