<?php

namespace App\Http\Controllers;

use App\Models\quiz_student;
use Illuminate\Http\Request;
use App\Models\quiz;
use App\Models\student;
use Illuminate\Support\Facades\Hash;

class studentController extends Controller
{

    // Affiche la page de connexion pour les étudiants.
    public function loginStudent()
    {
        return view('student.login');
    }

    // Affiche la page d'inscription pour les étudiants.
    public function signinStudent()
    {
        return view('student.signin');
    }

    // Traite les données pour inscrire un étudiant.
    public function signinStrudenttrt(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Nom obligatoire, chaîne de 255 caractères max.
            'email' => 'required|string|email|max:255|unique:students,email', // Email obligatoire, unique dans la table `students`.
            'password' => 'required|string|min:8', // Mot de passe obligatoire, minimum 8 caractères.
        ]);

        $student = new student;
        $student['name'] = $request->name;
        $student['email'] = $request->email;
        $student['password'] = Hash::make($request->password); // Hashage du mot de passe.
        $student->save(); // Enregistre l'étudiant dans la base de données.
        return redirect()->intended('/login'); // Redirige vers la page de connexion.
    }

    // Traite les données pour connecter un étudiant.
    public function loginStudenttrt(Request $request)
    {
        $student = student::where('email', $request->email)->first(); // Cherche un étudiant par email.
        if ($student) {
            if (Hash::check($request->password, $student->password)) { // Vérifie si le mot de passe est correct.
                session(['id' => $student->id]); // Enregistre l'ID de l'étudiant dans la session.
                return redirect()->intended('quizes'); // Redirige vers la page des quiz.
            }
        }
        // Retourne un message d'erreur si l'étudiant n'est pas trouvé ou si le mot de passe est incorrect.
        return redirect()->intended('login')->withErrors(['message' => 'User not found. Please try again.']);
    }

    // Affiche la page d'accueil des quiz pour les étudiants.
    public function quizesHome()
    {
        $quizes = quiz::all(); // Récupère tous les quiz disponibles.
        return view('student.home', compact('quizes'));
    }

    // Affiche la page pour passer un quiz spécifique.
    public function quiztake($id)
    {
        $quiz = quiz::find($id); // Trouve le quiz par son ID.
        return view('student.take_quiz', compact('quiz'));
    }

    // Traite les réponses d'un étudiant après avoir passé un quiz.
    public function quiztaketrt(Request $request)
    {
        $quiz = quiz::find($request->quiz_id); // Récupère le quiz correspondant.
        $nbrques = 0; // Compteur pour le nombre de réponses correctes.

        // Parcourt les questions du quiz.
        foreach ($quiz->question as $ques) {
            foreach ($request->question_id as $ques_id) {
                if ($ques_id == $ques['id']) {
                    // Vérifie si la réponse donnée correspond à la réponse correcte.
                    if ($ques["correct_answer"] == $request->input("answer$ques_id")) {
                        $nbrques++;
                    }
                }
            }
        }

        // Vérifie si une note pour ce quiz a déjà été enregistrée pour cet étudiant.
        $serch = quiz_student::where("quiz_id", $request->quiz_id)->where("student_id", (int)Session("id"))->first();

        if (count($serch) > 0) {
            // Met à jour la note existante si elle est déjà enregistrée.
            $quiz_student = quiz_student::find($serch->id);
            $quiz_student->note = $nbrques . "/" . $quiz->question->count();
            $quiz_student->save();
        } else {
            // Crée un nouvel enregistrement pour la note.
            $res = new quiz_student;
            $res["quiz_id"] = $request->quiz_id;
            $res["student_id"] = (int)Session("id");
            $res["note"] = $nbrques . "/" . $quiz->question->count();
            $res->save();
        }

        return view('student.result', compact('quiz')); // Affiche les résultats du quiz.
    }

    // Affiche les résultats et notes des quiz d'un étudiant.
    public function quiztcheck()
    {
        $student = student::find(session("id")); // Récupère l'étudiant connecté.
        return view('student.check', compact('student'));
    }
}
