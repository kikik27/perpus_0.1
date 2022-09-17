<?php
        if($_GET['id_petugas']){
        include "koneksi.php";
        $qry_hapus=mysqli_query($konn,"delete from petugas where
        id_petugas='".$_GET['id_petugas']."'");
        if($qry_hapus){
            echo "<script>alert('Sukses menghapus petugas');location.href='tampil_petugas.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus petugas');location.href='tampil_petugas.php';</script>";
        }
        }
?>