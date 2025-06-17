<?php
// Panggil autoloader dari Composer
require_once __DIR__ . '/../../vendor/autoload.php'; // Sesuaikan path ke vendor/autoload.php
// Panggil file koneksi database Anda
include ('../../inc/koneksi.php'); // Sesuaikan path ke koneksi.php

// Ambil parameter filter dari URL
$search_fakultas = isset($_GET['fakultas']) ? mysqli_real_escape_string($koneksi, $_GET['fakultas']) : '';
$search_prodi = isset($_GET['prodi']) ? mysqli_real_escape_string($koneksi, $_GET['prodi']) : '';
$search_tahun = isset($_GET['tahun']) ? mysqli_real_escape_string($koneksi, $_GET['tahun']) : '';
$search_periode = isset($_GET['periode']) ? mysqli_real_escape_string($koneksi, $_GET['periode']) : '';

$q_fk=mysqli_query($koneksi,"SELECT nama_fakultas FROM fakultas WHERE id_fakultas='$search_fakultas'");
$row_fk=mysqli_fetch_assoc($q_fk);
$fk=$row_fk['nama_fakultas'];
// Bangun ulang query SQL berdasarkan filter
$sql_base = "SELECT 
                khp.*, mahasiswa.nama_lengkap, mahasiswa.npm,mahasiswa.foto,
                krp.nama as nama_kegiatan, khp.bobot_disetujui,
                prodi.nama_prodi, fakultas.nama_fakultas
             FROM khp
             JOIN mahasiswa ON khp.npm = mahasiswa.npm
             JOIN krp ON khp.kode = krp.kode
             JOIN prodi ON mahasiswa.prodi_id = prodi.id_prodi
             JOIN fakultas on prodi.fakultas_id = fakultas.id_fakultas";

$where_clauses = ["khp.status = 'diterima'"];
if (!empty($search_fakultas)) $where_clauses[] = "fakultas.id_fakultas = '$search_fakultas'";
if (!empty($search_prodi)) $where_clauses[] = "prodi.id_prodi = '$search_prodi'";
if (!empty($search_tahun)) $where_clauses[] = "khp.tahun = '$search_tahun'";
if (!empty($search_periode)) $where_clauses[] = "khp.periode = '$search_periode'";

if (count($where_clauses) > 0) {
    $sql_base .= " WHERE " . implode(' AND ', $where_clauses);
}

$sql_base .= " ORDER BY mahasiswa.nama_lengkap ASC, khp.created_at ASC";
$result = mysqli_query($koneksi, $sql_base);

// Kelompokkan data berdasarkan mahasiswa (NPM)
$grouped_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $npm = $row['npm'];
    if (!isset($grouped_data[$npm])) {
        $grouped_data[$npm] = [
            'details' => [
                'nama_lengkap' => $row['nama_lengkap'],
                'npm'          => $row['npm'],
                'prodi'        => $row['nama_prodi'],
                'fakultas'     => $row['nama_fakultas']
            ],
            'activities' => []
        ];
    }
    $grouped_data[$npm]['activities'][] = $row;
}

// Jika tidak ada data, tampilkan pesan error yang rapi
if (empty($grouped_data)) {
    echo "
    <div style='text-align:center; padding-top: 50px; font-family: sans-serif;'>
        <h2>Tidak Ada Data</h2>
        <p>Tidak ada data yang ditemukan sesuai dengan filter yang dipilih untuk dicetak.</p>
        <p><a href='#' onclick='window.close();'>Tutup Halaman Ini</a></p>
    </div>
    ";
    exit;
}

// ===================================================================
// MEMBUAT DOKUMEN PDF DENGAN MPDF
// ===================================================================

// Inisialisasi mPDF
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'orientation' => 'P',
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_top' => 40, // Beri ruang lebih untuk header
    'margin_bottom' => 25 // Beri ruang untuk footer
]);

// Set Header Dokumen
// Ganti 'path/to/your/logo.png' dengan path logo Anda yang sebenarnya
$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: middle; font-family: serif; font-size: 9pt;">
    <tr>
        <td width="15%" style="text-align: center;">
            <img src="../../dist/img/unija.png" width="80px" /> 
        </td>
        <td width="85%" style="text-align: center;">
            <span style="font-size: 14pt; font-weight: bold;">UNIVERSITAS WIRARAJA SUMENEP</span><br />
            <span style="font-size: 12pt; font-weight: bold;">FAKULTAS ' . strtoupper($fk) . '</span><br />
            <span style="font-size: 12pt; font-weight: bold;"> '.$search_tahun.'</span><br />
            <span style="font-size: 12pt; font-weight: bold;"> '.$search_periode.'</span><br />
            <span style="font-size: 10pt;">Alamat Universitas Anda, Kota, Kodepos<br/>
            Website: www.websiteanda.ac.id, Email: info@websiteanda.ac.id</span>
        </td>
    </tr>
