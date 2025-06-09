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
            $table->integer('margin_score');
            $table->integer('eligible_score');
            $table->string('exam_type');
            $table->timestamps();
        });

        Schema::create('applicant_records', function (Blueprint $table) {
            $table->id();

            $table->string('applicant_sr')->nullable();
            $table->string('mesid')->nullable();
            $table->string('email')->nullable();
            $table->string('current_school')->nullable();
            $table->string('additional_data1')->nullable();
            $table->string('additional_data2')->nullable();

            $table->string('exam_type');
            $table->double('sub_1')->nullable();
            $table->double('sub_2')->nullable();
            $table->double('sub_3')->nullable();
            $table->double('sub_4')->nullable();
            $table->double('sub_5')->nullable();
            $table->double('sub_6')->nullable();
            $table->double('total_edu_marks')->default(0);

            $table->double('program_score')->default(0);

            $table->double('mental_score')->nullable();

            $table->double('essay_score')->nullable();

            $table->string('activity_type')->nullable();
            $table->string('month')->nullable();
            $table->double('activity_score')->nullable();
            $table->boolean('manual_eligible')->default(false);
            $table->timestamps();
        });

        Schema::create('single_edu_eligible_marks', function (Blueprint $table) {
            $table->id();
            $table->string('exam_type');
            $table->integer('sub_1')->default(0);
            $table->integer('sub_2')->default(0);
            $table->integer('sub_3')->default(0);
            $table->integer('sub_4')->default(0);
            $table->integer('sub_5')->default(0);
            $table->integer('sub_6')->default(0);
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
