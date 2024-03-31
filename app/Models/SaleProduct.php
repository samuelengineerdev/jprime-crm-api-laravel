<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'quantity', 'unit_price', 'description', 'sale_id', 'product_id', 'deleted'];

    public function mainProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