</table>
';
$mpdf->SetHTMLHeader($header);

// Set Footer Dokumen
$footer = 'SKPI | {PAGENO} / {nb} | Dicetak pada: ' . date('d-m-Y H:i:s');
$mpdf->SetFooter($footer);

// Siapkan HTML untuk konten utama PDF
$main_html = '
<style>
    body { font-family: "Times New Roman", serif; font-size: 12pt; }
    h3, h4 { text-align: center; margin: 0; padding: 0; }
    .student-info { margin-top: 20px; margin-bottom: 15px; }
    .student-info table { width: 100%; border-collapse: collapse; }
    .student-info td { padding: 3px; vertical-align: top;}
    .activity-table { width: 100%; border-collapse: collapse; font-size: 11pt; margin-top: 10px; }
    .activity-table th, .activity-table td { border: 1px solid #333; padding: 5px; }
    .activity-table th { background-color: #EFEFEF; font-weight: bold; }
    .signature { margin-top: 50px; width: 320px; float: right; text-align: left; }
    .page-break { page-break-before: always; }
</style>
';

$first_student = true;
// Loop melalui setiap mahasiswa untuk membuat halamannya masing-masing
foreach ($grouped_data as $npm => $data) {
    if (!$first_student) {
        $main_html .= '<div class="page-break"></div>';
    }
    
    $student_details = $data['details'];
    $activities = $data['activities'];
    $total_bobot = 0;

    $main_html .= '
    <main>
        <h4>SURAT KETERANGAN PENDAMPING IJAZAH (SKPI)</h4>
        <h3>(Diploma Supplement)</h3>
        
        <div class="student-info">
            <table>
                <tr><td width="30%">Nama Lengkap</td><td width="2%">:</td><td><strong>' . htmlspecialchars($student_details['nama_lengkap']) . '</strong></td></tr>
                <tr><td>Nomor Pokok Mahasiswa</td><td>:</td><td>' . htmlspecialchars($student_details['npm']) . '</td></tr>
                <tr><td>Program Studi</td><td>:</td><td>' . htmlspecialchars($student_details['prodi']) . '</td></tr>
                <tr><td>Fakultas</td><td>:</td><td>' . htmlspecialchars($student_details['fakultas']) . '</td></tr>
            </table>
        </div>

        <p>Adalah benar telah mengikuti kegiatan kokurikuler dan ekstrakurikuler selama menempuh pendidikan di Universitas, sebagai berikut:</p>
        
        <table class="activity-table">
            <thead>
                <tr>
                    <th style="width: 7%; text-align:center;">No</th>
                    <th style="width: 53%;">Nama Kegiatan</th>
                    <th style="width: 15%; text-align:center;">Tahun/Periode</th>
                    <th style="width: 10%; text-align:center;">Bobot</th>
                </tr>
            </thead>
            <tbody>';
    
    $no = 1;
    foreach ($activities as $activity) {
        $main_html .= '
            <tr>
                <td style="text-align: center;">' . $no++ . '</td>
                <td>' . htmlspecialchars($activity['nama_kegiatan']) . ' (' . htmlspecialchars($activity['nama_b_indo']) . ')' . '</td>
                <td style="text-align: center;">' . htmlspecialchars($activity['tahun']) . ' (' . htmlspecialchars($activity['periode']) . ')</td>
                <td style="text-align: center;">' . htmlspecialchars($activity['bobot_disetujui']) . '</td>
            </tr>';
        $total_bobot += (int)$activity['bobot_disetujui'];
    }
    
    $main_html .= '
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Total Poin SKPI</td>
                    <td style="text-align: center; font-weight: bold;">' . $total_bobot . '</td>
                </tr>
            </tfoot>
        </table>

        <div class="signature">
            <p>Kota Anda, ' . date('d F Y') . '</p>
            <p>Wakil Rektor Bidang Kemahasiswaan,</p>
            <br><br><br><br>
            <p style="font-weight:bold; text-decoration: underline;"></p>
            <p>NIP. ............................</p>
        </div>
    </main>
    ';
    $first_student = false;
}

// Tulis konten HTML ke PDF dan tampilkan
try {
    $mpdf->WriteHTML($main_html);
    $mpdf->Output('Laporan_SKPI.pdf', 'I');
} catch (\Mpdf\MpdfException $e) {
    die ('Terjadi kesalahan saat membuat PDF: ' . $e->getMessage());
}