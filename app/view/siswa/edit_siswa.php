<?php
session_start();
session_destroy();
include '../aplikasi_bnsp/app/confiq/koneksi.php';
$id = $_GET['id'];
$sqlQuerySelectDataById = "SELECT * FROM siswa WHERE id=$id";
$result_sqlQuerySelectDataById = $koneksi->query($sqlQuerySelectDataById);
$siswa = $result_sqlQuerySelectDataById->fetch_assoc();
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Data Siswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Data Siswa</li>
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
          <div class="card card-primary">
            <div class="card-header">
              <h5 class="card-title">Edit Data Siswa</h5>
            </div>
            <div class="card-body">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="../../../../aplikasi_bnsp/app/view/siswa/sistem.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
                  <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="text" name="nisn" class="form-control" id="nisn" value="<?= $siswa['nisn'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama SIswa</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $siswa['nama'] ?>" required>
                  </div>
                  <div class=" form-group">
                    <label for="alamat_lengkap">Alamat Lengkap</label>
                    <input type="text" name="alamat_lengkap" class="form-control" id="alamat_lengkap" value="<?= $siswa['alamat_lengkap'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat_kota">Alamat Kota</label>
                    <input type="text" name="alamat_kota" class="form-control" id="alamat_kota" value="<?= $siswa['alamat_kota'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= $siswa['tempat_lahir'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?= $siswa['tanggal_lahir'] ?>" required>
                  </div>
                  <div class="form-group">
                    <img style="width:100px; height:auto;" src="../../../../aplikasi_bnsp/assets/gambar/<?= $siswa['foto'] ?>" alt="gambar">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="foto" class="custom-file-input" id="foto">
                        <label class="custom-file-label" for="foto">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="edit" class="btn btn-primary">Ubah Data</button>
                </div>
              </form>
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