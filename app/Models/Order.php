<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'product_id',
        'status',
        'amount_usd',
        'amount_inr',
        'payment_type_id',
        'notes',
    ];

    // Relationship to the User who placed the order
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the Product being purchased
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship to the PaymentType (i.e., payment method used)
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    // Optional: You can create an accessor to format the price
    public function getFormattedAmountUsdAttribute()
    {
        return '$' . number_format($this->amount_usd, 2);
    }

    public function getFormattedAmountInrAttribute()
    {
        return '₹' . number_format($this->amount_inr, 2);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
