<?php
$query_mhs=mysqli_query($koneksi,"SELECT * FROM view_mhs WHERE npm='$data_id'");
$data_mhs=mysqli_fetch_assoc($query_mhs);
?>
    <div class="header-bio">
        <h3>Form Edit Biodata Mahasiswa</h3>
    </div>
    <form action="" method="post">
<div class="biodata" style="margin-top: 0px;">
    <div class="kiri">

        <!-- identitas -->
        <div class="kotak-identitas">
        <h2>Identitas Mahasiswa</h2>
                <table>
                <tr>
                    <td><strong>NPM</strong></td>
                    <td><input type="text" class="form-control" name="npm" value="<?= $data_mhs['npm'] ?>" readonly> </td>
                </tr>
                <tr>
                    <td><strong>Nama Lengkap</strong></td>
                    <td><input type="text" class="form-control" name="nama_mhs" value="<?= $data_mhs['nama_lengkap'] ?>"> </td>
                </tr>
                <tr>
                    <td><strong>Prodi</strong></td>
                    <td><input type="text" class="form-control" name="prodi" value=" <?= $data_mhs['nama_prodi'] ?>" readonly> </td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td><textarea class="form-control" name="alamat_mhs" id=""><?= $data_mhs['alamat'] ?></textarea> </td>
                </tr>
                <tr>
                    <td><strong>No. Tlp</strong></td>
                    <td><input type="text" class="form-control" name="nohp_mhs" value="<?= $data_mhs['no_tlp'] ?>"> </td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin</strong></td>
                    <td><input type="text" class="form-control" name="jk_mhs" value="<?= $data_mhs['jenis_kelamin'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Tempat Lahir</strong></td>
                    <td><input type="text" class="form-control" name="tmp_lahir_mhs" value="<?= $data_mhs['tempat_lahir'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Tanggal Lahir</strong></td>
                    <td><input type="date" class="form-control" name="tgl_lahir_mhs" value="<?= $data_mhs['tanggal_lahir'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Agama</strong></td>
                    <td><input type="text" class="form-control" name="agama_mhs" value="<?= $data_mhs['agama'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Biaya</strong></td>
                    <td><input type="text" class="form-control" name="biaya_mhs" value="<?= $data_mhs['biaya'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td><input id="email" type="text" class="form-control" name="email_mhs" value="<?= $data_mhs['email'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Tinggal bersama</strong></td>
                    <td><input type="text" class="form-control" name="tinggal_mhs" value="<?= $data_mhs['tinggal_bersama'] ?>"></td>
                </tr>
                </table>
        </div>

        <!-- kondisi -->
         <div class="kotak-kondisi">
         <h2>Kondisi Jasmani</h2>
         <table>
                <tr>
                    <td><strong>Berat Badan</strong></td>
                    <td><input type="text" class="form-control" name="bb_mhs" value="<?= $data_mhs['berat_badan'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Tinggi Badan</strong></td>
                    <td><input type="text" class="form-control" name="tb_mhs" value="<?= $data_mhs['tinggi_badan'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Golongan Darah</strong></td>
                    <td><input type="text" class="form-control" name="darah_mhs" value="<?= $data_mhs['golongan_darah'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Penyakit Yang Diderita</strong></td>
                    <td><input type="text" class="form-control" name="penyakit_mhs" value="<?= $data_mhs['penyakit_diderita'] ?>"></td>
                </tr>
                
                </table>
         </div>
         <!-- end kondisi -->
            <!-- saudara -->
        <div class="kotak-saudara-edit">
         <h2>Jumlah Saudara</h2>
         <table>
                <tr>
                    <td><strong>kandung</strong></td>
                    <td><input type="text" class="form-control" name="saudara_kandung" value="<?= $data_mhs['saudara_kandung'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Tiri</strong></td>
                    <td><input type="text" class="form-control" name="saudara_tiri" value="<?= $data_mhs['saudara_tiri'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Angkat</strong></td>
                    <td><input type="text" class="form-control" name="saudara_angkat" value="<?= $data_mhs['saudara_angkat'] ?>"></td>
                </tr>
                
                </table>
         </div>
         <!-- end saudara -->
    </div>
    <div class="kanan">

        <!-- ayah -->
        <div class="kotak-ayah">
         <h2>Ayah Kandung</h2>
         <table>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td><input type="text" class="form-control" name="nama_ayah" value="<?= $data_mhs['nama_ayah'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>No. Telp</strong></td>
                    <td><input type="text" class="form-control" name="nohp_ayah" value="<?= $data_mhs['no_telp_ayah'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Pendidikan</strong></td>
                    <td><input type="text" class="form-control" name="pendidikan_ayah" value="<?= $data_mhs['pendidikan_ayah'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Pekerjaan</strong></td>
                    <td><input type="text" class="form-control" name="pekerjaan_ayah" value="<?= $data_mhs['pekerjaan_ayah'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Jumlah Penghasilan</strong></td>
                    <td><input type="text" class="form-control" name="penghasilan_ayah" value="<?= $data_mhs['penghasilan_ayah'] ?>"></td>
                </tr>
                
                </table>
         </div>
         <!-- end ayah -->

         <!-- ibu -->
        <div class="kotak-ibu">
         <h2>Ibu Kandung</h2>
         <table>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td><input type="text" class="form-control" name="nama_ibu" value="<?= $data_mhs['nama_ibu'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>No. Telp</strong></td>
                    <td><input type="text" class="form-control" name="nohp_ibu" value="<?= $data_mhs['no_telp_ibu'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Pendidikan</strong></td>
                    <td><input type="text" class="form-control" name="pendidikan_ibu" value="<?= $data_mhs['pendidikan_ibu'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Pekerjaan</strong></td>
                    <td><input type="text" class="form-control" name="pekerjaan_ibu" value="<?= $data_mhs['pekerjaan_ibu'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Jumlah Penghasilan</strong></td>
                    <td><input type="text" class="form-control" name="penghasilan_ibu" value="<?= $data_mhs['penghasilan_ibu'] ?>"></td>
                </tr>
                
                </table>
         </div>
         <!-- end ibu -->

         <!-- wali -->
        <div class="kotak-wali">
         <h2>Wali Mahasiswa</h2>
         <table>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td><input type="text" class="form-control" name="nama_wali" value="<?= $data_mhs['nama_wali'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Hubungan Keluarga</strong></td>
                    <td><input type="text" class="form-control" name="hubungan_wali" value="<?= $data_mhs['hubungan_wali'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>No. Telp</strong></td>
                    <td><input type="text" class="form-control" name="nohp_wali" value="<?= $data_mhs['no_telp_wali'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Pendidikan</strong></td>
                    <td><input type="text" class="form-control" name="pendidikan_wali" value="<?= $data_mhs['pendidikan_wali'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Pekerjaan</strong></td>
                    <td><input type="text" class="form-control" name="pekerjaan_wali" value="<?= $data_mhs['pekerjaan_wali'] ?>"></td>
                </tr>
                <tr>
                    <td><strong>Jumlah Penghasilan</strong></td>
                    <td><input type="text" class="form-control" name="penghasilan_wali" value="<?= $data_mhs['penghasilan_wali'] ?>"></td>
                </tr>
                
                </table>
         </div>
         <!-- end wali -->

         <!-- skripsi -->
        <div class="kotak-skripsi">
         <h2>Judul Skripsi</h2>
         <table>
                <tr>
                    <td><strong>Judul</strong></td>
                    <td><textarea class="form-control" name="skripsi" id=""><?= $data_mhs['skripsi'] ?></textarea> </td>
                </tr>
                
                </table>
         </div>
         <!-- end skripsi -->
    </div>

</div>
<footer class="footer-bio">
    <button class="btn btn-danger"><a href="?page=biodata" class="text-white text-decoration-none">Kembali</a></button>
    <button class="btn btn-primary" type="submit" name="ubahMhs">Simpan</button>
</footer>

</form>

<?php  
if(isset($_POST['ubahMhs'])){
    $npm=htmlspecialchars($_POST['npm']);
    $nama_mhs=htmlspecialchars($_POST['nama_mhs']);
    $prodi=htmlspecialchars($_POST['prodi']);
    $nohp_mhs=htmlspecialchars($_POST['nohp_mhs']);
    $alamat_mhs=htmlspecialchars($_POST['alamat_mhs']);
    $jk_mhs=htmlspecialchars($_POST['jk_mhs']);
    $tmp_mhs=htmlspecialchars($_POST['tmp_lahir_mhs']);
    $tgl_mhs=htmlspecialchars($_POST['tgl_lahir_mhs']);
    $agama_mhs=htmlspecialchars($_POST['agama_mhs']);
    $biaya_mhs=htmlspecialchars($_POST['biaya_mhs']);
    $email_mhs=htmlspecialchars($_POST['email_mhs']);
    $tinggal_mhs=htmlspecialchars($_POST['tinggal_mhs']);

    $bb_mhs=htmlspecialchars($_POST['bb_mhs']);
    $tb_mhs=htmlspecialchars($_POST['tb_mhs']);
    $darah_mhs=htmlspecialchars($_POST['darah_mhs']);
    $penyakit_mhs=htmlspecialchars($_POST['penyakit_mhs']);

    $saudara_kandung=htmlspecialchars($_POST['saudara_kandung']);
    $saudara_tiri=htmlspecialchars($_POST['saudara_tiri']);
    $saudara_angkat=htmlspecialchars($_POST['saudara_angkat']);

    $nama_ayah=htmlspecialchars($_POST['nama_ayah']);
    $nohp_ayah=htmlspecialchars($_POST['nohp_ayah']);
    $pendidikan_ayah=htmlspecialchars($_POST['pendidikan_ayah']);
    $pekerjaan_ayah=htmlspecialchars($_POST['pekerjaan_ayah']);
    $penghasilan_ayah=!empty($_POST['penghasilan_ayah']) ? $_POST['penghasilan_ayah'] : 'NULL';


    $nama_ibu=htmlspecialchars($_POST['nama_ibu']);
    $nohp_ibu=htmlspecialchars($_POST['nohp_ibu']);
    $pendidikan_ibu=htmlspecialchars($_POST['pendidikan_ibu']);
    $pekerjaan_ibu=htmlspecialchars($_POST['pekerjaan_ibu']);
    $penghasilan_ibu=!empty($_POST['penghasilan_ibu']) ? $_POST['penghasilan_ibu'] : 'NULL';

    $nama_wali=htmlspecialchars($_POST['nama_wali']);
    $hubungan_wali=htmlspecialchars($_POST['hubungan_wali']);
    $nohp_wali=htmlspecialchars($_POST['nohp_wali']);
    $pendidikan_wali=htmlspecialchars($_POST['pendidikan_wali']);
    $pekerjaan_wali=htmlspecialchars($_POST['pekerjaan_wali']);
    $penghasilan_wali=htmlspecialchars($_POST['penghasilan_wali']);

    $skripsi=htmlspecialchars($_POST['skripsi']);
    
    $update_mhs=mysqli_query($koneksi,"UPDATE mahasiswa SET 
    nama_lengkap='$nama_mhs',
    alamat='$alamat_mhs',
    no_tlp='$nohp_mhs',
    jenis_kelamin='$jk_mhs',
    tempat_lahir='$tmp_mhs',
    tanggal_lahir='$tgl_mhs',
    agama='$agama_mhs',
    biaya='$biaya_mhs',
    email='$email_mhs',
    skripsi='$skripsi',
    berat_badan='$bb_mhs',
    tinggi_badan='$tb_mhs',
    golongan_darah='$darah_mhs',
    penyakit_diderita='$penyakit_mhs',
    saudara_kandung='$saudara_kandung',
    saudara_tiri='$saudara_tiri',
    saudara_angkat='$saudara_angkat'
    WHERE npm='$data_id'
    ");

$update_ortuAyah=mysqli_query($koneksi,"UPDATE orang_tua SET 
nama='$nama_ayah',
no_telp='$nohp_ayah',
pendidikan='$pendidikan_ayah',
pekerjaan='$pekerjaan_ayah',
jumlah_penghasilan='$penghasilan_ayah'
WHERE npm='$data_id' AND hubungan='Ayah'
");

$update_ortuIbu=mysqli_query($koneksi,"UPDATE orang_tua SET 
nama='$nama_ibu',
no_telp='$nohp_ibu',
pendidikan='$pendidikan_ibu',
pekerjaan='$pekerjaan_ibu',
jumlah_penghasilan='$penghasilan_ibu'
WHERE npm='$data_id' AND hubungan='Ibu'
");

$update_wali=mysqli_query($koneksi,"UPDATE wali SET
nama_wali='$nama_wali',
no_telp_wali='$nohp_wali',
pendidikan_wali='$pendidikan_wali',
pekerjaan_wali='$pekerjaan_wali',
penghasilan_wali='$penghasilan_wali',
hubungan='$hubungan_wali'
WHERE npm='$data_id'
");

     if ($update_mhs || $update_ortuAyah || $update_ortuIbu || $update_wali) {
        echo "<script>
        Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            document.location.href='?page=biodata';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            document.location.href='?page=biodata';
            }
        })</script>";
    }

}