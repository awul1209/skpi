<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<?php
// Cek jika ada aksi dari form yang disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    // Menggunakan REQUEST_URI agar parameter seperti ?page= tidak hilang setelah redirect
    $redirect_url = $_SERVER['REQUEST_URI']; 

    // Aksi: TAMBAH USER
    if ($action == 'tambah_user') {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = $_POST['password']; // Ambil password mentah
        $level = mysqli_real_escape_string($koneksi, $_POST['level']);
        $prodi_id = (int)$_POST['prodi_id'];

        // Cek dulu apakah username sudah ada
        $cek_user = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
        if (mysqli_num_rows($cek_user) > 0) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
            Swal.fire({title: 'Gagal', text: 'Username \"$username\" sudah terdaftar!', icon: 'error', confirmButtonText: 'OK'})
            .then(() => { document.location.href='{$redirect_url}'; });
            </script>";
        } else {
            // Jika aman, hash password dan insert data
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $koneksi->prepare("INSERT INTO user (username, password, level, prodi_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $username, $hashed_password, $level, $prodi_id);
            
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            if ($stmt->execute()) {
                echo "<script>
                Swal.fire({title: 'Berhasil', text: 'Data user berhasil ditambahkan.', icon: 'success', confirmButtonText: 'OK'})
                .then(() => { document.location.href='{$redirect_url}'; });
                </script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Gagal', text: 'Terjadi kesalahan saat menyimpan data.', icon: 'error', confirmButtonText: 'OK'})
                .then(() => { document.location.href='{$redirect_url}'; });
                </script>";
            }
            $stmt->close();
        }
        exit(); // Hentikan script setelah aksi selesai
    }
    
    // Aksi: EDIT USER
    elseif ($action == 'edit_user') {
        $id_user = (int)$_POST['id_user'];
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = $_POST['password']; // Password baru (bisa kosong)
        $level = mysqli_real_escape_string($koneksi, $_POST['level']);
        $prodi_id = (int)$_POST['prodi_id'];

        // Jika password tidak kosong, update password. Jika kosong, biarkan password lama.
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $koneksi->prepare("UPDATE user SET username = ?, password = ?, level = ?, prodi_id = ? WHERE id_user = ?");
            $stmt->bind_param("sssii", $username, $hashed_password, $level, $prodi_id, $id_user);
        } else {
            $stmt = $koneksi->prepare("UPDATE user SET username = ?, level = ?, prodi_id = ? WHERE id_user = ?");
            $stmt->bind_param("ssii", $username, $level, $prodi_id, $id_user);
        }

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({title: 'Berhasil', text: 'Data user berhasil diupdate.', icon: 'success', confirmButtonText: 'OK'})
            .then(() => { document.location.href='{$redirect_url}'; });
            </script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Gagal', text: 'Terjadi kesalahan saat mengupdate data.', icon: 'error', confirmButtonText: 'OK'})
            .then(() => { document.location.href='{$redirect_url}'; });
            </script>";
        }
        $stmt->close();
        exit();
    }

    // Aksi: HAPUS USER
    elseif ($action == 'hapus_user') {
        $id_user = (int)$_POST['id_user'];

        $stmt = $koneksi->prepare("DELETE FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({title: 'Berhasil', text: 'Data user berhasil dihapus.', icon: 'success', confirmButtonText: 'OK'})
            .then(() => { document.location.href='{$redirect_url}'; });
            </script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Gagal', text: 'Terjadi kesalahan saat menghapus data.', icon: 'error', confirmButtonText: 'OK'})
            .then(() => { document.location.href='{$redirect_url}'; });
            </script>";
        }
        $stmt->close();
        exit();
    }
}

// ===================================================================
// BAGIAN 2: LOGIKA PENGAMBILAN DATA (DENGAN PENCARIAN & JOIN)
// ===================================================================
$user_list = [];
$prodi_list = [];
$search_query = "";
$where_clause = "";

// Ambil dulu daftar prodi untuk dropdown di modal
$result_prodi = mysqli_query($koneksi, "SELECT id_prodi, nama_prodi FROM prodi ORDER BY nama_prodi ASC");
while ($data_prodi = mysqli_fetch_assoc($result_prodi)) {
    $prodi_list[] = $data_prodi;
}

// Cek jika ada pencarian
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = mysqli_real_escape_string($koneksi, $_GET['search']);
    // Cari di kolom username, level, nama prodi, atau nama fakultas
    $where_clause = "WHERE u.username LIKE '%$search_query%' OR u.level LIKE '%$search_query%' OR p.nama_prodi LIKE '%$search_query%' OR f.nama_fakultas LIKE '%$search_query%'";
}

