<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory; // Utilise le trait HasFactory pour les usines de modèle (factories).

    protected $table = 'questions'; // Spécifie la table associée au modèle (ici 'questions').

    protected $fillable = ['question_text', 'correct_answer', 'quiz_id'];
    // Permet la masse d'assignation (mass assignment) sur les champs 'question_text', 'correct_answer', et 'quiz_id'.
    // Cela signifie que ces attributs peuvent être remplis via un tableau ou une requête d'insertion.

    // Relation "une question appartient à un quiz"
    public function quiz()
    {
        return $this->belongsTo(quiz::class, 'quiz_id', 'id');
        // La question appartient à un quiz, où 'quiz_id' est la clé étrangère et 'id' est la clé primaire du quiz.
    }

    // Relation "une question a plusieurs réponses"
    public function answer()
    {
        return $this->hasMany(answer::class, 'question_id', 'id');
        // Une question peut avoir plusieurs réponses. La clé étrangère dans la table 'answers' est 'question_id'.
    }
}
