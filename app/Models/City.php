<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function trips()
    {
        return $this->belongsToMany(Trip::class)->withPivot('city_order');
    }
}
