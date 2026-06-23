<?php

/**
 * Unduh gambar wisata dari Wikimedia Commons (lisensi bebas).
 * Jalankan: php database/scripts/download-wisata-images.php
 */

$destDir = __DIR__.'/../../public/images/wisata';

$images = [
    'a1-tirta-gangga.jpg' => 'Tirta Gangga, Karangasem, Bali.jpg',
    'a2-taman-ujung.jpg' => 'Pemandangan di Taman Ujung Karangasem Bali.jpg',
    'a3-bukit-asah.jpg' => 'Bukit Asah.jpg',
    'a4-virgin-beach.jpg' => 'Virgin Beach Bali.jpg',
    'a5-taman-edelweis.jpg' => 'Karangasem Regency - panoramio.jpg',
    'a6-tenganan.jpg' => 'Desa Tenganan.jpg',
    'a7-pantai-amed.jpg' => 'Bali-amed-landscape-sunrise.jpg',
    'a8-blue-lagoon.jpg' => 'Padangbai Secret Beach Belle 1.jpg',
    'a9-telaga-surya.jpg' => 'Departing Banjar hot spring in Bali (36243769511).jpg',
    'a10-bukit-cinta-pangi.jpg' => 'Lahangan Sweet 1.jpg',
];

if (! is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

foreach ($images as $localName => $commonsFile) {
    $url = 'https://commons.wikimedia.org/wiki/Special:FilePath/'.rawurlencode($commonsFile).'?width=800';
    $dest = $destDir.'/'.$localName;

    $context = stream_context_create([
        'http' => [
            'header' => "User-Agent: NavaraKarangasem/1.0 (Laravel; educational project)\r\n",
            'follow_location' => 1,
            'timeout' => 60,
        ],
    ]);

    $data = @file_get_contents($url, false, $context);

    if ($data === false || strlen($data) < 5000) {
        echo "GAGAL: {$localName}\n";

        continue;
    }

    file_put_contents($dest, $data);
    echo "OK: {$localName} (".number_format(strlen($data)).' bytes)'."\n";
}
