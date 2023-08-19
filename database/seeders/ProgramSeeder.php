<?php

namespace Database\Seeders;

use App\Helpers\Global\Seeder as GlobalSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $programs = [
      [
        'name' => 'Seminar Nasional Teknologi dan Riset BATCH I',
        'location' => strtoupper('Politeknik Sukabumi'),
        'responsible' => 'Dewi Ayu Sofia, S. Pd., M. Eng',
      ],
      [
        'name' => 'Seminar Nasional Teknologi dan Riset BATCH II',
        'location' => null,
        'responsible' => 'Dewi Ayu Sofia, S. Pd., M. Eng',
      ],
    ];

    foreach ($programs as $program) {
      GlobalSeeder::createProgram(
        $program['name'],
        $program['location'],
        $program['responsible'],
      );
    }
  }
}
