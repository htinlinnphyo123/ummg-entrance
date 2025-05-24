<?php

use App\Enums\ExamType;
use App\Enums\ActivityType;
use App\Enums\EligibleType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_eligible_score', function (Blueprint $table) {
            $table->id();
            $table->integer('total_marks');
            $table->decimal('total_score', 5, 2);
            $table->string('exam_type');
            $table->timestamps();
        });

        Schema::create('applicant_records', function (Blueprint $table) {
            $table->id();

            $table->string('application_sr');
            $table->string('mesid');
            $table->string('email');
            $table->string('current_school');
            $table->string('additional_data1')->nullable();
            $table->string('additional_data2')->nullable();
            $table->string('exam_type');
            $table->integer('sub_1')->default(0);
            $table->integer('sub_2')->default(0);
            $table->integer('sub_3')->default(0);
            $table->integer('sub_4')->default(0);
            $table->integer('sub_5')->default(0);
            $table->integer('sub_6')->default(0);
            $table->integer('total_edu_marks')->default(0);
            $table->integer('education_score')->default(0);
            $table->integer('program_score')->default(0);
            $table->integer('mental_score')->default(0);
            $table->integer('essay_score')->default(0);
            $table->integer('activity_score')->default(0);
            $table->timestamps();
        });

        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id');
            $table->boolean('question_1')->default(false);
            $table->boolean('question_2')->default(false);
            $table->boolean('question_3')->default(false);
            $table->boolean('question_4')->default(false);
            $table->boolean('question_5')->default(false);
            $table->unsignedSmallInteger('total_score');
            $table->timestamps();

            $table->foreign('record_id')->references('id')->on('applicant_records')->onDelete('cascade');
        });

        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id');
            $table->string('activity_type');
            $table->string('month');
            $table->boolean('is_approved')->default(false);
            $table->string('total_score');
            $table->timestamps();

            $table->foreign('record_id')->references('id')->on('applicant_records')->onDelete('cascade');
        });

        Schema::create('single_edu_eligible_marks', function (Blueprint $table) {
            $table->id();
            $table->string('exam_type');
            $table->integer('sub_1');
            $table->integer('sub_2');
            $table->integer('sub_3');
            $table->integer('sub_4');
            $table->integer('sub_5');
            $table->integer('sub_6');
            $table->timestamps();
        });

        Schema::create('minimum_eligible_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('min_education');
            $table->integer('min_program');
            $table->integer('min_activity');
            $table->integer('min_essay');
            $table->integer('min_mental');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('minimum_eligible_scores');
        Schema::dropIfExists('single_edu_eligible_marks');
        Schema::dropIfExists('activity');
        Schema::dropIfExists('program');
        Schema::dropIfExists('applicant_records');
        Schema::dropIfExists('education_eligible_score');
        Schema::dropIfExists('applicants');
    }
};
