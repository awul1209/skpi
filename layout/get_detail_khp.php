<?php
// File: get_detail_khp.php

require_once '../inc/koneksi.php'; // Sesuaikan path ke file koneksi Anda
session_start();

// Hanya proses jika user login dan ada id_khp yang dikirim
if (!isset($_SESSION['s_iduser']) || !isset($_GET['id_khp'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak']);
    exit;
}

$id_khp = $_GET['id_khp'];
$npm_login = $_SESSION['s_iduser'];

// Query untuk mengambil detail KHP, pastikan KHP ini milik user yang login
$stmt = mysqli_prepare($koneksi, 
    "SELECT `nama_b_indo`, `nama_b_inggris`, `tgl_sertifikat`, `no_sertifikat`, `status`, `bobot_disetujui`, `keterangan`, `updated_at` 
    FROM `khp` 
    WHERE `id` = ? AND `npm` = ?");

mysqli_stmt_bind_param($stmt, "is", $id_khp, $npm_login);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ($data) {
    // Berhasil menemukan data, kirim sebagai JSON
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    // Tidak ada data yang ditemukan
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
}
?>