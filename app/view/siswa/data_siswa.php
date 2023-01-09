<?php

session_start();
session_destroy();

include '../aplikasi_bnsp/app/confiq/koneksi.php';
?>
<div class="content-wrapper">
  <!-- Flashdata notifikasi -->
  <div class="flash-data" data-flashdata="<?= isset($_SESSION['flash-data']) ? $_SESSION['flash-data'] : '' ?>" data-status="<?= isset($_SESSION['status']) ? $_SESSION['status'] : '' ?>" data-text="<?= isset($_SESSION['text']) ? $_SESSION['text'] : '' ?>"></div>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Siswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Siswa</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Data Siswa</h5>
            </div>
            <div class="card-body">

              <!-- Start Search -->
              <div class="col-md-12 mb-3">
                <form action="" method="POST">
                  <div class="input-group">
                    <input type="search" name="pencarian" class="form-control form-control-lg" placeholder="Silahkan Cari Data...." value="<?=
                                                                                                                                            isset($_POST['pencarian']) ? $_POST['pencarian'] : 'Cari Data...'
                                                                                                                                            ?>">
                    <div class="input-group-append">
                      <button type="submit" name="cari" class="btn btn-lg btn-default">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- End Search -->

              <!-- Start Button Add Data -->
              <div class="col-md-3 mb-3">
                <a href="?view=tambahDataSiswa" class="btn btn-success">
                  <i class="fas fa-plus">
                    Tambah Siswa
                  </i>
                </a>
                <a href="?view=exportPdf" class="btn btn-danger" target="_blank">
                  <i class="fas fa-file-pdf">
                    Cetak Pdf
                  </i>
                </a>
              </div>
              <!-- End Button Add Data -->

              <!-- Start Table -->
              <div class="col-md-12">
                <!-- Start Table -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nisn</th>
                      <th>Nama Siswa</th>
                      <th>Alamat Lengkap</th>
                      <th>Alamat Kota</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Foto</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    if (isset($_POST['cari'])) {
                      // get data pencarian
                      $pencarian = $_POST['pencarian'];

                      $jumlah_data_perhalaman = 5;
                      $sql = "SELECT * FROM siswa WHERE alamat_kota LIKE '%$pencarian%'";
                      $jumlah_semua_data = $koneksi->query($sql);
                      $all_data = $jumlah_semua_data->num_rows;
                      $jumlah_halaman = ceil($all_data / $jumlah_data_perhalaman);
                      $halaman_aktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                      $awal_data = ($jumlah_data_perhalaman * $halaman_aktif) - $jumlah_data_perhalaman;

                      $sql2 = "SELECT * FROM siswa WHERE alamat_kota LIKE '%$pencarian%' LIMIT $awal_data, $jumlah_data_perhalaman";
                      $mahasiswa = $koneksi->query($sql2);

                      $kembali = $halaman_aktif - 1;
                      $next = $halaman_aktif + 1;

                      if ($mahasiswa->num_rows > 0) {
                        while ($data = $mahasiswa->fetch_assoc()) {
                    ?>
                          <tr>
                            <td><?php echo $data['nisn'];  ?></td>
                            <td><?php echo $data['nama'] ?></td>
                            <td><?php echo $data['alamat_lengkap'] ?></td>
                            <td><?php echo $data['alamat_kota'] ?></td>
                            <td><?php echo $data['tempat_lahir'] ?></td>
                            <td><?php echo $data['tanggal_lahir'] ?></td>
                            <td><img style="width: 50px;" src="../../../../aplikasi_bnsp/assets/gambar/<?= $data['foto'] ?>" alt="gambar"></td>
                            <!-- <td><?php echo $data['jurusan']; ?></td> -->
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="?view=editDataSiswa&id=<?php echo $data['id']; ?>">
                                  <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                <a href="?view=hapusDataSiswa&id=<?php echo $data['id']; ?>">
                                  <button type="button" class="btn btn-danger">Hapus</button>
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php
                        }
                      } else {
                        echo "
                            Maaf Data Tidak DItemukan!
                            ";
                      }
                    } else {

                      $jumlah_data_perhalaman = 5;
                      $sql = "SELECT * FROM siswa";
                      $jumlah_semua_data = $koneksi->query($sql);
                      $all_data = $jumlah_semua_data->num_rows;
                      $jumlah_halaman = ceil($all_data / $jumlah_data_perhalaman);
                      $halaman_aktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                      $awal_data = ($jumlah_data_perhalaman * $halaman_aktif) - $jumlah_data_perhalaman;

                      $sql2 = "SELECT * FROM siswa LIMIT $awal_data, $jumlah_data_perhalaman";
                      $mahasiswa = $koneksi->query($sql2);

                      $kembali = $halaman_aktif - 1;
                      $next = $halaman_aktif + 1;

                      // End Konfigurasi Pagination

                      if ($mahasiswa->num_rows > 0) {
                        while ($data = $mahasiswa->fetch_assoc()) {
                        ?>
                          <tr>
                            <td><?php echo $data['nisn'];  ?></td>
                            <td><?php echo $data['nama'] ?></td>
                            <td><?php echo $data['alamat_lengkap'] ?></td>
                            <td><?php echo $data['alamat_kota'] ?></td>
                            <td><?php echo $data['tempat_lahir'] ?></td>
                            <td><?php echo $data['tanggal_lahir'] ?></td>
                            <td><img style="width: 50px;" src="../../../../aplikasi_bnsp/assets/gambar/<?= $data['foto'] ?>" alt="gambar"></td>
                            <!-- <td><?php echo $data['jurusan']; ?></td> -->
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="?view=editDataSiswa&id=<?php echo $data['id']; ?>">
                                  <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                <a href="?view=hapusDataSiswa&id=<?php echo $data['id']; ?>">
                                  <button type="button" class="btn btn-danger">Hapus</button>
                                </a>
                              </div>
                            </td>
                          </tr>
                    <?php
                        }
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <!-- .End Table -->

                <?php
                if (isset($_POST['cari'])) {
                  // $pencarian = $_POST['pencarian'];
                ?>
                  <!-- Start Pagination -->
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <?php
                      if ($halaman_aktif > 1) :
                      ?>
                        <li class="page-item">
                          <a class="page-link" <?php echo "href='?view=dataSiswa&pencarian=$pencarian&halaman=$kembali'"; ?> aria-label="kembali">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                      <?php
                      endif;

                      for ($x = 1; $x <= $jumlah_halaman; $x++) :
                      ?>
                        <li class="page-item">
                          <a class="page-link" <?php echo "href ='?view=dataSiswa&pencarian=$pencarian&halaman=$x'"; ?>><?php echo $x ?></a>
                        </li>
                      <?php
                      endfor;

                      if ($halaman_aktif < $jumlah_halaman) :
                      ?>
                        <li class="page-item">
                          <a class="page-link" <?php echo "href='?view=dataSiswa&pencarian=$pencarian&pencarian=$pencarian&halaman=$next'" ?> aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      <?php
                      endif;
                      ?>
                    </ul>
                  </nav>
                  <!-- .End Pagination -->
                <?php
                } else {
                ?>
                  <!-- Start Pagination -->
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <?php
                      if ($halaman_aktif > 1) :
                      ?>
                        <li class="page-item">
                          <a class="page-link" <?php echo "href='?view=dataSiswa&halaman=$kembali'"; ?> aria-label="kembali">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                      <?php
                      endif;

                      for ($x = 1; $x <= $jumlah_halaman; $x++) :
                      ?>
                        <li class="page-item">
                          <a class="page-link" <?php echo "href ='?view=dataSiswa&halaman=$x'"; ?>><?php echo $x ?></a>
                        </li>
                      <?php
                      endfor;

                      if ($halaman_aktif < $jumlah_halaman) :
                      ?>
                        <li class="page-item">
                          <a class="page-link" <?php echo "href='?view=dataSiswa&halaman=$next'" ?> aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      <?php
                      endif;
                      ?>
                    </ul>
                  </nav>
                  <!-- .End Pagination -->
                <?php
                }
                ?>

                <!-- <a href="view/exportpdf.php"> export pdf</a> -->
              </div>
              <!-- End Table -->
            </div>
          </div>
        </div>
        <!-- /.col-md-12 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>