// Query utama untuk mengambil data user dengan join
$sql_users = "
    SELECT u.*, p.nama_prodi, f.nama_fakultas 
    FROM user u
    LEFT JOIN prodi p ON u.prodi_id = p.id_prodi
    LEFT JOIN fakultas f ON p.fakultas_id = f.id_fakultas
    $where_clause 
    ORDER BY u.id_user ASC
";
$result_users = mysqli_query($koneksi, $sql_users);
while ($data = mysqli_fetch_assoc($result_users)) {
    $user_list[] = $data;
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid mt-5">
    <div class="card shadow-sm">
        <div class="card-header text-white" style="background-color: #042366;">
            <h4 class="card-title mb-0"><i class="fas fa-users-cog"></i> Manajemen Data User</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalTambahUser" style="background-color: #042366;">
                        <i class="fas fa-plus-circle"></i> Tambah User
                    </button>
                </div>
                <div class="col-md-6">
                    <form action="" method="GET">
                        <input type="hidden" name="page" value="<?= $_GET['page'] ?? 'data-user' ?>">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Username, Level, Prodi..." value="<?= htmlspecialchars($search_query) ?>">
                            <button class="btn text-white" style="background-color: #042366;" type="submit"><i class="fas fa-search"></i> Cari</button>
                            <a href="?page=<?= $_GET['page'] ?? 'data-user' ?>" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Password (Hash)</th>
                            <!-- <th>Program Studi</th> -->
                            <th>Fakultas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($user_list)): ?>
                            <?php $no = 1; foreach ($user_list as $user): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($user['username']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($user['level']); ?></td>
                                    <td title="<?= htmlspecialchars($user['password']); ?>"><?= substr(htmlspecialchars($user['password']), 0, 20); ?>...</td>
                                    <td><?= htmlspecialchars($user['nama_fakultas'] ?? '<em>N/A</em>'); ?></td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditUser<?= $user['id_user'] ?>">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusUser<?= $user['id_user'] ?>">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center p-4">
                                <?php if (!empty($search_query)): ?>
                                    Data dengan keyword "<?= htmlspecialchars($search_query) ?>" tidak ditemukan.
                                <?php else: ?>
                                    Belum ada data user.
                                <?php endif; ?>
                            </td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="" method="post">
        <input type="hidden" name="action" value="tambah_user">
        <div class="modal-header">
          <h5 class="modal-title">Tambah User Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label class="form-label">Username</label><input type="text" class="form-control" name="username" required></div>
          <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
          <div class="mb-3"><label class="form-label">Level</label><select class="form-select" name="level" required><option value="staff">Staff</option><option value="admin">Admin</option></select></div>
          <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select class="form-select" name="prodi_id" required>
                <option value="">-- Pilih Prodi --</option>
                <?php foreach($prodi_list as $prodi): ?>
                <option value="<?= $prodi['id_prodi'] ?>"><?= htmlspecialchars($prodi['nama_prodi']) ?></option>
                <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php foreach ($user_list as $user): ?>
    <div class="modal fade" id="modalEditUser<?= $user['id_user'] ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="" method="post">
            <input type="hidden" name="action" value="edit_user">
            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3"><label class="form-label">Username</label><input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required></div>
              <div class="mb-3"><label class="form-label">Password Baru</label><input type="password" class="form-control" name="password"><small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small></div>
              <div class="mb-3"><label class="form-label">Level</label>
                <select class="form-select" name="level" required>
                    <option value="staff" <?= ($user['level'] == 'staff') ? 'selected' : '' ?>>Staff</option>
                    <option value="admin" <?= ($user['level'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                </select>
              </div>
              <div class="mb-3"><label class="form-label">Program Studi</label>
                <select class="form-select" name="prodi_id" required>
                    <option value="">-- Pilih Prodi --</option>
                    <?php foreach($prodi_list as $prodi): ?>
                    <option value="<?= $prodi['id_prodi'] ?>" <?= ($prodi['id_prodi'] == $user['prodi_id']) ? 'selected' : '' ?>><?= htmlspecialchars($prodi['nama_prodi']) ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-warning">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalHapusUser<?= $user['id_user'] ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="" method="post">
            <input type="hidden" name="action" value="hapus_user">
            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title">Konfirmasi Hapus</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Apakah Anda yakin ingin menghapus user berikut?</p>
              <p><strong><?= htmlspecialchars($user['username']) ?></strong></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php endforeach; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>