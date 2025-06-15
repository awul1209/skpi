<?php

// Pastikan file autoload dari Composer dipanggil
// Sesuaikan path jika struktur folder Anda berbeda
require_once __DIR__ . '/../vendor/autoload.php';
include '../inc/koneksi.php';
// error_reporting(0);

/// Ambil parameter dari URL
$npm = isset($_GET['npm']) ? mysqli_real_escape_string($koneksi, $_GET['npm']) : '';
$jenis = isset($_GET['jenis']) ? mysqli_real_escape_string($koneksi, $_GET['jenis']) : '';
$tahun = isset($_GET['tahun']) ? mysqli_real_escape_string($koneksi, $_GET['tahun']) : '';
$periode = isset($_GET['periode']) ? mysqli_real_escape_string($koneksi, $_GET['periode']) : '';
$fakultas = isset($_GET['fakultas']) ? mysqli_real_escape_string($koneksi, $_GET['fakultas']) : '';

$fk=mysqli_query($koneksi,"SELECT nama_fakultas FROM `fakultas` JOIN prodi ON fakultas.id_fakultas=prodi.fakultas_id JOIN mahasiswa on prodi.id_prodi= mahasiswa.prodi_id WHERE mahasiswa.npm='$npm'");
$rowfk=mysqli_fetch_assoc($fk);
$fkk=$rowfk['nama_fakultas'];

if (empty($npm) || empty($jenis) || empty($tahun) || empty($periode)) {
    die("Parameter tidak lengkap.");
}

// 1. Ambil data biodata mahasiswa
$query_mhs = mysqli_query($koneksi, "SELECT m.*, p.nama_prodi FROM mahasiswa m JOIN prodi p ON m.prodi_id = p.id_prodi WHERE m.npm = '$npm'");
$mahasiswa = mysqli_fetch_assoc($query_mhs);

if (!$mahasiswa) {
    die("Data mahasiswa tidak ditemukan.");
}

// 2. Ambil data kegiatan sesuai jenis (KRP/KHP)
$kegiatan = [];
$query_kegiatan = null;

if ($jenis == 'KHP') {
    // Untuk KHP, ambil data yang sudah divalidasi/disetujui
    $query_kegiatan = mysqli_query($koneksi, "SELECT khp.kode, krp.nama, krp.kategori, khp.nama_b_inggris,khp.nama_b_indo FROM khp JOIN krp ON khp.kode=krp.kode WHERE khp.npm='$npm' AND khp.tahun='$tahun' AND khp.periode='$periode' AND khp.status='diterima' ORDER BY krp.kategori, krp.kode ASC;");
} elseif ($jenis == 'KRP') {
    // Untuk KRP, ambil data dari rencana
    $query_kegiatan = mysqli_query($koneksi, "SELECT krp_mhs.kode, krp.nama, krp.kategori FROM krp_mhs JOIN krp ON krp_mhs.kode=krp.kode WHERE krp_mhs.npm='$npm' AND krp_mhs.tahun='$tahun' AND krp_mhs.periode='$periode' ORDER BY krp.kategori, krp.kode ASC;");
}

// Kelompokkan kegiatan berdasarkan kategori
$kegiatan_by_kategori = [];
if ($query_kegiatan) {
    while ($row = mysqli_fetch_assoc($query_kegiatan)) {
        $kegiatan_by_kategori[$row['kategori']][] = $row;
    }
}

// Daftar urutan kategori yang akan ditampilkan
$daftar_kategori = [
    'Wajib Universitas',
    'Organisasi dan Kepemimpinan',
    'Penalaran dan Keilmuan',
    'Minat dan Bakat',
    'Sosial dan Lainnya'
];


