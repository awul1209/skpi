 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
       $action = $_POST['action'];
    
    // Siapkan URL untuk redirect kembali ke halaman sebelumnya
    // Ini penting agar filter ?kodefk= atau ?kodepr= tidak hilang
    $redirect_url = $_SERVER['HTTP_REFERER'];

    // ===================================================================
    // PROSES TAMBAH MAHASISWA
    // ===================================================================
    if ($action == 'tambah') {
        $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
        $prodi_id = mysqli_real_escape_string($koneksi, $_POST['prodi_id']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        $no_tlp = mysqli_real_escape_string($koneksi, $_POST['no_tlp']);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $pw = password_hash('mahasiswa', PASSWORD_DEFAULT);

        $cek_npm = mysqli_query($koneksi, "SELECT npm FROM mahasiswa WHERE npm='$npm'");
        if (mysqli_num_rows($cek_npm) > 0) {
            // === NOTIFIKASI GAGAL ===
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal',text: 'NPM {$npm} sudah terdaftar!',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                    document.location.href='{$redirect_url}';
                }
            })</script>";
        } else {
            $koneksi->begin_transaction();
            try {
                // INSERT mahasiswa
                $stmt_mhs = $koneksi->prepare("INSERT INTO mahasiswa (npm, nama_lengkap, prodi_id, alamat, no_tlp, jenis_kelamin, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt_mhs->bind_param("ssissss", $npm, $nama, $prodi_id, $alamat, $no_tlp, $jenis_kelamin, $pw);
                if (!$stmt_mhs->execute()) throw new Exception("Gagal menyimpan data mahasiswa.");
                $stmt_mhs->close();

                // INSERT Ayah & Ibu
                $hubungan_ayah = 'Ayah';
                $stmt_ayah = $koneksi->prepare("INSERT INTO orang_tua (npm, hubungan) VALUES (?, ?)");
                $stmt_ayah->bind_param("ss", $npm, $hubungan_ayah);
                if (!$stmt_ayah->execute()) throw new Exception("Gagal menyimpan data Ayah.");
                $stmt_ayah->close();

                $hubungan_ibu = 'Ibu';
                $stmt_ibu = $koneksi->prepare("INSERT INTO orang_tua (npm, hubungan) VALUES (?, ?)");
                $stmt_ibu->bind_param("ss", $npm, $hubungan_ibu);
                if (!$stmt_ibu->execute()) throw new Exception("Gagal menyimpan data Ibu.");
                $stmt_ibu->close();
                
                $koneksi->commit();

                // === NOTIFIKASI SUKSES ===
                echo "<script>
                Swal.fire({title: 'Tambah Data Berhasil',text: 'Data mahasiswa berhasil ditambahkan.',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                        document.location.href='{$redirect_url}';
                    }
                })</script>";

            } catch (Exception $e) {
                $koneksi->rollback();
                // === NOTIFIKASI GAGAL ===
                echo "<script>
                Swal.fire({title: 'Tambah Data Gagal',text: 'Terjadi kesalahan: {$e->getMessage()}',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                        document.location.href='{$redirect_url}';
                    }
                })</script>";
            }
        }
        exit(); // Hentikan eksekusi setelah menampilkan alert
    }
    // ===================================================================
    // PROSES EDIT MAHASISWA
    // ===================================================================
    elseif ($action == 'edit') {
        $npm_lama = mysqli_real_escape_string($koneksi, $_POST['npm_lama']);
        $npm_baru = mysqli_real_escape_string($koneksi, $_POST['npm']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
        $prodi_id = mysqli_real_escape_string($koneksi, $_POST['prodi_id']);
        $jk = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $tlp = mysqli_real_escape_string($koneksi, $_POST['no_tlp']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

        $koneksi->begin_transaction();
        try {
            $stmt_mhs = $koneksi->prepare("UPDATE mahasiswa SET npm=?, nama_lengkap=?, prodi_id=?, jenis_kelamin=?, no_tlp=?, alamat=? WHERE npm=?");
            $stmt_mhs->bind_param("ssissss", $npm_baru, $nama, $prodi_id, $jk, $tlp, $alamat, $npm_lama);
            if (!$stmt_mhs->execute()) throw new Exception("Gagal mengupdate data mahasiswa.");
            $stmt_mhs->close();

            if ($npm_lama !== $npm_baru) {
                $stmt_ortu = $koneksi->prepare("UPDATE orang_tua SET npm = ? WHERE npm = ?");
                $stmt_ortu->bind_param("ss", $npm_baru, $npm_lama);
                if (!$stmt_ortu->execute()) throw new Exception("Gagal mengupdate NPM di data orang tua.");
                $stmt_ortu->close();
            }
            
            $koneksi->commit();
            // === NOTIFIKASI SUKSES ===
            echo "<script>
            Swal.fire({title: 'Update Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                    document.location.href='{$redirect_url}';
                }
            })</script>";

        } catch (Exception $e) {
            $koneksi->rollback();
            // === NOTIFIKASI GAGAL ===
            echo "<script>
            Swal.fire({title: 'Update Data Gagal',text: 'Terjadi kesalahan: {$e->getMessage()}',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                    document.location.href='{$redirect_url}';
                }
            })</script>";
        }
        exit(); // Hentikan eksekusi setelah menampilkan alert
    }
    // ===================================================================
    // PROSES HAPUS MAHASISWA
    // ===================================================================
    elseif ($action == 'hapus') {
        $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
        $koneksi->begin_transaction();
        try {
            $stmt_ortu = $koneksi->prepare("DELETE FROM orang_tua WHERE npm = ?");
            $stmt_ortu->bind_param("s", $npm);
            if (!$stmt_ortu->execute() && $stmt_ortu->error) throw new Exception("Gagal menghapus data orang tua.");
            $stmt_ortu->close();

            $stmt_mhs = $koneksi->prepare("DELETE FROM mahasiswa WHERE npm = ?");
            $stmt_mhs->bind_param("s", $npm);
            if (!$stmt_mhs->execute()) throw new Exception("Gagal menghapus data mahasiswa.");
            $stmt_mhs->close();

            $koneksi->commit();
            // === NOTIFIKASI SUKSES ===
            echo "<script>
            Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                    document.location.href='{$redirect_url}';
                }
            })</script>";

        } catch (Exception $e) {
            $koneksi->rollback();
            // === NOTIFIKASI GAGAL ===
            echo "<script>
            Swal.fire({title: 'Hapus Data Gagal',text: 'Terjadi kesalahan: {$e->getMessage()}',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                    document.location.href='{$redirect_url}';
                }
            })</script>";
        }
        exit(); // Hentikan eksekusi setelah menampilkan alert
    }
}


