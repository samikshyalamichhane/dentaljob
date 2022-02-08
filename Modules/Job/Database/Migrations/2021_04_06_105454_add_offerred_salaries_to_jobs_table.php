<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfferredSalariesToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->enum('offerred_salary_type', ['range', 'fixed', 'negotiable'])->nullable();
            $table->enum('currencies', ['euro', 'american_dollar', 'pound'])->nullable();
            $table->string('minimum_salary')->nullable();
            $table->string('maximum_salary')->nullable();
            $table->string('fixed_salary')->nullable();
            $table->enum('time_period', ['annually', 'monthly', 'weekly', 'hourly', 'contract'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // $table->enum('offerred_salary_type', ['range', 'fixed', 'negotiable'])->nullable();
            // $table->enum('currencies', ['euro', 'american_dollar', 'pound'])->nullable();
            // $table->string('minimum_salary')->nullable();
            // $table->string('maximum_salary')->nullable();
            // $table->string('fixed_salary')->nullable();
            // $table->enum('time_period', ['annually', 'monthly', 'weekly', 'hourly', 'contract'])->nullable();

            $table->dropColumn([
                'offerred_salary_type',
                'currencies',
                'minimum_salary',
                'maximum_salary',
                'fixed_salary',
                'time_period',
            ]);
        });
    }
}