// ==============================================================
// MULAI MEMBUAT KONTEN HTML UNTUK PDF
// ==============================================================
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan <?= $jenis ?> Mahasiswa</title>
<style>
    body { font-family: sans-serif; font-size: 10pt; }
    /* ... (CSS Anda yang lain) ... */

    .pas-foto {
        width: 3cm;
        border: 1px solid #000;
        object-fit: cover; /* <-- INI ADALAH SOLUSINYA */
    }
        body { font-family: sans-serif; font-size: 10pt; }
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .header-table td { vertical-align: top; }
        .logo { width: 80px; text-align: left; }
        .kop-surat { text-align: center; }
        .kop-surat h3 { margin: 0; font-size: 14pt; }
        .kop-surat h4 { margin: 0; font-size: 12pt; font-weight: normal; }
        
        .content-table { width: 100%; }
        .biodata-section { width: 75%; vertical-align: top; }
        .photo-section { width: 25%; text-align: right; vertical-align: top;}

        .bio-table { border-collapse: collapse; }
        .bio-table td { padding: 2px 5px; }
        .bio-label { width: 180px; }

        .kegiatan-section { margin-top: 20px; }
        .kegiatan-section h4 { background-color: #E0E0E0; padding: 5px; margin: 15px 0 5px 0; font-size: 11pt; }
        
        .activity-table { width: 100%; border-collapse: collapse; page-break-inside: avoid; }
        .activity-table th, .activity-table td { border: 1px solid #ccc; padding: 5px; }
        .activity-table th { background-color: #F0F0F0; font-weight: bold; }
        .no-data { text-align: center; color: #888; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
<td class="logo">
    <?php
    // Path absolut Anda sudah terbukti benar
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $project_folder = '/skpi'; // Sesuaikan jika perlu
    $logo_path = $document_root . $project_folder . '/dist/img/unija.png';

    // Cek sekali lagi untuk keamanan
    if (file_exists($logo_path)) {
        // --- SOLUSI BASE64 DIMULAI DI SINI ---
        
        // 1. Baca seluruh data biner dari file gambar
        $logo_data = file_get_contents($logo_path);
        
        // 2. Dapatkan tipe ekstensi file (png)
        $logo_type = pathinfo($logo_path, PATHINFO_EXTENSION);
        
        // 3. Encode data biner menjadi teks Base64 dan buat format src yang benar
        $logo_base64 = 'data:image/' . $logo_type . ';base64,' . base64_encode($logo_data);
        
        // 4. Tampilkan gambar menggunakan data Base64
        echo '<img src="' . $logo_base64 . '" width="70" />';

    } else {
        // Fallback jika file tetap tidak ada
        echo 'Logo tidak ditemukan.';
    }
    ?>
</td>
            <td class="kop-surat">
                <?php if($jenis=='KHP'){ ?>
                    <h3>Kartu Hasil Partisipasi (<?= $jenis ?>) Mahasiswa</h3>
                <?php }else{ ?>
                <h3>Kartu Rencana Partisipasi (<?= $jenis ?>) Mahasiswa</h3>
                <?php } ?>
                <h4>Fakultas <?= $fkk ?></h4>
                <h4>Universitas Wiraraja</h4>
                <h4>Periode <?= $tahun ?> (<?= $periode?>)</h4>
            </td>
        </tr>
    </table>
    <hr>

    <table class="content-table">
        <tr>
            <td class="biodata-section">
                <h4>Biodata Mahasiswa</h4>
                <table class="bio-table">
                    <tr>
                        <td class="bio-label">NAMA LENGKAP<br><i>Full Name</i></td>
                        <td>:</td>
                        <td><?= htmlspecialchars($mahasiswa['nama_lengkap']) ?></td>
                    </tr>
                    <tr>
                        <td class="bio-label">TEMPAT / TANGGAL LAHIR<br><i>Place and Date of Birth</i></td>
                        <td>:</td>
                        <td><?= htmlspecialchars($mahasiswa['tempat_lahir']) ?> / <?= date('d F Y', strtotime($mahasiswa['tanggal_lahir'])) ?></td>
                    </tr>
                    <tr>
                        <td class="bio-label">NOMOR POKOK MAHASISWA<br><i>Student Identification Number</i></td>
                        <td>:</td>
                        <td><?= htmlspecialchars($mahasiswa['npm']) ?></td>
                    </tr>
                    <tr>
                        <td class="bio-label">TAHUN AKADEMIK<br><i>Academic Year</i></td>
                        <td>:</td>
                        <td><?= htmlspecialchars($tahun) ?> - <?= htmlspecialchars(strtoupper($periode)) ?></td>
                    </tr>
                    <tr>
                        <td class="bio-label">PROGRAM STUDI<br><i>Department</i></td>
                        <td>:</td>
                        <td><?= htmlspecialchars($mahasiswa['nama_prodi']) ?></td>
                    </tr>
                </table>
            </td>
<td class="photo-section">
    <?php
    // Menggunakan path absolut yang 100% benar sesuai struktur folder Anda
    $document_root = $_SERVER['DOCUMENT_ROOT'];

    // SESUAIKAN INI DENGAN NAMA FOLDER PROYEK ANDA DI DALAM HTDOCS
    $project_folder = '/skpi'; 

    // Path ini sekarang akan menunjuk ke lokasi yang benar di server
    $foto_path_absolut = $document_root . $project_folder . '/dist/img/fotomhs/' . $mahasiswa['foto'];
    
    // Pengecekan file tetap dilakukan untuk keamanan
    if (!empty($mahasiswa['foto']) && file_exists($foto_path_absolut)) {
        echo '<img src="' . $foto_path_absolut . '" class="pas-foto" />';
    } else {
        echo '<div class="pas-foto" style="display: flex; align-items: center; justify-content: center; text-align:center; background-color: #eee; border: 1px solid #ccc;">Foto Tidak Tersedia</div>';
    }
    ?>
</td>
        </tr>
    </table>

    <div class="kegiatan-section">
        <?php foreach ($daftar_kategori as $kategori) : ?>
            <h4><?= strtoupper($kategori) ?></h4>
            <table class="activity-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">NO</th>
                        <th style="width: 15%;">Kode</th>
                        <th>Nama /tema Kegiatan<br><i>Tittle /Theme Of Activity</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kegiatan_by_kategori[$kategori])) : ?>
                        <?php $no = 1; foreach ($kegiatan_by_kategori[$kategori] as $keg) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td style="text-align: center;"><?= htmlspecialchars($keg['kode']) ?></td>
                                <td>
                                    <?php
                                        if($jenis=='KRP'){ ?>
                                            <?= htmlspecialchars($keg['nama']) ?><br>

                                     <?php   }else{ ?>
                                    <i>(idn) : <?= htmlspecialchars($keg['nama_b_indo']) ?></i>  <br>
                                    <i>(eng) : <?= htmlspecialchars($keg['nama_b_inggris']) ?></i>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="no-data">--- Tidak Ada Data ---</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>

    <!-- ttd -->
     </div>

<div style="width: 100%; margin-top: 40px; page-break-inside: avoid;">
    <table style="width: 100%;" nobr="true">
        <tr>
            <td style="width: 50%; text-align: center;">
                <p style="margin-bottom: 70px;">Dosen Wali</p>
                <br><br><br><br>
                <p style="font-weight: bold; text-decoration: underline;">
                    ( ......................................... )
                </p>
                <p style="margin-top: 5px;">
                    NIDN. .................................
                </p>
            </td>

            <td style="width: 50%; text-align: center;">
                <p>Mengetahui,<br>Mahasiswa</p>
                <br><br><br> <p style="font-weight: bold; text-decoration: underline;">
                    <?= strtoupper(htmlspecialchars($mahasiswa['nama_lengkap'])) ?>
                </p>
                <p style="margin-top: 5px;">
                    NPM. <?= htmlspecialchars($mahasiswa['npm']) ?>
                </p>
            </td>
        </tr>
    </table>
</div>

<div style="text-align: right; margin-top: 20px; font-size: 9pt;">
    Dicetak pada: <?= date('d F Y') ?>
</div>

</body>
</html>
<?php
// ==============================================================
// AKHIR KONTEN HTML
// ==============================================================

$html = ob_get_contents();
ob_end_clean();

// Buat instance mPDF
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_top' => 15,
    'margin_bottom' => 15,
    'image_error_reporting' => E_ALL // <-- BARIS PENTING UNTUK MELIHAT ERROR GAMBAR
]);

// Tulis HTML ke PDF dan tampilkan di browser
$mpdf->WriteHTML($html);
$mpdf->Output('Laporan_KHP_' . $npm . '.pdf', 'I');

exit;

?>