<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReponseDevoir extends Model
{
    use HasFactory;

    protected $table = 'reponse_devoirs';

    // Champs autorisés pour le mass-assignment
    protected $fillable = [
        'devoir_id',
        'eleve_id',
        'reponse',
        'contenu',
        'fichier',
        'envoye_par',
    ];
    public function devoir()
    {
        return $this->belongsTo(Devoir::class, 'devoir_id');
    }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id');
    }
    public function getContenuFileUrlAttribute()
    {
        if(!$this->contenu) return null;

        // Crée un fichier texte temporaire pour téléchargement
        $filename = 'reponse_'.$this->id.'.txt';
        Storage::disk('public')->put('reponses_txt/'.$filename, $this->contenu);
        return asset('storage/reponses_txt/'.$filename);
    }
    public function getFichierUrlAttribute()
    {
        return $this->fichier ? asset('storage/reponses/' . $this->fichier) : null;
    }
}
