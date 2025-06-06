<?php  
$id_prodi=$_GET['kode'];
$nama_prodi=mysqli_query($koneksi,"SELECT nama_prodi FROM prodi where id_prodi='$id_prodi'");
$row_prodi=mysqli_fetch_assoc($nama_prodi);
?>

<!-- Include jQuery and DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Tabel Data Siswa dengan DataTables -->
<div class="card">
  <div class="card-header text-white" style="background-color: #060930;">
    <h3 class="card-title"><i class="fa fa-table"></i> Data Siswa Prodi <?= $row_prodi['nama_prodi']; ?></h3>
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
          $no = 1;
          $sql = $koneksi->query("SELECT 
              mahasiswa.*, 
              prodi.nama_prodi 
          FROM 
              mahasiswa 
          JOIN 
              prodi ON mahasiswa.prodi_id = prodi.id_prodi 
          WHERE 
              mahasiswa.prodi_id = '$id_prodi';
          ");
          while ($data = $sql->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['npm']; ?></td>
              <td style="min-width: 200px;"><?php echo $data['nama_lengkap']; ?></td>
              <td><?php echo $data['jenis_kelamin']; ?></td>
              <td><?php echo $data['no_tlp']; ?></td>
              <td><?= $data['nama_prodi'] ?></td>
              <td><?php echo $data['alamat']; ?></td>
              <td class="d-flex justify-content-center">
                <a href="#" class="text-primary"><i class="bi bi-eye" style="font-size: 23px;"></i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

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
