<?php

use App\Helpers\Enum\RoleType;

$admin = RoleType::ADMIN->value;

return [
  'create' => 'Melakukan Penambahan Data Berhasil',
  'update' => 'Melakukan Perubahan Data Berhasil',
  'delete' => 'Melakukan Penghapusan Data Berhasil',
  'status' => 'Melakukan Perubahan Status Berhasil',
  'password' => 'Melakukan Perubahan Kata Sandi Berhasil',
  'banned' => "Mohon Maaf, Akun anda tidak aktif. \n Mohon hubungi {$admin} untuk mengaktifkan Akun Anda.",

  'log' => [
    'error' => 'Tidak dapat melakukan tindakan, Periksa kembali',
  ],
];
