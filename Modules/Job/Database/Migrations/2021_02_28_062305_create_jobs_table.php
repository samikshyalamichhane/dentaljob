<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('employer_id');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');

            $table->unsignedBigInteger('jobcategory_id');
            $table->foreign('jobcategory_id')->references('id')->on('jobcategories')->onDelete('cascade');

            $table->string('employer_name')->nullable();
            $table->string('location')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_phrase')->nullable();
            $table->text('keyword')->nullable();

            // job infos
            $table->string('job_title')->nullable();
            $table->string('slug')->nullable();
            $table->string('country')->nullable();
            $table->string('town_city')->nullable();
            $table->string('street_address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('number_of_vacancy')->nullable();
            $table->string('type_of_employment')->nullable();
            $table->string('employmentType')->nullable();
            $table->string('salary')->nullable()->comment('this is salary range');
            $table->string('job_type')->nullable()->comment('part-time | full-time');
            $table->string('working_hours')->nullable();
            $table->string('part_time_working_hours')->nullable();
            $table->string('published_date')->nullable();
            $table->string('deadline_date')->nullable();
            $table->string('job_reference_id')->nullable();

            // job descriptions
            $table->longText('job_description')->nullable();
            $table->longText('job_requirements')->nullable();
            $table->longText('job_duties')->nullable();
            $table->longText('benefits')->nullable();
            $table->longText('schedule')->nullable();
            $table->longText('covid_19_instructions')->nullable();
            $table->string('application_receive')->nullable();
            $table->enum('resume_receive', ['yes', 'no'])->nullable();
            $table->enum('job_status', ['open', 'paused', 'closed'])->nullable();
            $table->tinyInteger('publish')->default(1)->nullable();
            $table->tinyInteger('show_in_home')->default(0)->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
