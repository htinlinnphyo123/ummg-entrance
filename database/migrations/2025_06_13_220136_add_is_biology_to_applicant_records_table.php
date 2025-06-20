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
        Schema::table('applicant_records', function (Blueprint $table) {
            $table->boolean('is_bio')->default(true);
        });
    }

    public function down()
    {
        Schema::table('applicant_records', function (Blueprint $table) {
            $table->dropColumn('is_bio');
        });
    }
};
