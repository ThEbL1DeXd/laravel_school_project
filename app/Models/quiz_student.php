<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz_student extends Model
{
    use HasFactory; // Utilisation du trait HasFactory pour générer des usines de modèle (factories).

    protected $table = 'quiz_students'; // Spécifie le nom de la table associée à ce modèle. Ici, la table 'quiz_students'.

    protected $fillable = ['id', 'student_id', 'quiz_id', 'note'];
    // Cette propriété indique les attributs qui peuvent être remplis en masse (mass assignment).
    // Ces attributs peuvent être définis directement via un tableau, un formulaire ou une requête d'insertion.
    // Ici, 'id', 'student_id', 'quiz_id' et 'note' sont les attributs autorisés.
}
