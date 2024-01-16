<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'description', 'unit_price', 'stock_quantity',  'category_id', 'status_id', 'user_id', 'deleted'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}

