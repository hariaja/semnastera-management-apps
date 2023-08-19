<?php

namespace Database\Seeders;

use App\Helpers\Enum\GenderType;
use App\Helpers\Enum\RoleType;
use App\Helpers\Global\Seeder as HelperSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParticipantSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = [
      [
        'name' => 'Sarah Ardhelia',
        'email' => 'sarah@gmail.com',
        'phone' => '085659466622',
        'gender' => GenderType::FEMALE->value,
        'institution' => 'Politeknik Sukabumi',
        'address' => 'Jl. Perintis Kemerdekaan No. 130 Kec. Cibadak, Kab. Sukabumi, Prov. Jawa Barat 43351 Indonesia',
        'role' => RoleType::PEMAKALAH->value
      ],
      [
        'name' => 'Sari Novitasari',
        'email' => 'sari@gmail.com',
        'phone' => '085659466600',
        'gender' => GenderType::FEMALE->value,
        'institution' => 'Politeknik Sukabumi',
        'address' => '176, Jalan Selabintana No. 176, Warnasari, Sukamekar, Prov. Jawa Barat, Sukabumi, 43114',
        'role' => RoleType::PEMAKALAH->value,
      ],
      [
        'name' => 'Andika Pratama',
        'email' => 'andika@gmail.com',
        'phone' => '085659466677',
        'gender' => GenderType::MALE->value,
        'institution' => 'Politeknik Sukabumi',
        'address' => 'Jl. Perintis Kemerdekaan No. 130 Kec. Cibadak, Kab. Sukabumi, Prov. Jawa Barat 43351 Indonesia',
        'role' => RoleType::PARTICIPANT->value,
      ]
    ];

    foreach ($users as $user) {
      HelperSeeder::createUserAndParticipant(
        $user['name'],
        $user['email'],
        $user['phone'],
        $user['gender'],
        $user['institution'],
        $user['address'],
        $user['role']
      );
    }
  }
}
