<?php
include '../aplikasi_bnsp/app/confiq/koneksi.php';

// if (count($_GET) == 0) { // count = menghitung array
//     include 'view/dashboard.php'; // dashboard
// }

$view = isset($_GET['view']) ? $_GET['view'] : 'dashboard';

if ($view == 'dashboard') {
    include '../aplikasi_bnsp/app/view/dashboard.php'; // dashboard
} elseif ($view == 'dataSiswa') {
    include '../aplikasi_bnsp/app/view/siswa/data_siswa.php';
} elseif ($view == 'tambahDataSiswa') {
    include '../aplikasi_bnsp/app/view/siswa/tambah_siswa.php';
} elseif ($view == 'editDataSiswa') {
    include '../aplikasi_bnsp/app/view/siswa/edit_siswa.php';
} elseif ($view == 'hapusDataSiswa') {
    // query hapus data
    $id = $_GET['id'];
    $sqlDelete = "DELETE FROM siswa WHERE id=$id";
    if ($koneksi->query($sqlDelete) === TRUE) {
        echo "
        <script>
            alert('Data Berhasil Dihapus')
            window.location.href = '?view=dataSiswa'
        </script>";
        // echo "Berhasil hapus data";
    } else {
        echo "Gagal hapus data: " . $koneksi->error;
    }
} elseif ($view == 'exportPdf') {
    include '../aplikasi_bnsp/app/view/siswa/exportpdf.php';
} else {
    include '../aplikasi_bnsp/app/view/dashboard.php';
}
