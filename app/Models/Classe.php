<?php

namespace App\Models;

use App\Models\Groupe;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }
}
