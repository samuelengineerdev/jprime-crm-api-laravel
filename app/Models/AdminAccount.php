<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAccount extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'phone'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

}
