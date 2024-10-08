<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('folders', function (Blueprint $table) {
      $table->string("id");
      $table->string("parent_id")->nullable();
      $table->string("name");
      $table->timestamps();

      $table->primary("id");
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('files');
  }
};
