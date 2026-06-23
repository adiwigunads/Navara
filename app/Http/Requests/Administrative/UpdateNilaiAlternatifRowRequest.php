<?php

namespace App\Http\Requests\Administrative;

use App\Models\Kriteria;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNilaiAlternatifRowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $rules = [
            'nilai' => ['required', 'array'],
        ];

        foreach (Kriteria::query()->pluck('id') as $kriteriaId) {
            $rules["nilai.{$kriteriaId}"] = ['required', 'numeric', 'min:0'];
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nilai.required' => 'Data nilai wajib diisi.',
            'nilai.*.required' => 'Semua nilai kriteria wajib diisi.',
            'nilai.*.numeric' => 'Nilai harus berupa angka.',
            'nilai.*.min' => 'Nilai minimal 0.',
        ];
    }
}
