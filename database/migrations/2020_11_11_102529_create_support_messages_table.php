<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportMessagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('support_messages', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('token');
      $table->text('send_to');
      $table->longText('data');
      $table->timestamps();

      $table->foreign('token')->references('id')->on('support_lists')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('support_messages');
  }
}
