<?php
// Diasumsikan file ini di-include ke dalam file index.php utama Anda
// dan koneksi.php sudah di-require sebelumnya.

// Logika untuk proses hapus data
if (isset($_GET['hapus'])) {
    $id_khp_to_delete = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    // Pastikan untuk menambahkan logika keamanan yang sesuai sebelum menghapus
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

// Inisialisasi variabel pencarian
$search_fakultas = ''; $search_prodi = ''; $search_tahun = ''; $search_periode = '';
$total_bobot_mahasiswa = null;
$nama_mahasiswa_dicari = '';

// Query SQL dasar dengan JOIN lengkap
$sql_base = "SELECT 
                khp.*, 
                mahasiswa.nama_lengkap, 
                krp.nama as nama_kegiatan,
                khp.bobot_disetujui,
                prodi.nama_prodi,
                fakultas.nama_fakultas
             FROM khp
             JOIN mahasiswa ON khp.npm = mahasiswa.npm
             JOIN krp ON khp.kode = krp.kode
             JOIN prodi ON mahasiswa.prodi_id = prodi.id_prodi
             JOIN fakultas on prodi.fakultas_id = fakultas.id_fakultas
             ";

// Siapkan klausa WHERE dengan filter status default
$where_clauses = ["khp.status = 'diterima'"];

// Proses filter jika form disubmit via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cari'])) {
    $search_fakultas = mysqli_real_escape_string($koneksi, $_POST['fakultas']);
    $search_prodi = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $search_tahun = mysqli_real_escape_string($koneksi, $_POST['tahun']);
    $search_periode = mysqli_real_escape_string($koneksi, $_POST['periode']);

    if (!empty($search_fakultas)) $where_clauses[] = "fakultas.id_fakultas = '$search_fakultas'";
    if (!empty($search_prodi)) $where_clauses[] = "prodi.id_prodi = '$search_prodi'";
    if (!empty($search_tahun)) $where_clauses[] = "khp.tahun = '$search_tahun'";
    if (!empty($search_periode)) $where_clauses[] = "khp.periode = '$search_periode'";
}

// Gabungkan semua kondisi WHERE
if (count($where_clauses) > 0) {
    $sql_base .= " WHERE " . implode(' AND ', $where_clauses);
}

$sql_base .= " ORDER BY khp.created_at DESC";
$result = mysqli_query($koneksi, $sql_base);

// Ambil semua hasil ke array
$khp_list = [];
while ($row = mysqli_fetch_assoc($result)) {
    $khp_list[] = $row;
}

// Logika perhitungan total bobot disesuaikan
$is_single_student = false;
if (!empty($khp_list)) {
    $first_npm = $khp_list[0]['npm'];
    $is_single_student = true;
    foreach ($khp_list as $item) {
        if ($item['npm'] !== $first_npm) {
            $is_single_student = false;
            break;
        }
    }
}
if ($is_single_student) {
    $npm_untuk_total = $khp_list[0]['npm'];
    $nama_mahasiswa_dicari = $khp_list[0]['nama_lengkap'];
    $query_total = "SELECT SUM(khp.bobot_disetujui) as total_bobot FROM khp WHERE khp.npm = '$npm_untuk_total' AND khp.status = 'diterima'";
    $hasil_total = mysqli_query($koneksi, $query_total);
    $data_total = mysqli_fetch_assoc($hasil_total);
    $total_bobot_mahasiswa = $data_total['total_bobot'] ?? 0;
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
            <form action="?page=data-skpi-admin" method="post" class="mb-3">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <select name="fakultas" id="fakultas" class="form-select">
                            <option value="">-- Semua Fakultas --</option>
                            <?php
                                $q_fakultas = mysqli_query($koneksi, "SELECT * FROM fakultas ORDER BY nama_fakultas");
                                while($d_fak = mysqli_fetch_assoc($q_fakultas)) {
                                    $selected = ($d_fak['id_fakultas'] == $search_fakultas) ? 'selected' : '';
                                    echo "<option value='{$d_fak['id_fakultas']}' $selected>" . htmlspecialchars($d_fak['nama_fakultas']) . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="prodi" class="form-label">Program Studi</label>
                         <select name="prodi" id="prodi" class="form-select">
                            <option value="">-- Semua Prodi --</option>
                             <?php
                                $q_prodi = mysqli_query($koneksi, "SELECT * FROM prodi ORDER BY nama_prodi");
                                while($d_prodi = mysqli_fetch_assoc($q_prodi)) {
                                    $selected = ($d_prodi['id_prodi'] == $search_prodi) ? 'selected' : '';
                                    echo "<option value='{$d_prodi['id_prodi']}' $selected>" . htmlspecialchars($d_prodi['nama_prodi']) . "</option>";
                                }
                            ?>
                        </select>
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
                    </div>
                </div>
            </form>
            
           <hr>
            <div>
                <a href="?page=data-skpi-admin" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Reset Filter</a>

                <?php
                // PERUBAHAN: Tombol cetak hanya akan muncul jika ada hasil data dari filter
                if (!empty($khp_list)) :
                    // Menyiapkan parameter filter yang sedang aktif untuk link cetak
                    $print_params = [
                        'fakultas' => $search_fakultas,
                        'prodi' => $search_prodi,
                        'tahun' => $search_tahun,
                        'periode' => $search_periode
                    ];
                    $print_params = array_filter($print_params); // Hapus filter yang kosong
                    $print_query_string = http_build_query($print_params);
                ?>
                    <a href="admin/hasil_khp/cetak_laporan_skpi.php?<?= $print_query_string ?>" target="_blank" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Cetak Laporan PDF
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

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
                                    <td class="text-center fw-bold"><?= htmlspecialchars($row['bobot_disetujui']) ?></td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <button type="button" class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalFile<?= $row['id'] ?>" title="Lihat File"><i class="bi bi-eye-fill"></i></button>
                                        <a href="dist/img/file_skpi_mhs/<?= htmlspecialchars($row['file']) ?>" class="btn btn-success btn-sm me-1" title="Download File" download><i class="bi bi-download"></i></a>
                                        <a href="?page=hasil-khp&hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="10" class="text-center">Tidak ada data yang ditemukan. Silakan sesuaikan filter Anda.</td></tr>
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
    // Inisialisasi DataTable untuk pengurutan dan pencarian sisi klien (opsional)
    $('#hasilKhpTable').DataTable();
});
</script>