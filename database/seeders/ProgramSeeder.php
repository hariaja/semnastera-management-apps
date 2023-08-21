<?php

namespace Database\Seeders;

use App\Helpers\Global\Seeder as HelperSeeder;
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
        'name' => 'Semnastera XI',
        'location' => 'Aula Politeknik Sukabumi',
        'responsible' => 'Dewi Ayu Sofia, S. Pd., M. Eng',
      ],
      [
        'name' => 'Semnastera XII',
        'location' => 'Aula Politeknik Sukabumi',
        'responsible' => 'Dewi Ayu Sofia, S. Pd., M. Eng',
      ],
      [
        'name' => 'Semnastera XIII',
        'location' => 'Aula Politeknik Sukabumi',
        'responsible' => 'Dewi Ayu Sofia, S. Pd., M. Eng',
      ],
    ];

    foreach ($programs as $program) {
      HelperSeeder::createProgram(
        $program['name'],
        $program['location'],
        $program['responsible'],
      );
    }
  }
}
