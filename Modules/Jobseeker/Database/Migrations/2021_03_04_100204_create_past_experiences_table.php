<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobseeker_id')->nullable()->constrained('jobseekers')->onDelete('cascade');
            $table->string('job_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('current_working')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->longText('job_description')->nullable();


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
        Schema::dropIfExists('past_experiences');
    }
}
