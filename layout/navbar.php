<?php

// Ambil data user dari sesi
$npm_login = $_SESSION['s_iduser'];
$data_username = $_SESSION['s_username']; // Ganti dengan nama sesi Anda
$data_level = $_SESSION['s_level']; // Ganti dengan nama sesi Anda

// Ambil data notifikasi (kode yang sudah kita buat)
$stmt_notif = mysqli_prepare($koneksi, "SELECT * FROM `notifikasi` WHERE `npm` = ? ORDER BY `created_at` DESC LIMIT 10");
mysqli_stmt_bind_param($stmt_notif, "s", $npm_login);
mysqli_stmt_execute($stmt_notif);
$result_notif = mysqli_stmt_get_result($stmt_notif);

$notifikasi_list = [];
$unread_count = 0;
while ($row = mysqli_fetch_assoc($result_notif)) {
    $notifikasi_list[] = $row;
    if (!$row['is_read']) {
        $unread_count++;
    }
}
mysqli_stmt_close($stmt_notif);


?>
<nav class="main-header navbar navbar-expand fixed-top" style="background-color:#060930;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars text-white"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item d-none d-sm-inline-block my-auto">
            <span class="nav-link text-white">
            <?php 
                if($data_level=='staff'){
                    echo "Fakultas " . htmlspecialchars($nama_fakultas);
                } elseif($data_level=='mahasiswa'){
                    echo "Welcome, " . htmlspecialchars($data_username);
                }
            ?>
            </span>
        </li>

        <?php if($data_level == 'mahasiswa'): ?>
        <li class="nav-item dropdown" style="width: 70px; display: flex; justify-content: start; align-items: center;">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell text-white"></i>
                
                <?php if ($unread_count > 0): ?>
                <span class="badge badge-danger navbar-badge"><?= $unread_count ?></span>
                <?php endif; ?>
            </a>
            
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow">
                <span class="dropdown-item dropdown-header"><?= $unread_count ?> Notifikasi Baru</span>
                <div class="dropdown-divider"></div>
                
                <?php if (empty($notifikasi_list)): ?>
                    <a href="#" class="dropdown-item text-center text-muted">
                        Tidak ada notifikasi.
                    </a>
                <?php else: ?>
                  <?php foreach ($notifikasi_list as $notif): ?>
    <a href="#" class="dropdown-item notification-link <?= !$notif['is_read'] ? 'bg-light' : '' ?>" data-id-notif="<?= $notif['id_notif'] ?>" data-id-khp="<?= $notif['khp_id'] ?>">
        <?php if ($notif['tipe'] == 'diterima'): ?>
            <i class="fas fa-check-circle text-success mr-2"></i> 
        <?php else: ?>
            <i class="fas fa-times-circle text-danger mr-2"></i> 
        <?php endif; ?>
        <div class="media-body">
            <h3 class="dropdown-item-title" style="font-size: 0.9rem; white-space: normal; font-weight: normal;">
                <?= htmlspecialchars($notif['pesan']) ?>
            </h3>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 
                <?= human_time_ago(strtotime($notif['created_at'])) ?>
            </p>
        </div>
    </a>
    <div class="dropdown-divider"></div>
<?php endforeach; ?>
                <?php endif; ?>
                
                <a href="?page=semua-notifikasi" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
            </div>
        </li>
        <?php endif; ?>

        <!-- <li class="nav-item">
            <a class="nav-link" href="logout.php" onclick="return confirm('Apakah anda yakin akan keluar ?')" title="Logout">
                <i class="fas fa-sign-out-alt text-white"></i>
            </a>
        </li> -->

    </ul>
</nav>





