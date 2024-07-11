<?php

namespace App\Models;

use App\Models\Region;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
}
