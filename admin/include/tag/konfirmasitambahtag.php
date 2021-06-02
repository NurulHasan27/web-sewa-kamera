<?php
    $id_tag = $_POST['id_tag'];
    $tag = $_POST['tag'];
    
    if(empty($tag)){
        header("Location:index.php?include=tag/tambah&notif=tambahkosong&jenis=Kategori produk");
    }else{
        $sql = "INSERT INTO `tag` (`id_tag`,`tag`)
                VALUES ('$id_tag', '$tag')";
        mysqli_query($koneksi,$sql);
        header("Location:index.php?include=tag&notif=tambahberhasil");
    }
?>