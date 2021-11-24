<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDivision extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district() {
        return $this->hasMany(ShipDistrict::class, 'division_id', 'id');
    }

    public function state() {
        return $this->hasMany(ShipState::class, 'division_id', 'id');
    }
}
