<?php
// Pastikan variabel koneksi dan sesi sudah ada
// require_once '../inc/koneksi.php';
// session_start();

// Ambil data user dari sesi (Asumsi $data_id sudah ada dari file utama)
$npm_login = $data_id;
$unread_notifications_exist = false; // Flag untuk tombol "Tandai semua dibaca"

// Aksi untuk menandai semua notifikasi sebagai telah dibaca
if (isset($_POST['tandai_semua_dibaca'])) {
    $stmt_mark_all = mysqli_prepare($koneksi, "UPDATE `notifikasi` SET `is_read` = TRUE WHERE `npm` = ? AND `is_read` = FALSE");
    mysqli_stmt_bind_param($stmt_mark_all, "s", $npm_login);
    mysqli_stmt_execute($stmt_mark_all);
    mysqli_stmt_close($stmt_mark_all);

    // Redirect untuk mencegah re-submit form saat refresh
    echo "<script>document.location.href='?page=semua-notifikasi';</script>";
    exit;
}

// Ambil SEMUA notifikasi untuk mahasiswa yang login, urutkan dari yang terbaru
$stmt_all_notif = mysqli_prepare($koneksi, "SELECT * FROM `notifikasi` WHERE `npm` = ? ORDER BY `created_at` DESC");
mysqli_stmt_bind_param($stmt_all_notif, "s", $npm_login);
mysqli_stmt_execute($stmt_all_notif);
$result_all_notif = mysqli_stmt_get_result($stmt_all_notif);

$semua_notifikasi_list = [];
while ($row = mysqli_fetch_assoc($result_all_notif)) {
    $semua_notifikasi_list[] = $row;
    if (!$row['is_read']) {
        $unread_notifications_exist = true; // Set flag jika ada minimal 1 notif belum dibaca
    }
}
mysqli_stmt_close($stmt_all_notif);
?>

<div class="kotak-notif" style="">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Semua Notifikasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="?page=home_mhs">Home</a></li>
                        <li class="breadcrumb-item active">Semua Notifikasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Notifikasi Anda</h3>
                            <div class="card-tools">
                                <form action="?page=semua-notifikasi" method="post" class="d-inline">
                                    <button type="submit" name="tandai_semua_dibaca" class="btn btn-sm btn-outline-primary" 
                                        <?php if (!$unread_notifications_exist) echo 'disabled'; ?> >
                                        <i class="fas fa-check-double mr-1"></i> Tandai Semua Telah Dibaca
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <?php if (empty($semua_notifikasi_list)): ?>
                                    <div class="list-group-item text-center text-muted p-5">
                                        <i class="fas fa-bell-slash fa-3x mb-3"></i>
                                        <p>Anda belum memiliki notifikasi.</p>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($semua_notifikasi_list as $notif): ?>
                                        <a href="" class="list-group-item list-group-item-action notification-link <?= !$notif['is_read'] ? 'bg-light' : '' ?>" data-id-notif="<?= $notif['id_notif'] ?>" data-id-khp="<?= $notif['khp_id'] ?>">
                                            <div class="d-flex align-items-center">
                                                
                                                <div class="mr-3">
                                                    <?php if ($notif['tipe'] == 'diterima'): ?>
                                                        <i class="fas fa-check-circle text-success fa-2x"></i>
                                                    <?php else: ?>
                                                        <i class="fas fa-times-circle text-danger fa-2x"></i>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="flex-grow-1">
                                                    <p class="mb-0" style="white-space: normal;"><?= htmlspecialchars($notif['pesan']) ?></p>
                                                </div>

                                                <div class="ml-3 text-nowrap">
                                                    <small class="text-muted"><?= human_time_ago(strtotime($notif['created_at'])) ?></small>
                                                </div>

                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
