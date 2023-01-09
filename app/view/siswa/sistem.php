<?php

session_start();

include '../../../../aplikasi_bnsp/app/confiq/koneksi.php';

if (isset($_POST['tambah'])) {
  $nisn = $_POST['nisn'];
  $nama = $_POST['nama'];
  $alamat_lengkap = $_POST['alamat_lengkap'];
  $alamat_kota = $_POST['alamat_kota'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $foto = $_FILES['foto']['name'];

  // memecah foto berdasarkan . untuk mengambil ekstensi foto
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));

  // rename foto berdasarkan nama
  $rename_foto_berdasarkan_nama = $nama . '.' . $ekstensi;

  $ekstensi_diperbolehkan    = array('png', 'jpg');
  $ukuran    = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  if ($foto != '') {
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      if ($ukuran < 1044070) {
        move_uploaded_file($file_tmp, '../../../assets/gambar/' . $rename_foto_berdasarkan_nama);
        $query  = "INSERT INTO siswa VALUES ('','$nisn','$nama','$alamat_lengkap','$alamat_kota','$tempat_lahir','$tanggal_lahir','$rename_foto_berdasarkan_nama')";
        $result = mysqli_query($koneksi, $query);
        if ($query) {
          $_SESSION['flash-data'] = 'Berhasil Ditambahkan';
          echo "
                <script>
                    window.location.href = '../.././../../aplikasi_bnsp/?view=dataSiswa'
                </script>";
        } else {
          $_SESSION['flash-data'] = 'Gagal Ditambahkan';
          echo "
                <script>
                    window.location.href = '../.././../../aplikasi_bnsp/?view=tambahDataSiswa'
                </script>";
        }
      } else {
        $_SESSION['status'] = 'gagal';
        $_SESSION['flash-data'] = 'Gagal Ditambahkan';
        echo "
              <script>
                  window.location.href = '../.././../../aplikasi_bnsp/?view=tambahDataSiswa'
              </script>";
      }
    } else {
      $_SESSION['flash-data'] = 'Ekstensi File Tidak Diperbolehkan';
      echo "
      <script>
          window.location.href = '../.././../../aplikasi_bnsp/?view=tambahDataSiswa'
      </script>";
    }
  } else {
    $_SESSION['flash-data'] = 'Foto Tidak Boleh Kosong';
    echo "
    <script>
          window.location.href = '../.././../../aplikasi_bnsp/?view=tambahDataSiswa'
      </script>";
  }
} elseif (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $nisn = $_POST['nisn'];
  $nama = $_POST['nama'];
  $alamat_lengkap = $_POST['alamat_lengkap'];
  $alamat_kota = $_POST['alamat_kota'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $foto = $_FILES['foto']['name'];

  // memecah foto berdasarkan . untuk mengambil ekstensi foto
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));

  // rename foto berdasarkan nama
  $rename_foto_berdasarkan_nama = $nama . '.' . $ekstensi;

  $ekstensi_diperbolehkan    = array('png', 'jpg');
  $ekstensi = strtolower(end($x));
  $ukuran    = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  $file_tmp = $_FILES['foto']['tmp_name'];

  if ($foto != '') {
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      if ($ukuran < 1044070) {
        // ambil gambar lama & hapus
        $ambilGambarLama = "SELECT * FROM siswa WHERE id='$id'";
        $gambarLama = $koneksi->query($ambilGambarLama);
        $gambar = $gambarLama->fetch_assoc();
        unlink('../../../assets/gambar/' . $gambar['foto']);

        // upload gambar
        move_uploaded_file($file_tmp, '../../../assets/gambar/' . $rename_foto_berdasarkan_nama);
        $query  = "UPDATE siswa SET nisn='$nisn', nama='$nama', alamat_lengkap='$alamat_lengkap', alamat_kota='$alamat_kota', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', foto='$rename_foto_berdasarkan_nama' WHERE id='$id'";
        $result = mysqli_query($koneksi, $query);
        if ($query) {
          $_SESSION['flash-data'] = 'Berhasil Diubah';
          echo "
                <script>
                    window.location.href = '../.././../../aplikasi_bnsp/?view=dataSiswa'
                </script>";
        } else {
          $_SESSION['flash-data'] = 'Gagal Diubah';
          echo "
                <script>
                    window.location.href = '../.././../../aplikasi_bnsp/?view=editDataSiswa'
                </script>";
        }
      } else {
        echo 'UKURAN FILE TERLALU BESAR';
      }
    } else {
      $_SESSION['flash-data'] = 'Ekstensi File Tidak Diperbolehkan';
      echo "
      <script>
          window.location.href = '../.././../../aplikasi_bnsp/?view=editDataSiswa&id=$id'
      </script>";
    }
  } else {
    // ambil gambar lama
    $ambilGambarLama = "SELECT * FROM siswa WHERE id='$id'";
    $gambarLama = $koneksi->query($ambilGambarLama);
    $fetchGambar = $gambarLama->fetch_assoc();
    $gambar = $fetchGambar['foto'];

    $query  = "UPDATE siswa SET nisn='$nisn', nama='$nama', alamat_lengkap='$alamat_lengkap', alamat_kota='$alamat_kota', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', foto='$gambar' WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);
    if ($query) {
      $_SESSION['flash-data'] = 'Berhasil Diubah';
      echo "
                <script>
                    window.location.href = '../.././../../aplikasi_bnsp/?view=dataSiswa'
                </script>";
    } else {
      $_SESSION['flash-data'] = 'Gagal Diubah';
      echo "
                <script>
                    window.location.href = '../.././../../aplikasi_bnsp/?view=editDataSiswa'
                </script>";
    }
  }
}
