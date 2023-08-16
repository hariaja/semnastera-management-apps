<?php

namespace Database\Seeders;

use App\Helpers\Enum\GenderType;
use App\Helpers\Enum\RoleType;
use App\Helpers\Enum\StatusUserType;
use App\Helpers\Global\Helper;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParticipantSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    function createUserAndParticipant($name, $email, $phone, $gender, $institution, $address, $role)
    {
      $user = User::create([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'email_verified_at' => now(),
        'password' => bcrypt(Helper::DEFAULT_PASSWORD),
        'status' => StatusUserType::ACTIVE->value,
      ])->assignRole($role);

      Participant::create([
        'user_id' => $user->id,
        'first_name' => explode(' ', $name)[0],
        'last_name' => explode(' ', $name)[1],
        'gender' => $gender,
        'institution' => strtoupper($institution),
        'address' => $address,
      ]);

      return $user;
    }

    createUserAndParticipant(
      'Sarah Ardhelia',
      'sarah@gmail.com',
      '085659466622',
      GenderType::FEMALE->value,
      'Politeknik Sukabumi',
      'Jl. Perintis Kemerdekaan No. 130 Kec. Cibadak, Kab. Sukabumi, Jawa Barat Indonesia 43351',
      RoleType::PEMAKALAH->value
    );

    createUserAndParticipant(
      'Sari Novitasari',
      'sari@gmail.com',
      '085659466600',
      GenderType::FEMALE->value,
      'Politeknik Sukabumi',
      '176, Jalan Selabintana No. 176, Warnasari, Sukamekar, Jawa Barat, Sukabumi, 43114',
      RoleType::PEMAKALAH->value
    );

    createUserAndParticipant(
      'Andika Pratama',
      'andika@gmail.com',
      '085659466677',
      GenderType::MALE->value,
      'Politeknik Sukabumi',
      '176, Jalan Selabintana No. 176, Warnasari, Sukamekar, Jawa Barat, Sukabumi, 43114',
      RoleType::PARTICIPANT->value
    );
  }
}
