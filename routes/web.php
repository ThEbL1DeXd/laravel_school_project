<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\quizController;
use App\Http\Controllers\studentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| C'est ici que vous pouvez enregistrer les routes web pour votre application.
| Ces routes sont chargées par le RouteServiceProvider dans un groupe contenant
| le middleware "web". Créez quelque chose de génial !
|
*/

Route::get('/', function () {
    // Vider toutes les données de la session et afficher la vue d'accueil (index).
    session()->flush();
    return view('index');
});

// Routes pour la gestion des étudiants
Route::get('/login', [studentController::class, 'loginStudent']);
// Affiche la page de connexion pour les étudiants.

Route::post('/login', [studentController::class, 'loginStudenttrt']);
// Traite les données de connexion des étudiants.

Route::get('/signin', [studentController::class, 'signinStudent']);
// Affiche la page d'inscription pour les étudiants.

Route::post('/signin', [studentController::class, 'signinStrudenttrt']);
// Traite les données d'inscription des étudiants.

Route::get('/quizes', [studentController::class, 'quizesHome'])->middleware('student');
// Affiche la liste des quiz pour les étudiants connectés (protégé par le middleware "student").

Route::get('/quiz/take/{id}', [studentController::class, 'quiztake'])->middleware('student');
// Affiche un quiz spécifique que l'étudiant souhaite passer.

Route::post('/quiz/take', [studentController::class, 'quiztaketrt'])->middleware('student');
// Traite les réponses du quiz soumis par l'étudiant.

Route::get('/quiz/check', [studentController::class, 'quiztcheck'])->middleware('student');
// Affiche les résultats du quiz pour un étudiant.

// Routes pour la gestion des enseignants
Route::get('/teacher/login', [quizController::class, 'loginTeacher']);
// Affiche la page de connexion pour les enseignants.

Route::post('/teacher/login', [quizController::class, 'loginTeachertrt']);
// Traite les données de connexion des enseignants.

Route::get('/teacher/dash', [quizController::class, 'dash'])->middleware('teacher');
// Affiche le tableau de bord des enseignants (protégé par le middleware "teacher").

Route::get('/teacher/quiz/add', [quizController::class, 'addQuiz'])->middleware('teacher');
// Affiche la page pour ajouter un nouveau quiz.

Route::post('/teacher/quiz/add', [quizController::class, 'addQuiztrt'])->middleware('teacher');
// Traite les données pour ajouter un nouveau quiz.

Route::post('/teacher/quiz/dell/{id}', [quizController::class, 'dellQuiz'])->middleware('teacher');
// Supprime un quiz spécifique en fonction de son ID.

Route::get('/teacher/quiz/question/{id}', [quizController::class, 'quizquestion'])->middleware('teacher');
// Affiche la page pour ajouter des questions à un quiz spécifique.

Route::post('/teacher/quiz/question', [quizController::class, 'quizquestiontrt'])->middleware('teacher');
// Traite les données pour ajouter des questions à un quiz.

Route::get('/teacher/quiz/question/show/{id}', [quizController::class, 'showquizquestion'])->middleware('teacher');
// Affiche les questions d'un quiz spécifique.

Route::get('/teacher/logout', [quizController::class, 'logoutTeacher'])->middleware('teacher');
// Déconnecte l'enseignant et termine la session.

Route::get('/teacher/students/show/{id}', [quizController::class, 'quiztcheck'])->middleware('teacher');
// Affiche les résultats d'un étudiant spécifique pour un quiz.

Route::get('/teacher/students', [quizController::class, 'students'])->middleware('teacher');
// Affiche la liste des étudiants pour un enseignant.

Route::post('/teacher/students/dell/{id}', [quizController::class, 'dellstudent'])->middleware('teacher');
// Supprime un étudiant spécifique en fonction de son ID.
