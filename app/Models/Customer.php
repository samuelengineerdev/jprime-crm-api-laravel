<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'full_name', 'email', 'phone', 'address', 'country', 'city', 'state', 'postal_code', 'registration_date', 'last_purchase_date', 'total_purchases', 'loyalty_points', 'notes', 'status_id', 'deleted', 'client_user_id'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
