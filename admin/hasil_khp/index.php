<?php
// Diasumsikan file koneksi.php sudah di-include
// include 'inc/koneksi.php'; 

// ===================================================================
// BAGIAN 1: PROSES HAPUS & PENCARIAN
// ===================================================================

// Logika untuk proses hapus data
if (isset($_GET['hapus'])) {
    $id_khp_to_delete = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    // ... (kode hapus lengkap dari jawaban sebelumnya) ...
    $delete_query = mysqli_query($koneksi, "DELETE FROM khp WHERE id = '$id_khp_to_delete'");
    if ($delete_query) {
        echo "<script>
            Swal.fire({title: 'Berhasil', text: 'Data KHP telah dihapus.', icon: 'success', timer: 2000, showConfirmButton: false})
            .then(() => { document.location.href = '?page=hasil-khp'; });
        </script>";
    } else {
        echo "<script>Swal.fire({title: 'Gagal', text: 'Terjadi kesalahan.', icon: 'error'});</script>";
    }
    exit;
}

// Inisialisasi variabel
$search_npm = ''; $search_nama = ''; $search_tahun = ''; $search_periode = '';
$total_bobot_mahasiswa = null;
$nama_mahasiswa_dicari = '';

// Query SQL dasar dengan JOIN lengkap
$sql_base = "SELECT 
                khp.*, 
                mahasiswa.nama_lengkap, 
                krp.nama as nama_kegiatan,
                krp.bobot,
                prodi.nama_prodi
             FROM khp
             JOIN mahasiswa ON khp.npm = mahasiswa.npm
             JOIN krp ON khp.kode = krp.kode
             JOIN prodi ON mahasiswa.prodi_id = prodi.id_prodi";

// Siapkan klausa WHERE dengan filter status default
$where_clauses = ["khp.status = 'diterima'"];

// Proses filter jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cari'])) {
    $search_npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
    $search_nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $search_tahun = mysqli_real_escape_string($koneksi, $_POST['tahun']);
    $search_periode = mysqli_real_escape_string($koneksi, $_POST['periode']);

    if (!empty($search_npm)) $where_clauses[] = "khp.npm LIKE '%$search_npm%'";
    if (!empty($search_nama)) $where_clauses[] = "mahasiswa.nama_lengkap LIKE '%$search_nama%'";
    if (!empty($search_tahun)) $where_clauses[] = "khp.tahun = '$search_tahun'";
    if (!empty($search_periode)) $where_clauses[] = "khp.periode = '$search_periode'";
}

// Gabungkan semua kondisi WHERE
if (count($where_clauses) > 1) { // Lebih dari 1 karena 'status' sudah ada
    $sql_base .= " WHERE " . implode(' AND ', $where_clauses);
} else {
    $sql_base .= " WHERE " . $where_clauses[0];
}

$sql_base .= " ORDER BY khp.created_at DESC";
$result = mysqli_query($koneksi, $sql_base);

// Ambil semua hasil ke array
$khp_list = [];
while ($row = mysqli_fetch_assoc($result)) {
    $khp_list[] = $row;
}