// ===================================================================
// BAGIAN 2: LOGIKA PENGAMBILAN DATA (LEBIH EFISIEN)
// ===================================================================

$mahasiswa_list = [];
$header_title = "Data Mahasiswa";
$is_admin_view = false; // Flag untuk menandai tampilan admin

$sql_base = "SELECT mahasiswa.*, prodi.nama_prodi FROM mahasiswa JOIN prodi ON mahasiswa.prodi_id = prodi.id_prodi";
$where_clause = "";

// Cek apakah ini tampilan per fakultas (untuk admin)
if (isset($_GET['kodefk'])) {
    $is_admin_view = true;
    $id_fakultas = mysqli_real_escape_string($koneksi, $_GET['kodefk']);
    $where_clause = " WHERE prodi.fakultas_id = '$id_fakultas'";
    
    $fakultas_query = mysqli_query($koneksi, "SELECT nama_fakultas FROM fakultas WHERE id_fakultas = '$id_fakultas'");
    if ($fakultas_data = mysqli_fetch_assoc($fakultas_query)) {
        $header_title = "Data Mahasiswa Fakultas " . htmlspecialchars($fakultas_data['nama_fakultas']);
    }
} 
// Cek apakah ini tampilan per prodi (untuk staff)
elseif (isset($_GET['kodepr'])) {
    $id_prodi = mysqli_real_escape_string($koneksi, $_GET['kodepr']);
    $where_clause = " WHERE mahasiswa.prodi_id = '$id_prodi'";

    $prodi_query = mysqli_query($koneksi, "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'");
    if ($prodi_data = mysqli_fetch_assoc($prodi_query)) {
        $header_title = "Data Mahasiswa Prodi " . htmlspecialchars($prodi_data['nama_prodi']);
    }
}

$sql_final = $sql_base . $where_clause . " ORDER BY mahasiswa.nama_lengkap ASC";
$result = mysqli_query($koneksi, $sql_final);

while ($data = mysqli_fetch_assoc($result)) {
    $mahasiswa_list[] = $data;
}
?>



