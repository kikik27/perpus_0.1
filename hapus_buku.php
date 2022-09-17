<?php
        if($_GET['id_buku']){
        include "koneksi.php";
        $qry = mysqli_query($konn,"select * from buku where id_buku='".$_GET['id_buku']);
        $hapus = mysqli_fetch_array($qry);
         unlink("gambar/$hapus[foto]");
        $qry_hapus=mysqli_query($konn,"delete from buku where
        id_buku='".$_GET['id_buku']."'");
        if($qry_hapus){
            echo "<script>alert('Sukses menghapus produk');location.href='buku.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus produk');location.href='buku.php';</script>";
        }
        }
?>