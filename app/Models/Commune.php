<?php

namespace App\Models;

use App\Models\District;
use App\Models\Fokontany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commune extends Model
{
    use HasFactory;
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function fokontanies()
    {
        return $this->hasMany(Fokontany::class);
    }
}
