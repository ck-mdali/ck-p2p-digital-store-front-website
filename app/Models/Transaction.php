<?php 


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'verified_by',
        'amount_usd',
        'amount_inr',
        'payment_type_id',
        'trx_id',
        'notes',
        'status'
    ];

    // Relationship to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship to User (Payer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Admin who verified the payment
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Relationship to PaymentType (for payment method)
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
