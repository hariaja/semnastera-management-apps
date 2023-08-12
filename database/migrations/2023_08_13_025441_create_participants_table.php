<?php

use App\Helpers\Enum\GenderType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('participants', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
      $table->string('first_name');
      $table->string('last_name');
      $table->string('first_title')->nullable();
      $table->string('last_title')->nullable();
      $table->enum('gender', GenderType::toArray());
      $table->string('institution');
      $table->longText('address');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('participants');
  }
};
