<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'email','phone', 'address', 'country','city', 'company_name','company_address', 'type_of_service', 'category_of_products','notes', 'deleted', 'user_id'];
}
