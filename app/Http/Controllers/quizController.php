<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use App\Models\answer;
use App\Models\question;
use App\Models\quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class quizController extends Controller
{

    // Affiche la page de connexion pour les enseignants.
    public function loginTeacher()
    {
        return view('teacher.login');
    }

    // Traite les informations de connexion pour les enseignants.
    public function loginTeachertrt(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255', // Champ obligatoire, chaîne de caractères avec une longueur maximale de 255.
            'password' => 'required|string|min:4', // Champ obligatoire avec un minimum de 4 caractères.
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->remember)) {
            session(['username' => $request->username]); // Stocke le nom d'utilisateur dans la session.
            return redirect()->intended('teacher/dash'); // Redirige vers le tableau de bord enseignant.
        }

        // Si l'authentification échoue, retourne avec un message d'erreur.
        return redirect()->back()->withErrors(['message' => 'User not found. Please try again.']);
    }

    // Affiche le tableau de bord pour les enseignants avec tous les quiz.
    public function dash()
    {
        $quizes = quiz::all(); // Récupère tous les quiz.
        return view('teacher.dash', compact('quizes'));
    }

    // Affiche la page pour ajouter un nouveau quiz.
    public function addQuiz()
    {
        return view('teacher.addquiz');
    }

    // Traite les données pour ajouter un nouveau quiz.
    public function addQuiztrt(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Titre obligatoire, chaîne de 255 caractères max.
            'description' => 'required|string|max:1000', // Description obligatoire, chaîne de 1000 caractères max.
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Image optionnelle avec formats spécifiques et taille max de 2 Mo.
        ]);

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('img', 'public'); // Stocke l'image dans le dossier 'public/img'.
            $quiz = new quiz;
            $quiz['title'] = $request->title;
            $quiz['description'] = $request->description;
            $quiz['img'] = $path;
            $quiz['user-id'] = $request->username; // Associe le quiz à l'utilisateur enseignant.
            $quiz->save();

            return redirect()->intended('teacher/dash'); // Redirige vers le tableau de bord enseignant.
        }
        return back(); // Retourne à la page précédente en cas d'erreur.
    }

    // Supprime un quiz et toutes ses questions et réponses associées.
    public function dellQuiz($id)
    {
        $quiz = quiz::find($id);

        foreach ($quiz->question as $questionn) {
            foreach ($questionn->answer as $answerr) {
                $answerr->delete(); // Supprime les réponses associées.
            }
            $questionn->delete(); // Supprime les questions associées.
        }
        $quiz->delete(); // Supprime le quiz.
        return redirect()->intended('teacher/dash');
    }

    // Affiche la page pour ajouter une question à un quiz spécifique.
    public function quizquestion($id)
    {
        return view('teacher.addquestion', compact('id'));
    }

    // Traite les données pour ajouter une question à un quiz.
    public function quizquestiontrt(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000', // Question obligatoire, chaîne de 1000 caractères max.
            'correct_answer' => 'required|string|max:255', // Réponse correcte obligatoire.
            'answer' => 'required|array|min:2', // Tableau de réponses obligatoire avec au moins 2 réponses.
        ]);

        $question = new question;
        $question['question_text'] = $request->question;
        $question['correct_answer'] = $request->correct_answer;
        $question['quiz_id'] = $request->quiz_id;
        $question->save();

        foreach ($request->answer as $answer) {
            $answerModel = new answer;
            $answerModel['answer_text'] = $answer;
            $answerModel['question_id'] = $question['id'];
            $answerModel->save(); // Sauvegarde chaque réponse associée à la question.
        }

        return redirect()->intended('teacher/dash'); // Redirige vers le tableau de bord.
    }

    // Affiche toutes les questions disponibles.
    public function showquizquestion($id)
    {
        $quiz = quiz::find($id); // Récupère les questions.
        return view('teacher.showquestion', compact('quiz'));
    }

    // Déconnecte l'enseignant et vide la session.
    public function logoutTeacher()
    {
        Auth::logout(); // Déconnecte l'utilisateur.
        Session::flush(); // Vide toutes les données de session.
        return redirect()->intended('teacher/login'); // Redirige vers la page de connexion.
    }

    // Affiche la liste de tous les étudiants.
    public function students()
    {
        $students = student::all(); // Récupère tous les étudiants.
        return view('teacher.students', compact('students'));
    }

    // Affiche les détails d'un étudiant spécifique pour un quiz.
    public function quiztcheck($id)
    {
        $student = student::find($id); // Récupère un étudiant en fonction de son ID.
        return view('teacher.showstudent', compact('student'));
    }

    // Supprime un étudiant en fonction de son ID.
    public function dellstudent($id)
    {
        $student = student::find($id); // Récupère l'étudiant.
        $student->delete(); // Supprime l'étudiant.
        return redirect()->intended('teacher/students'); // Redirige vers la liste des étudiants.
    }
}
