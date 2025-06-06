<?php

// Pastikan file autoload dari Composer dipanggil
// Sesuaikan path jika struktur folder Anda berbeda
require_once __DIR__ . '/../vendor/autoload.php';

// URL logo dari internet
// GANTI DENGAN URL LOGO ASLI ANDA
$logoUrl = 'https://via.placeholder.com/150x50?text=Your+Logo'; // Contoh placeholder logo

// Konten HTML untuk laporan Anda
// Anda bisa menggunakan HTML, CSS inline atau tag <style>
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Sederhana Dengan Logo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20mm; /* Menambahkan margin pada halaman */
        }
        .header-section {
            /* Clearfix-like behavior for containing floats */
            overflow: hidden;
            margin-bottom: 20px; /* Jarak antara header dan konten */
        }
        .logo {
            float: left; /* Logo akan berada di kiri */
            margin-right: 20px; /* Jarak antara logo dan judul */
            height: 50px; /* Atur tinggi logo, lebar akan menyesuaikan proporsi */
            /* width: 150px; Jika ingin mengatur lebar juga */
        }
        h1 {
            color: #333;
            margin-top: 0; /* Hilangkan margin atas default H1 */
            /* Jika menggunakan float pada logo, H1 mungkin perlu diatur juga */
            overflow: hidden; /* Optional: Helps contain block elements next to float */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            position: fixed;
            bottom: 10mm; /* Posisikan footer 10mm dari bawah */
            left: 0;
            right: 0;
            width: 100%; /* Sesuaikan jika body punya padding/margin besar */
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header-section">
        <img src="' . $logoUrl . '" class="logo" alt="Logo Perusahaan">

        <h1>Laporan Sederhana Dengan Logo</h1>
    </div>

    <p>Ini adalah contoh laporan sederhana yang dibuat menggunakan library mPDF di PHP, sekarang dilengkapi dengan logo dari URL internet.</p>

    <h2>Data Contoh</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>Pensil</td>
                <td>100</td>
                <td>Rp 2,500</td>
            </tr>
            <tr>
                <td>002</td>
                <td>Buku Tulis</td>
                <td>50</td>
                <td>Rp 5,000</td>
            </tr>
            <tr>
                <td>003</td>
                <td>Penggaris</td>
                <td>75</td>
                <td>Rp 1,500</td>
            </tr>
            </tbody>
    </table>

    <p style="margin-top: 30px;">Terima kasih telah menggunakan laporan ini.</p>

    <div class="footer">
        Laporan Dihasilkan pada: ' . date('d-m-Y H:i:s') . '
    </div>

</body>
</html>';

try {
    // Buat instance baru dari mPDF
    // Parameter pertama (opsional): 'c' (Compact), 'A4' (ukuran kertas), '' (default font), 0,0,0,0 (margin), 0,0 (header/footer height)
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_top' => 25, // Menambahkan margin atas
        'margin_bottom' => 25, // Menambahkan margin bawah
    ]);

    // Menulis konten HTML ke PDF
    $mpdf->WriteHTML($html);

    // Output PDF
    // 'I' = Tampilkan di browser (inline)
    // 'D' = Download file
    // 'F' = Simpan ke file di server
    // 'S' = Kembalikan PDF sebagai string

    // Contoh: Tampilkan di browser dengan nama file 'laporan_dengan_logo.pdf'
    $mpdf->Output('laporan_dengan_logo.pdf', 'I');

    // Contoh: Untuk download langsung
    // $mpdf->Output('laporan_dengan_logo.pdf', 'D');

    // Contoh: Untuk menyimpan ke file di server
    // $mpdf->Output(__DIR__ . '/laporan_dengan_logo_' . date('Ymd_His') . '.pdf', 'F');


} catch (\Mpdf\MpdfException $e) {
    // Tangkap error jika ada masalah saat membuat PDF
    echo $e->getMessage();
}

?>