<?php
$query_mhs=mysqli_query($koneksi,"SELECT * FROM view_mhs WHERE npm='$data_id'");
$data_mhs=mysqli_fetch_assoc($query_mhs);
?>
<div class="biodata">
    <div class="kiri">
        <!-- foto -->
        <div class="kotak-foto">
            <div class="foto">
                <img src="././dist/img/fotomhs/<?= $data_mhs['foto'] ?>" alt="" width="150px">
                <h2><?= $data_mhs['nama_lengkap'] ?></h2>
                <p>S1 - <?= $data_mhs['nama_prodi'] ?></p>
            </div>
            <div class="tombol">
                <button id="bt" class="btn text-white" style="font-weight: 100;   background-color:#042366;"><a href="?page=edit-bio" class="text-decoration-none text-white">Edit Biodata</a></button>
                <button id="bt" class="btn text-white" style="font-weight: 100;   background-color:#042366;"><a href="?page=edit-pw" class="text-decoration-none text-white">Edit Password</a></button>
                <button id="bt" class="btn text-white" style="font-weight: 100;   background-color:#042366;"><a href="?page=edit-foto" class="text-decoration-none text-white">Edit Foto</a></button>
            </div>
        </div>

        <!-- identitas -->
        <div class="kotak-identitas">
        <h2>Identitas Mahasiswa</h2>
                <table>
                <tr>
                    <td><strong>NPM</strong></td>
                    <td>: <?= $data_mhs['npm'] ?></td>
                </tr>
                <tr>
                    <td><strong>Nama Lengkap</strong></td>
                    <td>: <?= $data_mhs['nama_lengkap'] ?></td>
                </tr>
                <tr>
                    <td><strong>Prodi</strong></td>
                    <td>: <?= $data_mhs['nama_prodi'] ?></td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>: <?= $data_mhs['alamat'] ?></td>
                </tr>
                <tr>
                    <td><strong>No. Tlp</strong></td>
                    <td>: <?= $data_mhs['no_tlp'] ?></td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin</strong></td>
                    <td>: <?= $data_mhs['jenis_kelamin'] ?></td>
                </tr>
                <tr>
                    <td><strong>Tempat Lahir</strong></td>
                    <td>: <?= $data_mhs['tempat_lahir'] ?></td>
                </tr>
                <tr>
                    <td><strong>Tanggal Lahir</strong></td>
                    <td>: <?= $data_mhs['tanggal_lahir'] ?></td>
                </tr>
                <tr>
                    <td><strong>Agama</strong></td>
                    <td>: <?= $data_mhs['agama'] ?></td>
                </tr>
                <tr>
                    <td><strong>Biaya</strong></td>
                    <td>: <?= $data_mhs['biaya'] ?></td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>: <?= $data_mhs['email'] ?></td>
                </tr>
                <tr>
                    <td><strong>Tinggal bersama</strong></td>
                    <td>: <?= $data_mhs['tinggal_bersama'] ?></td>
                </tr>
                </table>
        </div>

        <!-- kondisi -->
         <div class="kotak-kondisi">
         <h2>Kondisi Jasmani</h2>
         <table>
                <tr>
                    <td><strong>Berat Badan</strong></td>
                    <td>: <?= $data_mhs['berat_badan'] ?></td>
                </tr>
                <tr>
                    <td><strong>Tinggi Badan</strong></td>
                    <td>: <?= $data_mhs['tinggi_badan'] ?></td>
                </tr>
                <tr>
                    <td><strong>Golongan Darah</strong></td>
                    <td>: <?= $data_mhs['golongan_darah'] ?></td>
                </tr>
                <tr>
                    <td><strong>Penyakit Yang Diderita</strong></td>
                    <td>: <?= $data_mhs['penyakit_diderita'] ?></td>
                </tr>
                
                </table>
         </div>
         <!-- end kondisi -->
    </div>
    <div class="kanan">
        <!-- saudara -->
        <div class="kotak-saudara">
         <h2>Jumlah Saudara</h2>
         <table>
                <tr>
                    <td><strong>kandung</strong></td>
                    <td>: <?= $data_mhs['saudara_kandung'] ?></td>
                </tr>
                <tr>
                    <td><strong>Tiri</strong></td>
                    <td>: <?= $data_mhs['saudara_tiri'] ?></td>
                </tr>
                <tr>
                    <td><strong>Angkat</strong></td>
                    <td>: <?= $data_mhs['saudara_angkat'] ?></td>
                </tr>
                
                </table>
         </div>
         <!-- end saudara -->

        <!-- ayah -->
        <div class="kotak-ayah">
         <h2>Ayah Kandung</h2>
         <table>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td>: <?= $data_mhs['nama_ayah'] ?></td>
                </tr>
                <tr>
                    <td><strong>No. Telp</strong></td>
                    <td>: <?= $data_mhs['no_telp_ayah'] ?></td>
                </tr>
                <tr>
                    <td><strong>Pendidikan</strong></td>
                    <td>: <?= $data_mhs['pendidikan_ayah'] ?></td>
                </tr>
                <tr>
                    <td><strong>Pekerjaan</strong></td>
                    <td>: <?= $data_mhs['pekerjaan_ayah'] ?></td>
                </tr>
                <tr>
                    <td><strong>Jumlah Penghasilan</strong></td>
                    <td>: <?= $data_mhs['penghasilan_ayah'] ?></td>
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
                    <td>: <?= $data_mhs['nama_ibu'] ?></td>
                </tr>
                <tr>
                    <td><strong>No. Telp</strong></td>
                    <td>: <?= $data_mhs['no_telp_ibu'] ?></td>
                </tr>
                <tr>
                    <td><strong>Pendidikan</strong></td>
                    <td>: <?= $data_mhs['pendidikan_ibu'] ?></td>
                </tr>
                <tr>
                    <td><strong>Pekerjaan</strong></td>
                    <td>: <?= $data_mhs['pekerjaan_ibu'] ?></td>
                </tr>
                <tr>
                    <td><strong>Jumlah Penghasilan</strong></td>
                    <td>: <?= $data_mhs['penghasilan_ibu'] ?></td>
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
                    <td>: <?= $data_mhs['nama_wali'] ?></td>
                </tr>
                <tr>
                    <td><strong>Hubungan Keluarga</strong></td>
                    <td>: <?= $data_mhs['hubungan_wali'] ?></td>
                </tr>
                <tr>
                    <td><strong>No. Telp</strong></td>
                    <td>: <?= $data_mhs['no_telp_wali'] ?></td>
                </tr>
                <tr>
                    <td><strong>Pendidikan</strong></td>
                    <td>: <?= $data_mhs['pendidikan_wali'] ?></td>
                </tr>
                <tr>
                    <td><strong>Pekerjaan</strong></td>
                    <td>: <?= $data_mhs['pekerjaan_wali'] ?></td>
                </tr>
                <tr>
                    <td><strong>Jumlah Penghasilan</strong></td>
                    <td>: <?= $data_mhs['penghasilan_wali'] ?></td>
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
                    <td>: <?= $data_mhs['skripsi'] ?></td>
                </tr>
                
                </table>
         </div>
         <!-- end skripsi -->
    </div>
</div>