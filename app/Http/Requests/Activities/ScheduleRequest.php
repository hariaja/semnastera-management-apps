<?php

namespace App\Http\Requests\Activities;

use App\Helpers\Enum\ScheduleType;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
      'type' => 'required|' . ScheduleType::toValidation(),
      'program_id' => 'required|numeric',
      'start_date' => 'required|date',
      'end_date' => 'required|date|after_or_equal:start_date',
      'status' => 'nullable|string',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'program_id.required' => ':attribute tidak boleh dikosongkan',
      'program_id.numeric' => ':attribute tidak valid',

      'start_date.required' => ':attribute tidak boleh dikosongkan',
      'start_date.date' => ':attribute harus berupa tanggal. Etc: 2023/01/01',
      'start_date.after_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date',
      'start_date.before_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date',

      'end_date.required' => ':attribute tidak boleh dikosongkan',
      'end_date.date' => ':attribute harus berupa tanggal. Etc: 2023/01/01',
      'end_date.after_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date',
      'end_date.before_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date',

      'type.required' => ':attribute tidak boleh dikosongkan',
      'type.in' => ':attribute tidak sesuai pilihan yang disediakan',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function attributes(): array
  {
    return [
      'type' => 'Kategori',
      'program_id' => 'Kegiatan',
      'start_date' => 'Tanggal Dimulai',
      'end_date' => 'Tanggal Selesai',
      'status' => 'Status',
    ];
  }
}
