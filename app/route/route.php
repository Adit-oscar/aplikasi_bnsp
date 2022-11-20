<?php
include '../aplikasi_bnsp/app/confiq/koneksi.php';

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
    $id = $_GET['id'];
    $sqlCekSiswa = "SELECT * FROM siswa WHERE id='$id'";
    if ($koneksi->query($sqlCekSiswa)->num_rows > 0) {

        $data = $koneksi->query($sqlCekSiswa);
        $siswa = $data->fetch_assoc();
        unlink('../aplikasi_bnsp/assets/gambar/' . $siswa['foto']);

        // query hapus data
        $sqlDelete = "DELETE FROM siswa WHERE id=$id";
        if ($koneksi->query($sqlDelete) === TRUE) {
            echo "
        <script>
            alert('Data Berhasil Dihapus')
            window.location.href = '?view=dataSiswa'
        </script>";
        } else {
            echo "Gagal hapus data: " . $koneksi->error;
        }
    } else {
        echo "
        <script>
            alert('Data gagal dihapus, id tidak ditemukan')
            window.location.href = '?view=dataSiswa'
        </script>";
    }
} elseif ($view == 'exportPdf') {
    include '../aplikasi_bnsp/app/view/siswa/exportpdf.php';
} else {
    include '../aplikasi_bnsp/app/view/dashboard.php';
}
