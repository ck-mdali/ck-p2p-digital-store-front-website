<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    protected $fillable = [
        'user_id',
        'tagline',
        'about',
        'github_link',
        'website_link',
        'youtube_link',
        'instagram_link',
        'linkedin_link',
        'portfolios',
        'pricing_usd',
        'pricing_inr',
        'pricing_tagline',
        'skills',
        'address',
        'aadhaar_card',
        'pan_card',
        'verified_badge',
        'status',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional helper
    public function getPortfolioLinksAttribute()
    {
        return array_filter(explode(',', $this->portfolios));
    }
}
