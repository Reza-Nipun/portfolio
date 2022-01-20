<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('company_name');
            $table->string('company_logo');
            $table->string('company_website')->nullable();
            $table->string('company_address')->nullable();
            $table->text('company_contact_info')->nullable();
            $table->string('designation');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('is_continuing')->comment('0=No, 1=Yes');
            $table->integer('type')->comment('0=Full-Time, 1=Part-Time, 3=Contructual');
            $table->longtext('job_description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
