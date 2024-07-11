<?php

namespace App\Models;

use App\Models\Commune;
use App\Models\Fokontany;
use App\Models\Nationalite;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proprietaire extends Model
{
    use HasFactory;

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function fokontany()
    {
        return $this->belongsTo(Fokontany::class);
    }

    public function nationalite()
    {
        return $this->belongsTo(Nationalite::class);
    }
     public function etablissements()
    {
        return $this->belongsToMany(Etablissement::class, 'etablissement_proprietaire');
    }
}
