<?php

use App\Helpers\Enum\ScheduleType;
use App\Helpers\Enum\StatusScheduleType;
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
    Schema::create('schedules', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('program_id')->constrained('programs', 'id')->onDelete('cascade');
      $table->enum('type', ScheduleType::toArray());
      $table->date('start_date');
      $table->date('end_date');
      $table->enum('status', StatusScheduleType::toArray())->default(StatusScheduleType::CLOSE->value);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('schedules');
  }
};
