<?php 

session_start();

if ($_SESSION['status_login']!=true) {
    header("Location:login.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="file/icon.png" type="image/jpeg" rel="icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    if($_GET['id_buku']){
        include "koneksi.php";
        $qry=mysqli_query($konn,"select * from buku where
        id_buku='".$_GET['id_buku']."'");
        $dt= mysqli_fetch_array($qry);
        $id_buku = $dt['id_buku'];
        $nama = $dt['nama_buku'];
        $des = $dt['deskripsi'];
        $foto = $dt['foto'];
        
    }
?>
<body>
<div class="container py-5">
    <div class="container col-11 py-5">
        <h3>Ubah Buku</h3>
        <form action="proses_ubah_buku.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_buku" value="<?php echo $id_buku ?>">
            Nama Buku :
            <input type="text" name="nama_buku" value="<?php echo $nama ?>" class="form-control">

            Deskripsi :
            <textarea name="deskripsi" class="form-control" rows="4"><?php echo $des ?></textarea>

            Tambah Gambar :
            <input type="file" name="foto" class="form-control">
            <br>

            <input type="submit" name="edit" value="Ubah    Buku" class="btn btn-success mb-3" style="width: 100%">
            <a href="buku.php" class="btn btn-danger"style="width: 100%">Batal</a>

        </form>
    </div>
</div>
</body>
</html>
<?php
include "footer.php";
?>