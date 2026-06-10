<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Style extends Model
{
    use HasFactory;

    public function musiques()
    {
        return $this->belongsToMany(Musique::class, 'musique_style');
    }
}
