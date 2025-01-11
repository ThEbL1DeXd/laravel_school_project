<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    use HasFactory; // Utilise le trait HasFactory pour les usines de modèle (factories).

    protected $table = 'answers'; // Spécifie la table associée au modèle (ici 'answers').

    protected $fillable = ['question_id', 'answer_text'];
    // Permet la masse d'assignation (mass assignment) sur les champs 'question_id' et 'answer_text'.
    // Cela signifie que ces attributs peuvent être remplis via un tableau ou une requête d'insertion.

    // Relation "une réponse appartient à une question"
    public function question()
    {
        return $this->belongsTo(question::class, 'question_id', 'id');
        // La réponse appartient à une question, où 'question_id' est la clé étrangère et 'id' est la clé primaire de la question.
    }
}
