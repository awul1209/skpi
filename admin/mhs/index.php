<?php
$id_prodi = $_GET['kode'];
$nama_prodi = mysqli_query($koneksi, "SELECT nama_prodi FROM prodi where id_prodi='$id_prodi'");
$row_prodi = mysqli_fetch_assoc($nama_prodi);

// LANGKAH 1 (PERBAIKAN): Ambil semua data ke dalam satu array di awal
$mahasiswa_list = [];
$sql = $koneksi->query("SELECT 
                            mahasiswa.*, 
                            prodi.nama_prodi 
                        FROM 
                            mahasiswa 
                        JOIN 
                            prodi ON mahasiswa.prodi_id = prodi.id_prodi 
                        WHERE 
                            mahasiswa.prodi_id = '$id_prodi'");
while ($data = $sql->fetch_assoc()) {
    $mahasiswa_list[] = $data;
}
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


<div class="card" style="margin-top: 50px;">
    <div class="card-header text-white" style="background-color: #060930;">
        <h3 class="card-title"><i class="fa fa-table"></i> Data Siswa Prodi <?= htmlspecialchars($row_prodi['nama_prodi']); ?></h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama Siswa</th>
                        <th>Gender</th>
                        <th>No.HP</th>
                        <th>Prodi</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // LANGKAH 2 (PERBAIKAN): Loop pertama HANYA untuk membuat baris tabel (TR)
                    $no = 1;
                    foreach ($mahasiswa_list as $data) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['npm']); ?></td>
                            <td style="min-width: 200px;"><?php echo htmlspecialchars($data['nama_lengkap']); ?></td>
                            <td><?php echo htmlspecialchars($data['jenis_kelamin']); ?></td>
                            <td><?php echo htmlspecialchars($data['no_tlp']); ?></td>
                            <td><?= htmlspecialchars($data['nama_prodi']) ?></td>
                            <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                            <td class="text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalView<?= $data['npm'] ?>" title="View" class="text-primary">
                                    <i class="bi bi-eye" style="font-size: 23px;"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    } // Akhir loop pertama
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div> <?php
foreach ($mahasiswa_list as $data) {
?>
    <div class="modal fade" id="modalView<?= $data['npm'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Mahasiswa: <?= htmlspecialchars($data['nama_lengkap']) ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p><strong>NPM:</strong> <?= htmlspecialchars($data['npm']) ?></p>
                    <p><strong>Prodi:</strong> <?= htmlspecialchars($data['nama_prodi']) ?></p>
                    <p><strong>No. HP:</strong> <?= htmlspecialchars($data['no_tlp']) ?></p>
                    <p><strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']) ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php
} // Akhir loop kedua
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example1').DataTable({
            "pageLength": 5,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>