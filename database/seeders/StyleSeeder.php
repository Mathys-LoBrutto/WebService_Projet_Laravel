<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Style;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //liste de styles exostive
        $styles = [
    'Acid house', 'Acid jazz', 'Acid techno', 'Afrobeats', 'Afrohouse', 
    'Alternative country', 'Amapiano', 'Ambient', 'Anti-folk', 'Avant-garde', 
    'Bachata', 'Bebop', 'Black metal', 'Bluegrass traditionnel', 'Blues rock', 
    'Boogie-woogie', 'Boom bap', 'Bossa nova', 'Britpop', 'C-Pop', 
    'Calypso', 'Chanson française', 'Chicago blues', 'Chicago Drill', 'Chiptune (8-bit)', 
    'Cloud rap', 'Conscious hip-hop', 'Cool jazz', 'Cumbia', 'Dancehall', 
    'Death metal', 'Deep house', 'Delta blues', 'Detroit techno', 'Dixieland (New Orleans jazz)', 
    'Doom metal', 'Dream pop', 'Drill', 'Drone', 'Drum and Bass', 
    'Dub', 'Dubstep', 'East Coast rap', 'Electro house', 'Electropop', 
    'Emo', 'Emo rap', 'Enka', 'Eurodance', 'Fado', 
    'Flamenco', 'Folk rock', 'Free jazz', 'French Touch', 'Funk', 
    'G-Funk', 'Gabber', 'Garage rock', 'Goa trance', 'Gospel contemporain', 
    'Gospel traditionnel', 'Grime', 'Grunge', 'Gypsy jazz (Jazz manouche)', 'Hard bop', 
    'Hard rock', 'Hard trance', 'Hardcore punk', 'Hardstyle', 'Hardtechno', 
    'Heavy metal traditionnel', 'Highlife', 'Honky tonk', 'IDM (Intelligent Dance Music)', 'Indie folk', 
    'Indie pop', 'Indie rock', 'Italo-disco', 'J-Pop', 'J-Rock', 
    'Jazz fusion', 'Jazz rap', 'Jungle', 'K-Pop', 'Klezmer', 
    'Lo-fi Hip Hop', 'Mariachi', 'Math rock', 'Mbalax', 'Merengue', 
    'Metalcore', 'Mumble rap', 'Musique baroque', 'Musique carnatique', 'Musique celtique', 
    'Musique classique (période)', 'Musique concrète', 'Musique contemporaine', 'Musique de film (OST)', 'Musique hindoustanie', 
    'Musique médiévale', 'Musique minimaliste', 'Musique Renaissance', 'Musique romantique', 'Neo-soul', 
    'Nouvelle scène française', 'Nu metal', 'Nu-disco', 'NY Drill', 'Opéra', 
    'Opérette', 'Outlaw country', 'P-Funk', 'Polka', 'Pop classique', 
    'Pop country', 'Pop-punk', 'Post-punk', 'Post-rock', 'Progressive bluegrass', 
    'Progressive house', 'Psychedelic rock', 'Psytrance', 'Punk rock', 'R&B classique (Rhythm and blues)', 
    'R&B contemporain', 'Raï', 'Ranchera', 'Rap rock', 'Reggae', 
    'Reggaeton', 'Retrowave', 'Rock \'n\' roll', 'Salsa', 'Samba', 
    'Shoegaze', 'Ska', 'Ska-punk', 'Skate punk', 'Soca', 
    'Soul classique', 'Soukous', 'Swing', 'Symphonic metal', 'Synth-pop', 
    'Synthwave', 'Tango', 'Tech house', 'Techno minimale', 'Thrash metal', 
    'Traditional folk', 'Trap (EDM)', 'Trap (Hip-Hop)', 'Trip-hop', 'Tropical house', 
    'UK Drill', 'UK Garage', 'Uplifting trance', 'Vaporwave', 'West Coast rap', 
    'Zouk'
];

    foreach($styles as $style){
        Style::create([
            'libelle_style' => $style,
        ]);
    }
}
}
