<?php
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
      $id_kontak = $_GET['data'];
      //hapus kontak
      $sql_dh = "DELETE FROM `kontak` WHERE `id_kontak` = '$id_kontak'";
      mysqli_query($koneksi,$sql_dh);
    }
  }
  if(isset($_POST["katakunci"])){
    $katakunci_kontak = $_POST["katakunci"];
    $_SESSION['katakunci_kontak'] = $katakunci_kontak;
  }
  if(isset($_SESSION['katakunci_kontak'])){
    $katakunci_kontak = $_SESSION['katakunci_kontak'];
  }else{
    unset($_SESSION['katakunci_kontak']);
  }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-address-book"></i> Data Kontak</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Data Kontak</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Kontak</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-sm-12">
                <?php if(!empty($_GET['notif'])){?>
                    <?php if($_GET['notif']=="tambahberhasil"){?>
                      <div class="alert alert-primary" role="alert">
                      Data Berhasil Ditambahkan</div>
                    <?php } else if($_GET['notif']=="editberhasil"){?>
                      <div class="alert alert-primary" role="alert">
                      Data Berhasil Diubah</div>
                    <?php } else if($_GET['notif']=="hapusberhasil"){?>
                      <div class="alert alert-primary" role="alert">
                      Data Berhasil Dihapus</div>
                    <?php }?>
                <?php } ?>
              </div>
              <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="30%">Media</th>
                        <th width="30%">Kontak</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $batas = 2;
                        if(!isset($_GET['halaman'])){
                          $posisi = 0;
                          $halaman = 1;
                        }else{
                          $halaman = $_GET['halaman'];
                          $posisi = ($halaman-1) * $batas;
                        }
                        $sql_k = "SELECT `id_kontak`,`media`,`kontak` 
                                  FROM `kontak` ";
                        if (!empty($katakunci_kontak)){
                          $sql_k .= " WHERE `kontak` LIKE '%$katakunci_kontak%' ";
                        }
                        $sql_k .=" ORDER BY `kontak` limit $posisi, $batas";
                        $query_k = mysqli_query($koneksi,$sql_k);
                        $no = $posisi+1;
                        while($data_k = mysqli_fetch_row($query_k)){
                          $id_kontak = $data_k[0];
                          $media = $data_k[1];
                          $kontak = $data_k[2];
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $media; ?></td>
                        <td><?php echo $kontak; ?></td>
                        <td align="center">
                          <a href="index.php?include=kontak/edit&data=<?php echo $id_kontak;?>" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                          <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $kontak; ?>?')) window.location.href ='index.php?include=kontak&aksi=hapus&data=<?php echo $id_kontak;?>¬if=hapusberhasil'" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>                        
                        </td>
                      </tr>
                      <?php $no++;} ?>
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <?php
                //hitung jumlah semua data
                $sql_jum = "SELECT `id_kontak`, `media`, `kontak` 
                            FROM `kontak` ";
                if (!empty($katakunci_kategori)){
                  $sql_jum .= " WHERE `kontak` LIKE '%$katakunci_kontak%'";
                }
                $sql_jum .= " ORDER BY `kontak`";
                $query_jum = mysqli_query($koneksi,$sql_jum);
                $jum_data = mysqli_num_rows($query_jum);
                $jum_halaman = ceil($jum_data/$batas);
              ?>
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <?php
                  if($jum_halaman==0){
                  //tidak ada halaman
                  }else if($jum_halaman==1){
                    echo "<li class='page-item'><a class='page-link'>1</a></li>";
                  }else{
                    $sebelum = $halaman-1;
                    $setelah = $halaman+1;
                    if($halaman!=1){
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=kontak&halaman=1' style='color: green;'>First</a></li>";
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=kontak&halaman=$sebelum'style='color: green;'>«</a></li>";
                    }
                    for($i=1; $i<=$jum_halaman; $i++){
                      if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                        if($i!=$halaman){
                          echo "<li class='page-item'><a class='page-link' href='index.php?include=kontak&halaman=$i'style='color: green;'>$i</a></li>";
                        }else{
                          echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                        }
                      }
                    }
                    if($halaman!=$jum_halaman){
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=kontak&halaman=$setelah'style='color: green;'>»</a></li>";
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=kontak&halaman=$jum_halaman'style='color: green;'>Last</a></li>";
                    }
                  } ?>
                </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->