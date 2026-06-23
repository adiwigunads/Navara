<?php

namespace App\Http\Requests\Administrative;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateObjekWisataRequest extends FormRequest
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
            'kode' => ['required', 'string', 'max:10', Rule::unique('alternatif', 'kode')->ignore($this->route('alternatif'))],
            'nama' => ['required', 'string', 'max:150'],
            'lokasi' => ['required', 'string', 'max:200'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kode.unique' => 'Kode objek wisata sudah digunakan.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar: JPEG, PNG, atau WebP.',
            'gambar.max' => 'Ukuran gambar maksimal 5 MB.',
        ];
    }
}
