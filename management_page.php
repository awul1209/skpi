<?php

if (isset($_GET['page'])) {
    $hal = $_GET['page'];

    switch ($hal) {

        case 'home_admin':
            include 'home/admin.php';
            break;
        case 'home_mhs':
            include 'home/mahasiswa.php';
            break;
        case 'home_staff':
            include 'home/staff.php';
            break;
            // mhs
        case 'biodata':
            include 'admin/biodata/index.php';
            break;
        case 'krp':
            include 'admin/krp/index.php';
            break;
        case 'data-krp':
            include 'admin/krp/review_krp.php';
            break;
        case 'khp':
            include 'admin/khp/index.php';
            break;
        case 'del-khp':
            include 'admin/khp/del.php';
            break;
        case 'histori':
            include 'admin/histori/index.php';
            break;
        case 'edit-bio':
            include 'admin/biodata/edit_bio.php';
            break;
        case 'edit-pw':
            include 'admin/biodata/edit_password.php';
            break;
        case 'data-skpi':
            include 'admin/skpi/index.php';
            break;
        //user
        case 'edit-foto':
            include 'admin/biodata/edit_foto.php';
            break;

            // staff
        //user
        case 'data_mhs_staff':
            include 'admin/mhs/index.php';
            break;
        case 'user':
            include 'admin/user/data_user2.php';
            break;
        case 'add-user':
            include 'admin/user/add_user.php';
            break;
        case 'import-user':
            include 'admin/user/add_excel.php';
            break;
        case 'edit-user':
            include 'admin/user/edit_user.php';
            break;
        case 'del-user':
            include 'admin/user/del_user.php';
            break;

        //kelas
       
        case 'data-kelas':
            include 'admin/kelas/data_kelas.php';
            break;
        case 'add-kelas':
            include 'admin/kelas/add_kelas.php';
            break;
        case 'edit-kelas':
            include 'admin/kelas/edit_kelas.php';
            break;
        case 'del-kelas':
            include 'admin/kelas/del_kelas.php';
            break;
        case 'kelas-siswa':
            include 'admin/kelas/kelas_siswa.php';
            break;

        //matpel
       
        case 'data-matpel':
            include 'admin/matpel/data_matpel.php';
            break;
        case 'add-matpel':
            include 'admin/matpel/add_matpel.php';
            break;
        case 'edit-matpel':
            include 'admin/matpel/edit_matpel.php';
            break;
        case 'del-matpel':
            include 'admin/matpel/del_matpel.php';
            break;

            //siswa
       
        case 'data-siswa':
            include 'admin/siswa/data_siswa.php';
            break;
        case 'siswa':
            include 'admin/siswa/data_siswa2.php';
            break;
        case 'add-siswa':
            include 'admin/siswa/add_siswa.php';
            break;
        case 'import-siswa':
            include 'admin/siswa/add_axcel.php';
            break;
        case 'edit-siswa':
            include 'admin/siswa/edit_siswa.php';
            break;
        case 'del-siswa':
            include 'admin/siswa/del_siswa.php';
            break;

            //jadwal
       
        case 'data-jadwal':
            include 'admin/jadwal/data_jadwal.php';
            break;
        case 'data-jadwal-guru':
            include 'admin/jadwal/data_jadwal_guru.php';
            break;
        case 'add-jadwal':
            include 'admin/jadwal/add_jadwal.php';
            break;
        case 'edit-jadwal':
            include 'admin/jadwal/edit_jadwal.php';
            break;
        case 'del-jadwal':
            include 'admin/jadwal/del_jadwal.php';
            break;
        case 'jadwal-kelas':
            include 'admin/jadwal/jadwal_kelas.php';
            break;

         

      

    

      



           

            // cetak
        case 'cetak-absen':
            include 'cetak/cetak_absen.php';
            break;
    

        //default
        default:
            echo '<center><h1> ERROR !</h1></center>';
            break;
    }
} else {
    // Auto Halaman Home Pengguna
    if ($data_level == 'admin') {
        include 'home/admin.php';
    } elseif ($data_level == 'staff') {
        include 'home/staff.php';
    }else {
        include 'home/mahasiswa.php';
    }
}

?>
