<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Utilise la table personnalisée
    protected $table = 'utilisateur';

    // Pas de timestamps dans ta table
    public $timestamps = false;

    // Champs modifiables
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role_id',
        'photo_profil',
        'telephone',
        'entreprise',
    ];

    // Pour que Laravel Auth utilise le bon champ mot de passe
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}
