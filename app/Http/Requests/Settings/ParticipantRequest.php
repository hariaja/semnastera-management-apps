<?php

namespace App\Http\Requests\Settings;

use Illuminate\Validation\Rule;
use App\Helpers\Enum\GenderType;
use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
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
    if ($this->participant) {
      $userId = $this->participant->user_id;
    }

    $method = $this->method();

    $rules = [
      'first_title' => 'nullable|string|max:5',
      'first_name' => 'required|string|max:20',
      'last_name' => 'required|string|max:20',
      'last_title' => 'nullable|string|max:5',
      'gender' => 'required|' . GenderType::toValidation(),
      'roles' => 'required',
      'address' => 'required|string',
      'institution' => 'required|string',
      'avatar' => 'nullable|mimes:jpg,png|max:3048',
      'email' => [
        'required', 'email',
        $method === 'POST' ? Rule::unique('users', 'email') : Rule::unique('users', 'email')->ignore($userId),
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        $method === 'POST' ? Rule::unique('users', 'phone') : Rule::unique('users', 'phone')->ignore($userId),
      ],
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
      'first_title.string' => ':attribute tidak valid, masukkan yang benar',
      'first_title.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'first_name.required' => ':attribute tidak boleh dikosongkan',
      'first_name.string' => ':attribute tidak valid, masukkan yang benar',
      'first_name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'last_name.required' => ':attribute tidak boleh dikosongkan',
      'last_name.string' => ':attribute tidak valid, masukkan yang benar',
      'last_name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'last_title.string' => ':attribute tidak valid, masukkan yang benar',
      'last_title.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'gender.required' => ':attribute tidak boleh dikosongkan',
      'gender.string' => ':attribute tidak valid, masukkan yang benar',
      'gender.max' => ':attribute terlalu panjang, maksimal :max karakter',
      'gender.in' => ':attribute tidak sesuai pilihan yang disediakan',

      'roles.required' => ':attribute tidak boleh dikosongkan',

      'address.required' => ':attribute tidak boleh dikosongkan',
      'address.string' => ':attribute tidak valid, masukkan yang benar',

      'institution.required' => ':attribute tidak boleh dikosongkan',
      'institution.string' => ':attribute tidak valid, masukkan yang benar',

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :min karakter',

      'avatar.image' => ':attribute tidak valid, pastikan memilih gambar',
      'avatar.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'avatar.max' => ':attribute terlalu besar, maksimal :max kb',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'first_title' => 'Gelar depan',
      'first_name' => 'Nama depan',
      'last_name' => 'Nama belakang',
      'last_title' => 'Gelar belakang',
      'gender' => 'Jenis kelamin',
      'roles' => 'Tipe akun',
      'address' => 'Alamat lengkap',
      'institution' => 'Asal institusi',
      'email' => 'Email',
      'phone' => 'Nomor telepon',
      'avatar' => 'Foto profil',
    ];
  }
}
