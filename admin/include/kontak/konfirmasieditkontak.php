<?php
    if(isset($_SESSION['id_kontak'])){
        $id_kontak = $_SESSION['id_kontak'];
        $media = $_POST['media'];
        $kontak = $_POST['kontak'];
        if(empty($media)){
            header("Location:index.php?include=kontak/edit&data=".$id_kontak."&notif=editkosong&jenis=Media");
        }else if(empty($kontak)){
            header("Location:index.php?include=kontak/edit&data=".$id_kontak."&notif=editkosong&jenis=Kontak");
        }else{
            $sql = "UPDATE `kontak` 
                    SET `media`='$media', `kontak`='$kontak' 
                    WHERE `id_kontak`='$id_kontak'";
            mysqli_query($koneksi,$sql);
            header("Location:index.php?include=kontak&notif=editberhasil");
        }
    }
?>