<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Division;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Groupe extends Model
{
    use HasFactory;

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
