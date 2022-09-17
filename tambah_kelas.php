<?php 

session_start();

if ($_SESSION['status_login']!=true) {
    header("Location:login.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384
        +0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<div class="container">
        <div class="col-md py-5">
        <h3>Tambah Kelas</h3>
    <form action="" method="post">

        Nama Kelas :
        <input type="text" name="nama_kelas" value="" class="form-control">

        Kelompok :
        <input type="text" name="kelompok" value="" class="form-control">
        <br>
        <input type="submit" name="simpan" value="Tambah Kelas" class="btn btn-primary" style="float: right; width: 100%;">
        
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-
    gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
        </div>
    </div>
</body>
    <?
        include "footer.php";
    ?>
</html>
<?php
if (isset($_POST['simpan'])) {

                
    $nama_kelas = $_POST['nama_kelas'];
    $kelompok = $_POST['kelompok'];
    if (empty($nama_kelas)){
        echo "<script>alert('Nama Kelas Tidak Boleh Kosong');location.href='kelas.php';</script>";
    
    }elseif (empty($kelompok)){
        echo "<script>alert('Nama Kelompok Tidak Boleh Kosong');location.href='kelas.php';</script>";
    
    }else{
        include "koneksi.php";
        $insert = mysqli_query($konn,"insert into kelas (nama_kelas,kelompok) value ('".$nama_kelas."','".$kelompok."')");
    }if ($insert){
        echo "<script>alert('Sukses Menambahkan Kelas');location.href='kelas.php';</script>";
    }
    else {
        echo "<script>alert('Ggagal Menambahkan Kelas');location.href='kelas.php';</script>";
    }
}
?>