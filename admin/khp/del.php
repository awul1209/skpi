<?php
if (isset($_GET['kode'])) {

    if (isset($_GET['file'])) {
        $fileToDelete = $_GET['file'];
    
        // Direktori tempat foto disimpan
        $directory = '././dist/img/file_skpi_mhs/';
    
        // Path lengkap file
        $filePath = $directory . $fileToDelete;
    
        // Periksa apakah file ada
        if (file_exists($filePath)) {
            // Hapus file
            if (unlink($filePath)) {
                // echo "Foto '$fileToDelete' telah berhasil dihapus.";
            } else {
                // echo "Terjadi kesalahan saat menghapus foto '$fileToDelete'.";
            }
        } else {
            // echo "Foto '$fileToDelete' tidak ditemukan.";
        }
    } else {
        echo "Tidak ada foto yang dipilih untuk dihapus.";
    }
    $sql_hapus = "DELETE FROM khp WHERE id='" . $_GET['kode'] . "'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);

    if ($query_hapus) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = '?page=khp';
            }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = '?page=khp';
            }
        })</script>";
    }
}
