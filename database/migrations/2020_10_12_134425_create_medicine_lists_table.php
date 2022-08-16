<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->text('image');
            $table->longText('gallery')->nullable()->default(null);
            $table->longText('description')->nullable()->default(null);
            $table->longText('sostav')->nullable()->default(null);
            $table->longText('doz')->nullable()->default(null);
            $table->longText('protiv')->nullable()->default(null);
            $table->longText('manufacter')->nullable()->default(null);
            $table->longText('manufacter_address')->nullable()->default(null);
            $table->longText('manufacter_phone')->nullable()->default(null);
            $table->longText('diseases')->nullable()->default(null);
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
        Schema::dropIfExists('medicine_lists');
    }
}
