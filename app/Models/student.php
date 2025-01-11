<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory; // Utilisation du trait HasFactory pour générer des usines de modèle (factories).

    protected $table = 'students'; // Spécifie le nom de la table associée à ce modèle. Ici, la table 'students'.

    protected $fillable = ['name', 'email', 'password'];
    // Cette propriété permet de définir les attributs qui peuvent être remplis en masse (mass assignment).
    // Ces attributs peuvent être définis directement via un tableau, un formulaire ou une requête d'insertion.
    // Ici, 'name', 'email' et 'password' sont les attributs autorisés.

    public function quizzes()
    {
        // Définition de la relation de plusieurs à plusieurs avec le modèle quiz.
        // Cela permet à un étudiant d'être associé à plusieurs quiz et vice-versa.
        return $this->belongsToMany(quiz::class, 'quiz_students', 'student_id', 'quiz_id')
            ->withPivot('note'); // La table pivot 'quiz_students' contient une colonne 'note', que l'on inclut ici.
    }
}
