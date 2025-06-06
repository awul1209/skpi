<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM guru WHERE id_guru='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $row = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Edit Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_guru" name="id_guru" value="<?= $row[
        'id_guru'
    ] ?>" required>
    
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Nama Guru</label>
					<input type="text" class="form-control" id="nama_guru" name="nama_guru"value="<?= $row['nama_guru'] ?>" required>
				</div>
                <div class="col-sm-12">
                    <label class=" col-form-label">NIP</label>
					<input type="text" class="form-control" id="nip" name="nip"value="<?= $row['nip'] ?>" required>
				</div>
                <div class="col-sm-12">
                    <label class=" col-form-label">Alamat</label>
					<input type="text" class="form-control" id="alamat" name="alamat"value="<?= $row['alamat'] ?>" required>
				</div>
                <div class="col-sm-12">
                    <label class=" col-form-label">No HP</label>
					<input type="text" class="form-control" id="nohp" name="nohp"value="<?= $row['nohp'] ?>" required>
				</div>
                <div class="col-sm-12">
                    <label class="col-form-label">Role</label>
                    <select name="rl" id="rl" class="form-control" required>
                        <option value="">-- Pilih role --</option>
                        <?php
                            //menhecek data yg dipilih sebelumnya
                            if ($row['rl'] == "guru") echo "<option value='guru' selected>guru</option>";
                            else echo "<option value='guru'>guru</option>";

                            if ($row['rl'] == "admin") echo "<option value='admin' selected>admin</option>";
                            else echo "<option value='admin'>admin</option>";
                        ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label class="col-form-label">Password</label>
					<input type="text" class="form-control" id="password" name="password"value="<?= $row['password'] ?>" required>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Ubah" class="btn bg-gradient-primary">
			<a href="?page=data-guru" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $id = htmlspecialchars($_POST['id_guru']);
    $nama_guru = htmlspecialchars($_POST['nama_guru']);
    $nip= htmlspecialchars($_POST['nip']);
    $alamat= htmlspecialchars($_POST['alamat']);
    $nohp= htmlspecialchars($_POST['nohp']);
    $role= htmlspecialchars($_POST['rl']);
    $password= htmlspecialchars($_POST['password']);
    //mulai proses ubah data
    $sql_ubah = "UPDATE guru SET
    nama_guru='$nama_guru',
    nip='$nip',
    alamat='$alamat',
    nohp='$nohp',
    rl='$role',
    password='$password'
    WHERE id_guru='$id'
    ";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-guru';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-guru';
          }
      })</script>";
    }
}
//selesai proses simpan data

