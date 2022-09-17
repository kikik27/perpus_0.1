<?php
    $terlogin = $_SESSION['nama'];
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">

        <div class="container col-11">
            <a class="navbar-brand" href="index.php">PERPUSTAKAAN</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <a class="nav-link" href="siswa.php">Siswa
            </a>
            <a class="nav-link" href="petugas.php">Petugas
            </a>
            <a class="nav-link" href="buku.php">Buku
            </a>
            <a class="nav-link" href="peminjaman.php">Peminjaman
            </a>
            </ul>
            <form action="" method="post" class="navbar-text">
                <a href="" class="btn btn-success">Hi " <?php echo $terlogin ?> "</a>
        <a href="keranjang.php" class="btn btn-warning">Keranjang</a>
        <input type="submit" name="logout" value="Logout" class="btn btn-danger">

        </form>
        
        </div>
        </div>
    </nav>  

    <style>
        *{
            font-family: "Oswald",sans-serif;
            font-weight: medium;
        }
        .navbar-brand{
            font-family: "Oswald",sans-serif;
            font-size: 24px;
            font-weight: bold ;
        }
        .nav-link{
            font-family: "Oswald",sans-serif;
            font-size: 16px;
        }
        .navbar-text{
            margin: 0 ;
        }
    </style>
            <?php 
        
        if(isset($_POST['logout'])){
        session_destroy();
        header("Location:login.php");
        }
        
    ?>