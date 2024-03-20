<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientEmployeeAccount extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'address', 'notes', 'client_account_id'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
