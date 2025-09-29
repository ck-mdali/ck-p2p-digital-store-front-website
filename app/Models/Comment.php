<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Comment extends Model
{
    protected $fillable = ['product_id', 'user_id', 'content', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

 public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id')->oldest();
}


    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
