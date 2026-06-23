<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class WisataImageService
{
    private string $directory;

    public function __construct()
    {
        $this->directory = public_path('images/wisata');
    }

    public function store(UploadedFile $file, string $kode): string
    {
        if (! is_dir($this->directory)) {
            mkdir($this->directory, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $filename = Str::slug(strtolower($kode)).'-'.time().'.'.$extension;

        $file->move($this->directory, $filename);

        return $filename;
    }

    public function delete(?string $filename): void
    {
        if ($filename === null || $filename === '' || $filename === 'default.jpg') {
            return;
        }

        $path = $this->directory.DIRECTORY_SEPARATOR.$filename;

        if (file_exists($path)) {
            unlink($path);
        }
    }
}
