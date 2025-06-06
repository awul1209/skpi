<?php 
$querymatpel = mysqli_query($koneksi, "SELECT * FROM matpel");
$querykelas = mysqli_query($koneksi, "SELECT * FROM kelas");
$queryguru = mysqli_query($koneksi, "SELECT * FROM guru WHERE rl='guru'");
?>
<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                <label class="col-form-label">Hari</label>
                    <select name="hari" id="hari" class="form-control select2bs4" required>
                    <option value="">-- Pilih hari --</option>
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label for="id_matpel" class="form-label">Mata Pelajaran</label>
                    <select name="id_matpel" id="id_matpel" class="form-control select2bs4" required>
                        <option value="">Pilih matpel</option>
                        <?php while ($kelas = mysqli_fetch_assoc($querymatpel)) { ?>
                            <option value="<?= $kelas["id_matpel"]; ?>"><?= $kelas["matpel"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label for="id_kelas" class="form-label">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-control select2bs4" required>
                        <option value="">Pilih kelas</option>
                        <?php while ($kelas = mysqli_fetch_assoc($querykelas)) { ?>
                            <option value="<?= $kelas["id_kelas"]; ?>"><?= $kelas["nama_kelas"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label for="id_guru" class="form-label">Guru</label>
                    <select name="id_guru" id="id_guru" class="form-control select2bs4" required>
                        <option value="">Pilih guru</option>
                        <?php while ($kelas = mysqli_fetch_assoc($queryguru)) { ?>
                            <option value="<?= $kelas["id_guru"]; ?>"><?= $kelas["nama_guru"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label class=" col-form-label">Jam</label>
					<input type="text" class="form-control" id="waktu" name="waktu" placeholder="" required>
				</div>
		    </div>
            </div>
	    </div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn bg-gradient-primary">
			<a href="?page=data-jadwal" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
   
    //mulai proses simpan data
    global $koneksi;
    $hari = htmlspecialchars($_POST['hari']);
    $id_matpel = htmlspecialchars($_POST['id_matpel']);
    $id_kelas = htmlspecialchars($_POST['id_kelas']);
    $id_guru = htmlspecialchars($_POST['id_guru']);
    $waktu = htmlspecialchars($_POST['waktu']);
    // $kelas = $_POST['id_kelas'];
    $queryjadwal = "INSERT INTO jadwal VALUES ('', '$hari', '$id_matpel', '$id_kelas', '$id_guru', '$waktu')";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $query_simpan = mysqli_query($koneksi, $queryjadwal);
    
    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-jadwal';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-jadwal';
          }
      })</script>";
    }
}

//selesai proses simpan data

