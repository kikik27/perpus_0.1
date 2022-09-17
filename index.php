
<?php 

session_start();
if ($_SESSION['status_login']==false){
    header("Location:login.php");
  }
  include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container col-11 py-5">
        <center style="font-size: 24px;"><?php echo "<h1><b>Selamat Datang, " . $terlogin ."  !"."</b></h1>"; ?></center>
        
        <div class="card-deck py-5">
          <div class="card col-3 py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Data Siswa</h4>
              <a href="siswa.php" class="btn btn-warning btn-lg">Go</a></a>
            </div>
          </div>
          <div class="card col-3 py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/3671/3671187.png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Data Petugas</h4>
              <a href="petugas.php" class="btn btn-warning btn-lg">Go</a>
            </div>
          </div>
          <div class="card col-3 py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/3330/3330317.png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Data Buku</h4>
              <a href="buku.php" class="btn btn-warning btn-lg">Go</a>
            </div>
          </div>
          <div class="card col-3 py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/2417/2417789.png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Data Peminjaman</h4>
              <a href="peminjaman.php" class="btn btn-warning btn-lg">Go</a>
            </div>
          </div>
        </div>

    </div>

</body>
<?php
include "footer.php";
?>
</html>