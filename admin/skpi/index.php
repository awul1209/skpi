<?php  
$id_prodi=$_GET['kode'];
$nama_prodi=mysqli_query($koneksi,"SELECT nama_prodi FROM prodi where id_prodi='$id_prodi'");
$row_prodi=mysqli_fetch_assoc($nama_prodi);
?>

<!-- Include jQuery and DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">




<!-- Tabel Data Siswa dengan DataTables -->
<div class="card" style="margin-top: 50px;">
  <div class="card-header text-white" style="background-color: #060930;">
    <h3 class="card-title"><i class="fa fa-table"></i> Data SKPI Prodi <?= $row_prodi['nama_prodi']; ?></h3>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
                <th>No</th>
                <th>Tanggal Diterima</th>
                <th>Npm</th>
                <th>Nama</th>
                <!-- <th>Prodi</th> -->
                <th>Kategori</th>
                <th>Judul (Idn)</th>
                <th>Judul (Eng)</th>
                <th>file</th>
                <th>Skor</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
           $total_bobot = 0;
                    $query=mysqli_query($koneksi,"SELECT khp.id AS id_khp, krp.kategori,khp.npm,khp.updated_at, krp.bobot, prodi.nama_prodi,khp.*, mahasiswa.*
                    FROM khp
                    JOIN mahasiswa ON khp.npm = mahasiswa.npm
                    JOIN krp on khp.kode=krp.kode
                    JOIN prodi on mahasiswa.prodi_id=prodi.id_prodi
                    JOIN fakultas on prodi.fakultas_id=fakultas.id_fakultas
                    WHERE  khp.status = 'diterima' AND id_fakultas='$fakultas_id' AND mahasiswa.prodi_id='$id_prodi'");
                    while($row = mysqli_fetch_assoc($query)) { 
                        $total_bobot += $row['bobot'];
                        $tanggal = date('Y-m-d', strtotime($row['updated_at']));
                        ?>
                        <tr>
                            <td class="text-center"><b><?= $no++; ?></b></td>
                            <td><?= $tanggal; ?></td>
                            <td><?= $row['npm'] ?></td>
                            <td><?= $row['nama_lengkap'] ?></td>
                            <!-- <td><?= $row['nama_prodi'] ?></td> -->
                            <td><?= $row['kategori'] ?></td>
                            <td><?= $row['nama_b_indo'] ?></td>
                            <td><?= $row['nama_b_inggris'] ?></td>
                           
                            <td>
                               <a href="" data-bs-toggle="modal" data-bs-target="#modalView<?= $row['id_khp'] ?>" title="View">
                                   <i style="font-size: 20px;" class="bi bi-eye text-decoration-none"></i>
                                </a>
                              <br>
                              <a href="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" title="Download" download>
                                <i style="font-size: 20px;" class="bi bi-cloud-download text-decoration-none"></i>
                              </a>
                            </td>
                            <td class="text-center"><?= $row['bobot'] ?></td>
                            <!-- <td class="text-center"><button class="btn text-white">Setujui</button></td> -->
                        </tr>
                        
                      <!-- modal view -->
                      <div class="modal fade" id="modalView<?= $row['id_khp'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-md">
                      <div class="modal-content">
                      <div class="modal-header">
                      <h1 class="modal-title" id="exampleModalLabel">File Kegiatan - <?= $row['kategori'] ?></h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                      </div>
                      <div class="modal-body">
                      <iframe src="././dist/img/file_skpi_mhs/<?= $row['file'] ?>" width="100%" height="600px"></iframe>


                      <!-- Tombol -->
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                      </div>
                      </form>
                      </div>
                      </div>
                      </div>
                      </div>
                      <!-- end modal view -->
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables Initialization -->
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "pageLength": 5,
      "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
