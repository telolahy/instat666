<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProvinceExel extends Model
{
    use HasFactory;
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
