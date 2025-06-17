<?php
// Diasumsikan file ini di-include ke dalam file index.php utama Anda
// dan koneksi.php sudah di-require sebelumnya.

// ===================================================================
// BAGIAN 1: LOGIKA PEMROSESAN FORM (TAMBAH, EDIT, HAPUS)
// ===================================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    // Menggunakan REQUEST_URI agar parameter ?page= dan ?search= tidak hilang setelah redirect
    $redirect_url = $_SERVER['REQUEST_URI']; 

    // Aksi: TAMBAH KRP
    if ($action == 'tambah_krp') {
        $kode = mysqli_real_escape_string($koneksi, $_POST['kode']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $bobot = (int)$_POST['bobot'];
        $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);

        $cek_kode = mysqli_query($koneksi, "SELECT kode FROM krp WHERE kode = '$kode'");
        if (mysqli_num_rows($cek_kode) > 0) {
            echo "<script>
            Swal.fire({title: 'Gagal', text: 'Kode KRP \"$kode\" sudah ada!', icon: 'error', confirmButtonText: 'OK'})
            .then(() => { document.location.href='{$redirect_url}'; });
            </script>";
        } else {
            $stmt = $koneksi->prepare("INSERT INTO krp (kode, nama, bobot, kategori) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $kode, $nama, $bobot, $kategori);
            if ($stmt->execute()) {
                echo "<script>
                Swal.fire({title: 'Berhasil', text: 'Data KRP berhasil ditambahkan.', icon: 'success', confirmButtonText: 'OK'})
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
        exit();
    }
    
    // Aksi: EDIT KRP
    elseif ($action == 'edit_krp') {
        $id = (int)$_POST['id'];
        $kode = mysqli_real_escape_string($koneksi, $_POST['kode']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $bobot = (int)$_POST['bobot'];
        $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);

        $stmt = $koneksi->prepare("UPDATE krp SET kode = ?, nama = ?, bobot = ?, kategori = ? WHERE id = ?");
        $stmt->bind_param("ssisi", $kode, $nama, $bobot, $kategori, $id);
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({title: 'Berhasil', text: 'Data KRP berhasil diupdate.', icon: 'success', confirmButtonText: 'OK'})
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

    // Aksi: HAPUS KRP
    elseif ($action == 'hapus_krp') {
        $id = (int)$_POST['id'];

        $stmt = $koneksi->prepare("DELETE FROM krp WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({title: 'Berhasil', text: 'Data KRP berhasil dihapus.', icon: 'success', confirmButtonText: 'OK'})
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
// BAGIAN 2: LOGIKA PENGAMBILAN DATA DENGAN PENCARIAN
// ===================================================================
$krp_list = [];
$search_query = "";
$where_clause = "";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = mysqli_real_escape_string($koneksi, $_GET['search']);
    $where_clause = "WHERE kode LIKE '%$search_query%' OR nama LIKE '%$search_query%' OR kategori LIKE '%$search_query%'";
}

$sql = "SELECT * FROM krp $where_clause ORDER BY id ASC";
$result = mysqli_query($koneksi, $sql);
while ($data = mysqli_fetch_assoc($result)) {
    $krp_list[] = $data;
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header text-white" style="background-color: #042366;">
            <h4 class="card-title mb-0"><i class="bi bi-card-list"></i> Manajemen Data KRP</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background-color: #042366;">
                        <i class="bi bi-plus-circle-fill"></i> Tambah Data
                    </button>
                </div>
                <div class="col-md-6">
                    <form action="" method="GET">
                        <input type="hidden" name="page" value="data-krp-admin">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Kode, Nama, atau Kategori..." value="<?= htmlspecialchars($search_query) ?>">
                            <button class="btn text-white" style="background-color: #042366;" type="submit"><i class="bi bi-search"></i> Cari</button>
                            <a href="?page=data-krp-admin" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kegiatan</th>
                            <th>Bobot</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($krp_list)): ?>
                            <?php $no = 1; foreach ($krp_list as $krp): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($krp['kode']); ?></td>
                                    <td><?= htmlspecialchars($krp['nama']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($krp['bobot']); ?></td>
                                    <td><?= htmlspecialchars($krp['kategori']); ?></td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $krp['id'] ?>">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $krp['id'] ?>">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center p-4">
                                <?php if (!empty($search_query)): ?>
                                    Data dengan keyword "<?= htmlspecialchars($search_query) ?>" tidak ditemukan.
                                <?php else: ?>
                                    Belum ada data KRP.
                                <?php endif; ?>
                            </td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="" method="post">
        <input type="hidden" name="action" value="tambah_krp">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data KRP Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="kode" class="form-label">Kode KRP</label>
            <input type="text" class="form-control" id="kode" name="kode" required>
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Kegiatan</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="mb-3">
            <label for="bobot" class="form-label">Bobot</label>
            <input type="number" class="form-control" id="bobot" name="bobot" required>
          </div>
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori" name="kategori" required>
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

<?php foreach ($krp_list as $krp): ?>
    <div class="modal fade" id="modalEdit<?= $krp['id'] ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="" method="post">
            <input type="hidden" name="action" value="edit_krp">
            <input type="hidden" name="id" value="<?= $krp['id'] ?>">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data KRP</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Kode KRP</label>
                <input type="text" class="form-control" name="kode" value="<?= htmlspecialchars($krp['kode']) ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($krp['nama']) ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Bobot</label>
                <input type="number" class="form-control" name="bobot" value="<?= htmlspecialchars($krp['bobot']) ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" name="kategori" value="<?= htmlspecialchars($krp['kategori']) ?>" required>
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

    <div class="modal fade" id="modalHapus<?= $krp['id'] ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="" method="post">
            <input type="hidden" name="action" value="hapus_krp">
            <input type="hidden" name="id" value="<?= $krp['id'] ?>">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title">Konfirmasi Hapus</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Apakah Anda yakin ingin menghapus data berikut?</p>
              <p><strong><?= htmlspecialchars($krp['nama']) ?> (Kode: <?= htmlspecialchars($krp['kode']) ?>)</strong></p>
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