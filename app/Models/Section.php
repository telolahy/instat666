<?php

namespace App\Models;

use App\Models\Division;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
