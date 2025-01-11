<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    use HasFactory; // Utilise le trait HasFactory pour les usines de modèle (factories).

    protected $table = 'quizzes'; // Spécifie la table associée au modèle (ici 'quizzes').

    protected $fillable = ['title', 'description', 'img', 'user-id'];
    // Permet la masse d'assignation (mass assignment) sur les champs 'title', 'description', 'img', et 'user-id'.
    // Cela signifie que ces attributs peuvent être remplis via un tableau ou une requête d'insertion.

    // Relation "un quiz appartient à un utilisateur" (probablement un enseignant ou administrateur).
    public function User()
    {
        return $this->belongsTo(User::class);
        // Le quiz appartient à un utilisateur. La clé étrangère 'user_id' est utilisée dans la table 'quizzes' pour faire la relation avec la table 'users'.
    }

    // Relation "un quiz a plusieurs questions"
    public function question()
    {
        return $this->hasMany(question::class, 'quiz_id', 'id');
        // Un quiz peut avoir plusieurs questions. La clé étrangère dans la table 'questions' est 'quiz_id'.
    }

    // Relation "un quiz appartient à plusieurs étudiants" via la table pivot 'quiz_students'
    public function student()
    {
        return $this->belongsToMany(student::class, 'quiz_students')
            ->withPivot('note') // Permet d'ajouter des colonnes supplémentaires dans la table pivot, ici 'note' (note de l'étudiant pour ce quiz).
            ->withTimestamps(); // Ajoute les champs 'created_at' et 'updated_at' dans la table pivot.
    }

    // Relation "un quiz appartient à plusieurs étudiants" via la table pivot 'quiz_students'
    public function students()
    {
        return $this->belongsToMany(student::class, 'quiz_students','quiz_id','student_id')
            ->withPivot('note'); // Permet d'ajouter la colonne 'note' dans la table pivot pour chaque relation entre un quiz et un étudiant.
    }
}
