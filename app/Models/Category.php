<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Add 'image' to fillable fields
    protected $fillable = ['name', 'slug', 'description', 'added_by', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
