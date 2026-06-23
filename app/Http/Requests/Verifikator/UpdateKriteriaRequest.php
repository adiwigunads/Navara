<?php

namespace App\Http\Requests\Verifikator;

use App\KriteriaTipe;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKriteriaRequest extends FormRequest
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
            'kode' => ['required', 'string', 'max:10', Rule::unique('kriteria', 'kode')->ignore($this->route('kriterium'))],
            'nama' => ['required', 'string', 'max:100'],
            'tipe' => ['required', Rule::enum(KriteriaTipe::class)],
            'bobot' => ['required', 'numeric', 'min:0.01', 'max:1'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kode.unique' => 'Kode kriteria sudah digunakan.',
            'bobot.min' => 'Bobot minimal 0.01.',
            'bobot.max' => 'Bobot maksimal 1.',
        ];
    }
}
