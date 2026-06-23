<?php

namespace App\Http\Requests\Administrative;

use Illuminate\Foundation\Http\FormRequest;

class StoreObjekWisataRequest extends FormRequest
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
            'kode' => ['required', 'string', 'max:10', 'unique:alternatif,kode'],
            'nama' => ['required', 'string', 'max:150'],
            'lokasi' => ['required', 'string', 'max:200'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kode.unique' => 'Kode objek wisata sudah digunakan.',
            'gambar.required' => 'Gambar destinasi wajib diunggah.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar: JPEG, PNG, atau WebP.',
            'gambar.max' => 'Ukuran gambar maksimal 5 MB.',
        ];
    }
}
