<?php
include '../../../../aplikasi_bnsp/app/confiq/koneksi.php';

if (isset($_POST['tambah'])) {
  $nisn = $_POST['nisn'];
  $nama = $_POST['nama'];
  $alamat_lengkap = $_POST['alamat_lengkap'];
  $alamat_kota = $_POST['alamat_kota'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $foto = $_FILES['foto']['name'];

  $ekstensi_diperbolehkan    = array('png', 'jpg');
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));
  $ukuran    = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  // move_uploaded_file($file_tmp, 'gambar/' . $foto);

  // $file_tmp = $_FILES['foto']['tmp_name'];

  if ($foto != '') {
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      if ($ukuran < 1044070) {
        move_uploaded_file($file_tmp, '../../../assets/gambar/' . $foto);
        $query  = "INSERT INTO siswa VALUES ('','$nisn','$nama','$alamat_lengkap','$alamat_kota','$tempat_lahir','$tanggal_lahir','$foto')";
        $result = mysqli_query($koneksi, $query);
        if ($query) {
          echo "
                <script>
                    alert('Data Berhasil Ditambahkan')
                    window.location.href = '../.././../../aplikasi_bnsp/?view=dataSiswa'
                </script>";
        } else {
          echo "
                <script>
                    alert('Data Gagal Ditambahkan')
                    window.location.href = '../.././../../aplikasi_bnsp/?view=tambahDataSiswa'
                </script>";
        }
      } else {
        echo 'UKURAN FILE TERLALU BESAR';
      }
    } else {
      echo "
    <script>
          alert('EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN')
          window.location.href = '../.././../../aplikasi_bnsp/?view=tambahDataSiswa'
      </script>";
    }
  } else {
    echo "
    <script>
          alert('FOTO TIDAK BOLEH KOSONG!')
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

  $ekstensi_diperbolehkan    = array('png', 'jpg');
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));
  $ukuran    = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  $file_tmp = $_FILES['foto']['tmp_name'];

  if ($foto != '') {
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      if ($ukuran < 1044070) {
        move_uploaded_file($file_tmp, '../../../assets/gambar/' . $foto);
        $query  = "UPDATE siswa SET nisn='$nisn', nama='$nama', alamat_lengkap='$alamat_lengkap', alamat_kota='$alamat_kota', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', foto='$foto' WHERE id='$id'";
        $result = mysqli_query($koneksi, $query);
        if ($query) {
          echo "
                <script>
                    alert('Data Berhasil Diubah')
                    window.location.href = '../.././../../aplikasi_bnsp/?view=dataSiswa'
                </script>";
        } else {
          echo "
                <script>
                    alert('Data Gagal Diubah')
                    window.location.href = '../.././../../aplikasi_bnsp/?view=editDataSiswa'
                </script>";
        }
      } else {
        echo 'UKURAN FILE TERLALU BESAR';
      }
    } else {
      echo "
      <script>
          alert('EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN')
          window.location.href = '../.././../../aplikasi_bnsp/?view=editDataSiswa&id=$id'
      </script>";
    }
  } else {
    echo "
      <script>
          alert('FILE TIDAK BOLEH KOSONG!')
          window.location.href = '../.././../../aplikasi_bnsp/?view=editDataSiswa&id=$id'
      </script>";
  }
}
