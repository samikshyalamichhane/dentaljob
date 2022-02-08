<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectToEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_settings', function (Blueprint $table) {
            $table->string('activation_email_subject')->nullable();
            $table->string('job_app_subject')->nullable();
            $table->string('job_app_reply_subject')->nullable();
            $table->text('job_app')->nullable();
            $table->text('job_app_reply')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_settings', function (Blueprint $table) {
            $table->dropColumn(['activation_email_subject','job_app_subject','job_app_reply_subject','job_app','job_app_reply']);
            
        });
    }
}

