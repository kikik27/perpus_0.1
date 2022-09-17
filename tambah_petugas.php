<?php 

session_start();

if ($_SESSION['status_login']!=true) {
    header("Location:login.php");

}
?>
<!DOCTYPE html>

<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title></title>

</head>
<body>
    <div class="container col-10">
            <div class="col-md py-5">
            <h3> Tambah Petugas</h3>
                <form action="" method="post">

                    Nama Petugas :

                    <input type="text" name="nm_ptgs" value="" class="form-control">

                    Gender :

                    <select name="gender" class="form-control">
                    <option></option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                    </select>

                    Username :

                    <input type="text" name="username" value="" class="form-control">

                    Password :

                    <input type="password" name="password" value="" class="form-control">

                    JABATAN :

                    <input type="text" name="lvl" value="" class="form-control">
                    </br>

                    <input type="submit" name="simpan" value="Tambah Petugas" class="btn btn-success mb-3" style="width: 100%">
                    <a href="tampil_petugas.php" class="btn btn-danger"style="width: 100%">Batal</a>

                </form>
                <?php

                if(isset($_POST['simpan'])){

                    $nama=$_POST['nm_ptgs'];
                    $username=$_POST['username'];
                    $gender=$_POST['gender'];
                    $password=$_POST['password'];
                    $level=$_POST['lvl'];

                    if(empty($nama)){
                        echo "<script>alert('nama pelanggan tidak boleh kosong');location.href='tambah_petugas.php';</script>";
                    }elseif(empty($gender)){

                            echo "<script>alert('gender pelanggan tidak boleh kosong');location.href='tambah_petugas.php';</script>";
                    } elseif(empty($username)){

                        echo "<script>alert('alamat pelanggan tidak boleh kosong');location.href='tambah_petugas.php';</script>";
                    } elseif(empty($password)){

                        echo "<script>alert('password tidak boleh kosong');location.href='tambah_petugas.php';</script>";
                    } elseif(empty($level)){

                        echo "<script>alert('level tidak boleh kosong');location.href='tambah_petugas.php';</script>";
                    }   else {
                        include "koneksi.php";

                        $insert=mysqli_query($konn,"insert into petugas (nama_petugas, gender, username, password, level) value ('".$nama."','".$gender."','".$username."','".md5($password)."','".$level."')") or die(mysqli_error($konn));

                        if($insert){
                            echo "<script>alert('Sukses menambahkan Petugas');location.href='petugas.php';</script>";
                        } else {
                            echo "<script>alert('Gagal menambahkan Petugas');location.href='tambah_petugas.php';</script>";
                        }
                    }
                }
                ?>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
            </div>
        
    </div>
</body>

</html>