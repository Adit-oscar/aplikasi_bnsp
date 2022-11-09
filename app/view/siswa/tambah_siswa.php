<?php
include '../aplikasi_bnsp/app/confiq/koneksi.php';
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Data Siswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah Data Siswa</li>
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
              <h5 class="card-title">Tambah Data Siswa</h5>
            </div>
            <div class="card-body">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="../../../../aplikasi_bnsp/app/view/siswa/sistem.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="text" name="nisn" class="form-control" id="exampleInputEmail1" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama SIswa</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Lengkap</label>
                    <input type="text" name="alamat_lengkap" class="form-control" id="exampleInputEmail1" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Kota</label>
                    <input type="text" name="alamat_kota" class="form-control" id="exampleInputEmail1" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" id="exampleInputPassword1" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" id="exampleInputPassword1" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="foto" class="custom-file-input" id="exampleInputFile" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
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