<?php

namespace App\Http\Requests\Activities;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
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
    return [
      'name' => [
        'required', 'string', 'max:100',
        Rule::unique('programs', 'name')->ignore($this->program)
      ],
      'location' => 'nullable|string|max:100',
      'responsible' => 'required|string|max:100',
    ];
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
      'name.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',

      'location.string' => ':attribute tidak valid, masukkan yang benar',
      'location.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'responsible.required' => ':attribute tidak boleh dikosongkan',
      'responsible.string' => ':attribute tidak valid, masukkan yang benar',
      'responsible.max' => ':attribute terlalu panjang, maksimal :max karakter',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'name' => 'Nama Kegiatan',
      'location' => 'Lokasi Kegiatan',
      'responsible' => 'Penanggung Jawab',
    ];
  }
}
