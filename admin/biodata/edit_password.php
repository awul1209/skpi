<div class="kotak-pw">
    <h3>Form Ganti Password</h3>
    <form action="" method="POST">
      <div class="form-group">
        <?php
$nama=mysqli_query($koneksi,"SELECT nama_lengkap FROM mahasiswa WHERE npm='$data_id'");
$row=mysqli_fetch_assoc($nama);
        ?>
        <label>Nama Mahasiswa</label>
        <input type="text" value="<?= $row['nama_lengkap'] ?>" disabled>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Password</label>
          <input type="password" placeholder="Masukkan Password" name="password">
        </div>
        <div class="form-group">
          <label>Ketik Ulang Password</label>
          <input type="password" placeholder="Masukkan Ulang Password" name="ulang_password">
        </div>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-kembali"><a href="?page=biodata" class="text-decoration-none text-white">Kembali</a></button>
        <button type="submit" class="btn btn-simpan" name="ubahPw">Simpan</button>
      </div>
    </form>
</div>

<?php
 if(isset($_POST['ubahPw'])){
    $password=htmlspecialchars($_POST['password']);
    $ulang_pw=htmlspecialchars($_POST['ulang_password']);
    	// cek konfirmasi password
        if( $password !== $ulang_pw ) {
            echo "<script>
                    alert('konfirmasi password tidak sesuai!');
                  </script>";
            return false;
        }
        $password_acak = password_hash($password, PASSWORD_DEFAULT);
        $query_update=mysqli_query($koneksi,"UPDATE mahasiswa SET password = '$password_acak' WHERE npm='$data_id'");

        if ($query_update) {
            echo "<script>
            Swal.fire({title: 'Berhasil diubah',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                document.location.href='?page=biodata';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Gagal diubah',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                document.location.href='?page=biodata';
                }
            })</script>";
        }
 }
 ?>

