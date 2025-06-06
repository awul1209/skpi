<div class="kotak-foto">
<h3>Form Ganti Foto</h3>
    <form  enctype="multipart/form-data" method="POST" action="">
      <div class="form-row">
        <div class="form-group" style="flex: 1;">
        <?php
$nama=mysqli_query($koneksi,"SELECT nama_lengkap FROM mahasiswa WHERE npm='$data_id'");
$row=mysqli_fetch_assoc($nama);
        ?>
          <label>Nama Mahasiswa</label>
          <input type="text" value="<?= $row['nama_lengkap'] ?>" disabled>
        </div>
        <div class="form-group" style="flex: 1;">
          <label>Foto</label>
          <input type="file" name="foto" accept="image/*" required>
        </div>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-kembali"><a href="?page=biodata" class="text-decoration-none text-white">Kembali</a></button>
        <button type="submit" class="btn btn-upload" name="ubahFoto">Upload</button>
      </div>
    </form>
</div>

<?php
if(isset($_POST['ubahFoto'])){
    $gambar=upload();
$update_foto=mysqli_query($koneksi,"UPDATE mahasiswa SET foto='$gambar' WHERE npm='$data_id'");
if ($update_foto) {
    echo "<script>
    Swal.fire({title: 'Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        document.location.href='?page=biodata';
        }
    })</script>";
} else {
    echo "<script>
    Swal.fire({title: 'Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        document.location.href='?page=biodata';
        }
    })</script>";
}
}

function upload()
{
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    // cek gambar tidak diupload
    if ($error === 4) {
        echo "
        <script>
        alert('pilih gambar');
        </script>
        
        ";
        return false;
    }
    // cek yang di uplod gambar atau tidak
    $ektensigambarvalid = ['jpg', 'jpeg', 'png', 'webp','jfif'];

    $ektensigambar = explode('.', $namafile);
    $ektensigambar = strtolower(end($ektensigambar));
    // cek adakah string didalam array
    if (!in_array($ektensigambar, $ektensigambarvalid)) {
        echo "
        <script>
        alert('yang anda upload bukan gambar');
        </script>
        ";

        return false;
    }
    // cek jika ukuran terlalu besar
    if ($ukuranfile > 90000000) {
        echo "
        <script>
        alert('ukuran gambar terlalu besar');
        </script>
        
        ";
        return false;
    }

    // lolos pengecekan , gambar siap di upload
    // generete nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ektensigambar;

    move_uploaded_file($tmpname, '././dist/img/fotomhs/' . $namafilebaru);

    return $namafilebaru;
}
?>