<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;//

    public function artiste()
    {
        return $this->belongsTo(Artiste::class);
    }

    public function musiques()
    {
        return $this->hasMany(Musique::class);
    }
}