<div class="container-fluid" style="margin-top: 50px;">
    <?php if(isset($_SESSION['pesan_sukses'])): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= $_SESSION['pesan_sukses']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['pesan_sukses']); endif; ?>

    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #060930;">
            <h4 class="card-title mb-0"><i class="bi bi-people-fill"></i> <?= $header_title ?></h4>
        </div>
         <?php if ($is_admin_view): ?>
                <button type="button" class="btn btn-sm mt-2 ml-3 text-white" data-bs-toggle="modal" data-bs-target="#modalTambah" style="width: 160px; background-color: #060930;">
                    <i class="bi bi-plus-circle-fill"></i> Tambah Mahasiswa
                </button>
            <?php endif; ?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr><th>No</th><th>NPM</th><th>Nama</th><th>Gender</th><th>No. HP</th><th>Prodi</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mahasiswa_list)): ?>
                            <?php $no = 1; foreach ($mahasiswa_list as $data): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['npm']); ?></td>
                                    <td><?= htmlspecialchars($data['nama_lengkap']); ?></td>
                                    <td><?= htmlspecialchars($data['jenis_kelamin']); ?></td>
                                    <td><?= htmlspecialchars($data['no_tlp']); ?></td>
                                    <td><?= htmlspecialchars($data['nama_prodi']); ?></td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <button type="button" class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalView<?= $data['npm'] ?>"><i class="bi bi-eye-fill"></i></button>
                                        <?php if ($is_admin_view): ?>
                                            <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data['npm'] ?>"><i class="bi bi-pencil-fill"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['npm'] ?>"><i class="bi bi-trash-fill"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center p-4">Tidak ada data mahasiswa yang ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if ($is_admin_view): ?>
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="" method="post">
        <input type="hidden" name="action" value="tambah">
        <div class="modal-header"><h5 class="modal-title">Tambah Mahasiswa Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3"><label>NPM</label><input type="text" name="npm" class="form-control" required></div>
            <div class="col-md-6 mb-3"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" required></div>
            <div class="col-md-6 mb-3"><label>Jenis Kelamin</label><select name="jenis_kelamin" class="form-select"><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select></div>
            <div class="col-md-6 mb-3"><label>No. Telepon</label><input type="text" name="no_tlp" class="form-control"></div>
            <div class="col-md-12 mb-3"><label>Program Studi</label>
                <select name="prodi_id" class="form-select" required>
                    <option value="">-- Pilih Prodi --</option>
                    <?php
                        $prodi_options_query = mysqli_query($koneksi, "SELECT id_prodi, nama_prodi FROM prodi WHERE fakultas_id = '$id_fakultas' ORDER BY nama_prodi");
                        while($prodi_opt = mysqli_fetch_assoc($prodi_options_query)){
                            echo "<option value='{$prodi_opt['id_prodi']}'>" . htmlspecialchars($prodi_opt['nama_prodi']) . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-12 mb-3"><label>Alamat</label><textarea name="alamat" class="form-control"></textarea></div>
          </div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>


<?php foreach ($mahasiswa_list as $data): ?>

    <div class="modal fade" id="modalView<?= $data['npm'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Detail Mahasiswa</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>NPM:</strong> <?= htmlspecialchars($data['npm']) ?></li>
                                <li class="list-group-item"><strong>Nama:</strong> <?= htmlspecialchars($data['nama_lengkap']) ?></li>
                                <li class="list-group-item"><strong>Prodi:</strong> <?= htmlspecialchars($data['nama_prodi']) ?></li>
                                <li class="list-group-item"><strong>Gender:</strong> <?= htmlspecialchars($data['jenis_kelamin']) ?></li>
                                <li class="list-group-item"><strong>No. HP:</strong> <?= htmlspecialchars($data['no_tlp']) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button></div>
            </div>
        </div>
    </div>

    <?php if ($is_admin_view): ?>
    <div class="modal fade" id="modalEdit<?= $data['npm'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $data['npm'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <form action="" method="post">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="npm_lama" value="<?= htmlspecialchars($data['npm']) ?>">
                <div class="modal-header"><h5 class="modal-title" id="modalEditLabel<?= $data['npm'] ?>">Edit Data: <?= htmlspecialchars($data['nama_lengkap']) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6 mb-3"><label>NPM</label><input type="text" name="npm" class="form-control" value="<?= htmlspecialchars($data['npm']) ?>" required></div>
                    <div class="col-md-6 mb-3"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required></div>
                    <div class="col-md-6 mb-3"><label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="Laki-laki" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3"><label>No. Telepon</label><input type="text" name="no_tlp" class="form-control" value="<?= htmlspecialchars($data['no_tlp']) ?>"></div>
                    <div class="col-md-12 mb-3"><label>Program Studi</label>
                        <select name="prodi_id" class="form-select" required>
                            <option selected value="<?= $data['prodi_id'] ?>"><?= $data['nama_prodi'] ?></option>
                            <?php
                                // Query ini bisa dioptimalkan, tapi untuk kejelasan kita buat lagi di sini
                                $prodi_options_query = mysqli_query($koneksi, "SELECT id_prodi, nama_prodi FROM prodi WHERE fakultas_id = '$id_fakultas' ORDER BY nama_prodi");
                                while($prodi_opt = mysqli_fetch_assoc($prodi_options_query)){
                                    $selected = ($prodi_opt['id_prodi'] == $data['prodi_id']) ? 'selected' : '';
                                    echo "<option value='{$prodi_opt['id_prodi']}' $selected>" . htmlspecialchars($prodi_opt['nama_prodi']) . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mb-3"><label>Alamat</label><textarea name="alamat" class="form-control"><?= htmlspecialchars($data['alamat']) ?></textarea></div>
                  </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-warning">Update Data</button></div>
              </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalHapus<?= $data['npm'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <form action="" method="post">
                <input type="hidden" name="action" value="hapus">
                <input type="hidden" name="npm" value="<?= htmlspecialchars($data['npm']) ?>">
                <div class="modal-header bg-danger text-white"><h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                  <p>Apakah Anda yakin ingin menghapus data mahasiswa berikut?</p>
                  <p><strong><?= htmlspecialchars($data['nama_lengkap']) ?> (NPM: <?= htmlspecialchars($data['npm']) ?>)</strong></p>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger">Ya, Hapus</button></div>
              </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

<?php endforeach; ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#example1').DataTable();
});
</script>

