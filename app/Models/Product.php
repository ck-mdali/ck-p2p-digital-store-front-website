<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description_lt',
        'screenshots',
        'youtube_url',
        'price_usd',
        'price_inr',
        'category_id',
        'added_by',
        'demo_url',
        'tech_support',
        'custom_mods',
        'license',
        'keywords'
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];

    // Auto-generate slug from name if not set
    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

     public function orders()
    {
        return $this->hasMany(Order::class);
    }
 
     // Assuming you have a 'download_path' column storing the relative file path
    public function getDownloadPathAttribute($value)
    {
        // The file is stored in the storage/app/private_files directory
        return storage_path('app/private/' . $value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }


}
