<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("quiz_id");
            $table->string("note");
            $table->foreign("student_id")->references("id")->on("students")->onDelete('cascade');
            $table->foreign("quiz_id")->references("id")->on("quizzes");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_students');
    }
};
