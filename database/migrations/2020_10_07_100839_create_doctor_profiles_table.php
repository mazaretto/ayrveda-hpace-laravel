<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('photo')->nullable();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('patronymic');
            $table->date('birth')->nullable();
            $table->string('gender')->nullable();
            $table->longText('biography')->nullable();
            $table->text('clinic_address')->nullable();
            $table->text('clinic_name')->nullable();
            $table->text('clinic_pics')->nullable();
            $table->text('zip_code')->nullable();
            $table->text('country')->nullable();
            $table->text('state')->nullable();
            $table->text('city')->nullable();
            $table->longText('address')->nullable();
            $table->text('price')->nullable();
            $table->longText('services')->nullable();
            $table->longText('specialist')->nullable();
            $table->longText('education')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('awards')->nullable();
            $table->longText('membership')->nullable();
            $table->longText('registrations')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_profiles');
    }
}
