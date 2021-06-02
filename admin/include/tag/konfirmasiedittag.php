<?php
    if(isset($_SESSION['id_tag'])){
        $id_tag = $_SESSION['id_tag'];
        $tag = $_POST['tag'];
        if(empty($tag)){
            header("Location:index.php?include=tag/edit&data=".$id_tag."&notif=editkosong&jenis=Tag");
        }else{
            $sql = "UPDATE `tag` 
                    SET `tag`='$tag'
                    WHERE `id_tag`='$id_tag'";
            mysqli_query($koneksi,$sql);
            header("Location:index.php?include=tag&notif=editberhasil");
        }
    }
?>