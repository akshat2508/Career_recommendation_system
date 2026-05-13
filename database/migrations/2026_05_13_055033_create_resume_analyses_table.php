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

    Schema::create('resume_analyses', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');

        $table->string('resume_path');

        $table->longText('resume_text')->nullable();

        $table->integer('ats_score')->default(0);

        $table->json('detected_skills')->nullable();

        $table->json('missing_skills')->nullable();

        $table->json('career_matches')->nullable();

        $table->json('strengths')->nullable();

        $table->json('weaknesses')->nullable();

        $table->longText('ai_analysis')->nullable();

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
        Schema::dropIfExists('resume_analyses');
    }
};
