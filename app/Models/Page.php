<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'content',
        'meta_title',
        'meta_desc',
        'meta_keywords',
        'added_by',
        'views',
        'status',
        'allow_seo',
        'is_public',
        'published_at',
        'template',
        'featured_image',
    ];

    // Auto-generate slug if not set
    protected static function booted()
    {
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->name);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
