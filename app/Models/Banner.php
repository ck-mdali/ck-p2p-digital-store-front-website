<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    // If you want to specify the table name, uncomment this line
    // protected $table = 'banners'; 

    // These are the columns that can be mass-assigned
    protected $fillable = [
        'name',
        'image',
        'link',
    ];
}