// Logika perhitungan total bobot
if (!empty($search_npm) || !empty($search_nama)) {
    if (!empty($khp_list)) {
        $npm_untuk_total = $khp_list[0]['npm'];
        $nama_mahasiswa_dicari = $khp_list[0]['nama_lengkap'];
        $query_total = "SELECT SUM(krp.bobot) as total_bobot FROM khp JOIN krp ON khp.kode = krp.kode WHERE khp.npm = '$npm_untuk_total' AND khp.status = 'diterima'";
        $hasil_total = mysqli_query($koneksi, $query_total);
        $data_total = mysqli_fetch_assoc($hasil_total);
        $total_bobot_mahasiswa = $data_total['total_bobot'] ?? 0;
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid mt-5">
    
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">
            <i class="bi bi-search"></i> Pencarian Data KHP
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="npm" class="form-label">NPM</label>
                        <input type="text" class="form-control" name="npm" id="npm" placeholder="Cari NPM..." value="<?= htmlspecialchars($search_npm) ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="nama" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Cari Nama..." value="<?= htmlspecialchars($search_nama) ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="tahun" class="form-label">Tahun Akademik</label>
                        <select name="tahun" id="tahun" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            <?php
                                for ($i = 2020; $i <= date('Y'); $i++) {
                                    $next = $i + 1;
                                    $tahun_akademik = "$i/$next";
                                    $selected = ($tahun_akademik == $search_tahun) ? 'selected' : '';
                                    echo "<option value='$tahun_akademik' $selected>$tahun_akademik</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="periode" class="form-label">Periode</label>
                        <select name="periode" id="periode" class="form-select">
                            <option value="">-- Semua Periode --</option>
                            <option value="GANJIL" <?= ($search_periode == 'GANJIL') ? 'selected' : '' ?>>Ganjil</option>
                            <option value="GENAP" <?= ($search_periode == 'GENAP') ? 'selected' : '' ?>>Genap</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="cari" class="btn btn-primary w-100"><i class="bi bi-funnel-fill"></i> Filter</button>
                        <a href="?page=hasil-khp" class="btn btn-secondary w-100 mt-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if ($total_bobot_mahasiswa !== null): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white fw-bold"><i class="bi bi-star-fill"></i> Akumulasi Bobot Mahasiswa</div>
        <div class="card-body text-center">
            <h5 class="card-title"><?= htmlspecialchars($nama_mahasiswa_dicari) ?></h5>
            <p class="card-text">Total bobot yang telah diperoleh dari seluruh kegiatan KHP adalah:</p>
            <p class="display-4 fw-bold text-primary"><?= $total_bobot_mahasiswa ?></p>
        </div>
    </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header fw-bold text-white" style="background-color: #060930;"><i class="bi bi-table"></i> Data Hasil Kartu Partisipasi (KHP)</div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="hasilKhpTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th><th>NPM</th><th>Nama Mahasiswa</th><th>Prodi</th><th>Kode</th><th>Nama Kegiatan</th><th>Tahun</th><th>Periode</th><th>Bobot</th><th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($khp_list)): ?>
                            <?php $no = 1; foreach ($khp_list as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['npm']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_prodi']) ?></td>
                                    <td><?= htmlspecialchars($row['kode']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_b_indo']) ?></td>
                                    <td><?= htmlspecialchars($row['tahun']) ?></td>
                                    <td><?= htmlspecialchars($row['periode']) ?></td>
                                    <td class="text-center fw-bold"><?= htmlspecialchars($row['bobot']) ?></td>
                                  <td class="text-center" style="white-space: nowrap;">
                                        <button type="button" class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalFile<?= $row['id'] ?>" title="Lihat File"><i class="bi bi-eye-fill"></i></button>
                                        <a href="dist/img/file_skpi_mhs/<?= htmlspecialchars($row['file']) ?>" class="btn btn-success btn-sm me-1" title="Download File" download><i class="bi bi-download"></i></a>
                                        <a href="?page=hasil-khp&hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="10" class="text-center">Tidak ada data yang ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php foreach ($khp_list as $row): ?>
<div class="modal fade" id="modalFile<?= $row['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $row['id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel<?= $row['id'] ?>">Preview File: <?= htmlspecialchars($row['nama_b_indo']) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php $file_path = "dist/img/file_skpi_mhs/" . rawurlencode(htmlspecialchars($row['file'])); ?>
        <?php if (!empty($row['file']) && file_exists($file_path)): ?>
            <iframe src="<?= $file_path ?>" width="100%" height="500px" style="border: none;"></iframe>
        <?php else: ?>
            <div class="alert alert-warning">File tidak ditemukan atau belum diunggah.</div>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <a href="<?= $file_path ?>" class="btn btn-success" download><i class="bi bi-download"></i> Download File</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#hasilKhpTable').DataTable();
});
</script>