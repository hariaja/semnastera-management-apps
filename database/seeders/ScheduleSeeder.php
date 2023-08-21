<?php

namespace Database\Seeders;

use App\Helpers\Enum\ScheduleType;
use App\Helpers\Enum\StatusScheduleType;
use App\Helpers\Global\Seeder as HelperSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $schedules = [
      [
        'program_id' => 1,
        'type' => ScheduleType::UPLOAD->value,
        'start_date' => '2023-08-19',
        'end_date' => '2023-08-25',
        'status' => StatusScheduleType::OPEN->value,
      ],
      [
        'program_id' => 1,
        'type' => ScheduleType::SEMINAR->value,
        'start_date' => '2023-08-26',
        'end_date' => '2023-08-27',
        'status' => StatusScheduleType::CLOSE->value,
      ],
    ];

    foreach ($schedules as $schedule) {
      HelperSeeder::createSchedule(
        $schedule['program_id'],
        $schedule['type'],
        $schedule['start_date'],
        $schedule['end_date'],
        $schedule['status'],
      );
    }
  }
}
