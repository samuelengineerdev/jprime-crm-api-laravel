<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAccount extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'residential_address', 'company_name', 'company_address', 'type_of_company', 'notes'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
