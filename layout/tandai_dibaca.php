<?php
// tandai_dibaca.php

// Hubungkan ke database dan mulai session
require_once '../inc/koneksi.php'; // Sesuaikan dengan file koneksi Anda
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['s_iduser'])) {
    $npm_login = $_SESSION['s_iduser'];
    $id_notif = $_POST['id_notif'];

    // Pastikan notifikasi ini milik user yang sedang login untuk keamanan
    $stmt = mysqli_prepare($koneksi, "UPDATE notifikasi SET is_read = TRUE WHERE id_notif = ? AND npm = ?");
    mysqli_stmt_bind_param($stmt, "is", $id_notif, $npm_login);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Notifikasi tidak ditemukan atau sudah dibaca']);
    }
    mysqli_stmt_close($stmt);
} else {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak']);
}
?>