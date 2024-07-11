<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fokontany extends Model
{
    use HasFactory;
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
}
