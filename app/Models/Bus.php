<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['kiv', 'bus_plate', 'vin', 'color', 'brand', 'mile', 'year', 'passenger', 'oil_date', 'date', 'hour', 'status_id', ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
