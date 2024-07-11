<?php

namespace App\Models;

use App\Models\Groupe;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function groupes()
    {
        return $this->hasMany(Groupe::class);
    }
}
