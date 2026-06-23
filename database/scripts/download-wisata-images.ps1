$destDir = Join-Path $PSScriptRoot "..\..\public\images\wisata"
New-Item -ItemType Directory -Force -Path $destDir | Out-Null

$images = @{
    "a1-tirta-gangga.jpg"       = "Tirta Gangga, Karangasem, Bali.jpg"
    "a2-taman-ujung.jpg"        = "Pemandangan di Taman Ujung Karangasem Bali.jpg"
    "a3-bukit-asah.jpg"         = "Bukit Asah.jpg"
    "a4-virgin-beach.jpg"       = "Virgin Beach Bali.jpg"
    "a5-taman-edelweis.jpg"     = "Karangasem Regency - panoramio.jpg"
    "a6-tenganan.jpg"           = "Desa Tenganan.jpg"
    "a7-pantai-amed.jpg"        = "Bali-amed-landscape-sunrise.jpg"
    "a8-blue-lagoon.jpg"        = "Padangbai Secret Beach Belle 1.jpg"
    "a9-telaga-surya.jpg"       = "Departing Banjar hot spring in Bali (36243769511).jpg"
    "a10-bukit-cinta-pangi.jpg" = "Lahangan Sweet 1.jpg"
}

foreach ($entry in $images.GetEnumerator()) {
    $encoded = [uri]::EscapeDataString($entry.Value)
    $url = "https://commons.wikimedia.org/wiki/Special:FilePath/$encoded?width=800"
    $dest = Join-Path $destDir $entry.Key

    curl.exe -L -A "NavaraKarangasem/1.0" $url -o $dest --silent --show-error

    if ((Test-Path $dest) -and ((Get-Item $dest).Length -gt 5000)) {
        Write-Host "OK: $($entry.Key)"
    } else {
        Write-Host "GAGAL: $($entry.Key)"
    }
}
