<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

// Autorise Laravel à insérer ce champ directement à partir d'un tableau de données
#[Fillable(['nom_playlist'])]
class Playlist extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function musiques()
    {
        return $this->belongsToMany(Musique::class, 'musique_playlist');
    }
}
