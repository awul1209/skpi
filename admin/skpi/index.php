<?php
// Diasumsikan file koneksi.php sudah di-include
// include 'inc/koneksi.php'; 

// Ambil parameter Prodi dari URL
$id_prodi = $_GET['kode'];
$nama_prodi_query = mysqli_query($koneksi, "SELECT nama_prodi, fakultas_id FROM prodi WHERE id_prodi='$id_prodi'");
$row_prodi = mysqli_fetch_assoc($nama_prodi_query);
$fakultas_id = $row_prodi['fakultas_id'];

// ===================================================================
// BAGIAN 1: QUERY SQL BARU UNTUK REKAPITULASI PER MAHASISWA
// ===================================================================
// Query ini mengelompokkan data per mahasiswa, menjumlahkan bobot,
// dan mengambil tanggal kegiatan terakhir yang diterima.
$query = mysqli_query($koneksi, "
    SELECT 
        mahasiswa.npm,
        mahasiswa.nama_lengkap,
        prodi.nama_prodi,
        SUM(krp.bobot) AS total_poin_skpi,
        MAX(khp.updated_at) AS tanggal_terakhir_diterima
    FROM 
        khp
    JOIN 
        mahasiswa ON khp.npm = mahasiswa.npm
    JOIN 
        krp ON khp.kode = krp.kode
    JOIN 
        prodi ON mahasiswa.prodi_id = prodi.id_prodi
    JOIN 
        fakultas ON prodi.fakultas_id = fakultas.id_fakultas
    WHERE 
        khp.status = 'diterima' 
        AND fakultas.id_fakultas = '$fakultas_id' 
        AND mahasiswa.prodi_id = '$id_prodi'
    GROUP BY
        mahasiswa.npm,
        mahasiswa.nama_lengkap,
        prodi.nama_prodi
    ORDER BY
        total_poin_skpi DESC
");

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="card" style="margin-top: 50px;">
    <div class="card-header text-white" style="background-color: #060930;">
        <h3 class="card-title"><i class="bi bi-journal-check"></i> Poin SKPI Mahasiswa Prodi <?= htmlspecialchars($row_prodi['nama_prodi']); ?></h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="rekapTable" class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Terakhir Diterima</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Total Poin SKPI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php
                        $no = 1;
                        while($row = mysqli_fetch_assoc($query)):
                            // Format tanggal agar lebih mudah dibaca
                            $tanggal_diterima = date('d F Y', strtotime($row['tanggal_terakhir_diterima']));
                        ?>
                            <tr>
                                <td class="text-center"><b><?= $no++; ?></b></td>
                                <td><?= $tanggal_diterima; ?></td>
                                <td><?= htmlspecialchars($row['npm']); ?></td>
                                <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                                <td><?= htmlspecialchars($row['nama_prodi']); ?></td>
                                <td class="text-center fw-bold fs-5 text-primary"><?= htmlspecialchars($row['total_poin_skpi']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center p-4">
                                <div class="alert alert-warning mb-0">
                                    Belum ada data KHP yang diterima untuk Prodi ini.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#rekapTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
        },
        "order": [[ 5, "desc" ]] // Urutkan berdasarkan kolom ke-6 (Poin SKPI) secara descending
    });
});
</script>