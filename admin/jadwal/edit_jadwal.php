<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM jadwal WHERE id_jadwal='".$_GET['kode']."'";
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
    <input type="hidden" class="form-control" id="id_jadwal" name="id_jadwal" value="<?= $row[
        'id_jadwal'
    ] ?>" required>
    
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class="col-form-label">Hari</label>
                    <select name="hari" id="hari" class="form-control select2bs4" required>
                        <option value="">-- Pilih hari --</option>
                        <?php
                            //menhecek data yg dipilih sebelumnya
                            if ($row['hari'] == "Senin") echo "<option value='Senin' selected>Senin</option>";
                            else echo "<option value='Senin'>Senin</option>";

                            if ($row['hari'] == "Selasa") echo "<option value='Selasa' selected>Selasa</option>";
                            else echo "<option value='Selasa'>Selasa</option>";
                            
                            if ($row['hari'] == "Rabu") echo "<option value='Rabu' selected>Rabu</option>";
                            else echo "<option value='Rabu'>Rabu</option>";

                            if ($row['hari'] == "Kamis") echo "<option value='Kamis' selected>Kamis</option>";
                            else echo "<option value='Kamis'>Kamis</option>";

                            if ($row['hari'] == "Jumat") echo "<option value='Jumat' selected>Jumat</option>";
                            else echo "<option value='Jumat'>Jumat</option>";

                            if ($row['hari'] == "Sabtu") echo "<option value='Sabtu' selected>Sabtu</option>";
                            else echo "<option value='Sabtu'>Sabtu</option>";

                            if ($row['hari'] == "Minggu") echo "<option value='Minggu' selected>Minggu</option>";
                            else echo "<option value='Minggu'>Minggu</option>";
                        ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label class="col-form-label">Mata Pelajaran</label>
                    <select name="matpel_id" id="matpel" class="form-control select2bs4" required>
                        <?php
                        // ambil data dari database
                        $query = "SELECT * FROM matpel";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($data = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?php echo $data['id_matpel'] ?>" <?=$row[
                            'matpel_id']==$data[ 'id_matpel'] ? "selected" : null ?>>
                            <?php echo $data['matpel'] ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label class="col-form-label">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control select2bs4" required>
                        <?php
                        // ambil data dari database
                        $query = "SELECT * FROM kelas";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($data = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?php echo $data['id_kelas'] ?>" <?=$row[
                            'kelas_id']==$data[ 'id_kelas'] ? "selected" : null ?>>
                            <?php echo $data['nama_kelas'] ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label class="col-form-label">Guru</label>
                    <select name="guru_id" id="guru_id" class="form-control select2bs4" required>
                        <?php
                        // ambil data dari database
                        $query = "SELECT * FROM guru WHERE rl='guru'";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($data = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?php echo $data['id_guru'] ?>" <?=$row[
                            'guru_id']==$data[ 'id_guru'] ? "selected" : null ?>>
                            <?php echo $data['nama_guru'] ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label class=" col-form-label">Jam</label>
                    <input type="time" class="form-control" id="waktu" name="waktu"value="<?= $row['waktu'] ?>" required>
                </div>
            </div>    
		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Ubah" class="btn bg-gradient-primary">
			<a href="?page=data-jadwal" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $id = htmlspecialchars($_POST['id_jadwal']);
    $hari = htmlspecialchars($_POST['hari']);
    $matpel = htmlspecialchars($_POST['matpel_id']);
    $nama_kelas = htmlspecialchars($_POST['kelas_id']);
    $nama_guru = htmlspecialchars($_POST['guru_id']);
    $waktu = htmlspecialchars($_POST['waktu']);
    //mulai proses ubah data
    $sql_ubah = "UPDATE jadwal SET hari='$hari', matpel_id='$matpel', kelas_id='$nama_kelas', guru_id='$nama_guru', waktu='$waktu' WHERE id_jadwal='$id'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-jadwal';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-jadwal';
          }
      })</script>";
    }
}
//selesai proses simpan data

