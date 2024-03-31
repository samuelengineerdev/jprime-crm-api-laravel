<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'date', 'notes', 'expiration_date', 'next_payment_date', 'discount', 'tax', 'total', 'payment_method_id', 'payment_type_id','status_id', 'customer_id', 'client_user_id', 'deleted'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
