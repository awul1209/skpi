<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data User</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Username</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
				</div>
                <div class="col-sm-12">
                    <label class=" col-form-label">Password</label>
					<input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
				</div>
                <div class="col-sm-12">
                <label class="col-form-label">Role</label>
                    <select name="rl" id="rl" class="form-control" required>
                    <option value="">-- Pilih role --</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
		    </div>
	    </div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn bg-gradient-primary">
			<a href="?page=data-guru" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    global $koneksi;
    $nama_guru = htmlspecialchars($_POST['nama_guru']);
    $nip= htmlspecialchars($_POST['nip']);
    $alamat= htmlspecialchars($_POST['alamat']);
    $nohp= htmlspecialchars($_POST['nohp']);
    $role= htmlspecialchars($_POST['rl']);
    $password= htmlspecialchars($_POST['password']);
    // $guru = $_POST['id_guru'];
    $queryGuru = "INSERT INTO guru VALUES ('','$nama_guru', '$nip', '$alamat', '$nohp', '$role', '$password')";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $query_simpan = mysqli_query($koneksi, $queryGuru);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-guru';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-guru';
          }
      })</script>";
    }
}

//selesai proses simpan data