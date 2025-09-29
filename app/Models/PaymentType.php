<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    // Table name (optional, Laravel will infer it from the model name)
    protected $table = 'payment_types';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'status',
        'description',
        'added_by',
    ];

    // Relationship to the User who added this payment type
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Relationship to the Order (if needed, this defines a reverse relation)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
