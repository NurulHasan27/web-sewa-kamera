<?php
    if(isset($_GET['data'])){
      $id_kontak = $_GET['data'];
      $_SESSION['id_kontak']=$id_kontak;
        
    //get data kategori produk
    $sql_k = "SELECT `id_kontak`, `media`, `kontak` 
              FROM `kontak` 
              WHERE `id_kontak` = '$id_kontak'";
    $query_k = mysqli_query($koneksi,$sql_k);
    while($data_k = mysqli_fetch_row($query_k)){
      $id_kontak = $data_k[0];
      $media = $data_k[1];
      $kontak = $data_k[2];
    }
  }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3><i class="fas fa-edit"></i> Edit kontak</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?include=kontak">kontak</a></li>
                        <li class="breadcrumb-item active">Edit kontak</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit kontak</h3>
                <div class="card-tools">
                    <a href="index.php?include=kontak" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            </br>
            <div class="col-sm-10">
                <?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){ ?>
                    <?php if($_GET['notif']=="editkosong"){ ?>
                    <div class="alert alert-danger" role="alert">Maaf data
                    <?php echo $_GET['jenis'];?> wajib di isi</div>
                    <?php } ?>
                <?php } ?>
            </div>
            <form class="form-horizontal" method="POST" action="index.php?include=konfirmasi-edit-kontak">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="media" class="col-sm-3 col-form-label">Media</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="media" name="media" value="<?php echo $media; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kontak" class="col-sm-3 col-form-label">kontak</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo $kontak; ?>">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-edit"></i> Edit</button>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->