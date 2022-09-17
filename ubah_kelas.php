
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384
        +0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<div class="container">
        <div class="col-md py-5">
        <h3>Ubah Kelas</h3>
        <?php 

        include "koneksi.php";

        $qry_get_kelas=mysqli_query($konn,"select * from kelas where id_kelas = '".$_GET['id_kelas']."'");

        $dt_kelas=mysqli_fetch_array($qry_get_kelas);

        ?>
    <form action="" method="post">
    <input type="hidden" name="id_kelas" value="<?=$dt_kelas['id_kelas']?>">
        Nama Kelas :
        <input type="text" name="nama_kelas" value="<?=$dt_kelas['nama_kelas']?>"class="form-control">

        Kelompok :
        <input type="txt" name="kelompok" value="<?=$dt_kelas['kelompok']?>" class="form-control">
        <br>
        <input type="submit" name="edit" value="Ubah kelas" class="btn btn-primary" style="float: right; width: 100%;">
        
    </form>

    <?php
    if(isset($_POST['edit'])){

        $id_kelas=$_POST['id_kelas'];
        
        $nama_kelas=$_POST['nama_kelas'];

        $kelompok=$_POST['kelompok'];
        
        if(empty($nama_kelas)){
        
            echo "<script>alert('nama kelas tidak boleh kosong');location.href='ubah_kelas.php';</script>";
        
        
        } elseif(empty($kelompok)){
        
            echo "<script>alert('kelompok tidak boleh kosong');location.href='ubah_kelas.php';</script>";
        
        } else {
        
            include "koneksi.php";
        
        
                $update=mysqli_query($konn,"update kelas set nama_kelas='$nama_kelas',kelompok='$kelompok' where id_kelas = '".$id_kelas."'") or die(mysqli_error($konn));
        
                
                if($update){
        
                    echo "<script>alert('Sukses update kelas');location.href='kelas.php';</script>";
        
                } else {
        
                    echo "<script>alert('Gagal update kelas');location.href='ubah_kelas.php?id_siswa=".$id_siswa."';</script>";
        
                }
        
            }
        
        
        
        }
        
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-
    gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
        </div>
    </div>
</body>
<?php
    include "footer.php";
    ?>
</html>