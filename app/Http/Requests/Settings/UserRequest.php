<?php

namespace App\Http\Requests\Settings;

use App\Helpers\Enum\RoleType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    $rules = [
      'name' => 'required|string|max:50',
      'email' => [
        'required', 'email:dns',
        Rule::unique('users', 'email')->ignore($this->user),
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        Rule::unique('users', 'phone')->ignore($this->user),
      ],
      'file' => 'nullable|mimes:jpg,png|max:3048',
      'roles' => 'required|' . RoleType::toValidation(0, 1),
    ];

    return $rules;
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'name.required' => ':attribute tidak boleh dikosongkan',
      'name.string' => ':attribute tidak valid, masukkan yang benar',
      'name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :min karakter',

      'roles.required' => ':attribute tidak boleh dikosongkan',
      'roles.string' => ':attribute tidak valid, masukkan yang benar',
      'roles.in' => ':attribute yang anda masukkan tidak valid',

      'file.image' => ':attribute tidak valid, pastikan memilih gambar',
      'file.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'file.max' => ':attribute terlalu besar, maksimal :max kb',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'name' => 'Nama Lengkap',
      'email' => 'Email',
      'phone' => 'Nomor Telepon',
      'roles' => 'Role Pengguna',
      'file' => 'Foto Profil',
    ];
  }
}
