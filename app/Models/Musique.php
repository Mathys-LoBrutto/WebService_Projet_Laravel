<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Musique extends Model
{
    use HasFactory;

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function styles()
    {
        return $this->belongsToMany(Style::class, 'musique_style');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'musique_playlist');
    }

    public function acheteurs()
    {
        return $this->belongsToMany(User::class, 'facturer')
                    ->withPivot('dateFacturation', 'prixFacturation')
                    ->withTimestamps();
    }
}
