<?php

namespace App\Http\Requests\Administrative;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNilaiAlternatifRequest extends FormRequest
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
        return [
            'alternatif_id' => ['required', 'exists:alternatif,id'],
            'kriteria_id' => [
                'required',
                'exists:kriteria,id',
                Rule::unique('nilai_alternatif')->where(fn ($query) => $query->where('alternatif_id', $this->input('alternatif_id'))),
            ],
            'nilai' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kriteria_id.unique' => 'Nilai untuk kombinasi alternatif dan kriteria ini sudah ada.',
        ];
    }
}
