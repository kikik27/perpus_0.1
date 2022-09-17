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
    if($_GET['id_petugas']){
        include "koneksi.php";
        $qry=mysqli_query($konn,"select * from petugas where
        id_petugas='".$_GET['id_petugas']."'");
        $dt= mysqli_fetch_array($qry);
        
    }
?>
<body>
<div class="container col-10">
            <div class="col-md py-5">
            <h3> Ubah Petugas</h3>
                <form action="" method="post">
                    <input type="hidden" name="id_petugas" value="<?=$dt['id_petugas']; ?>" />
                    
                    Nama Petugas :

                    <input type="text" name="nm_ptgs" value="<?=$dt['nama_petugas']?>" class="form-control">

                    Gender :
                <?php 
                $arr_gender=array('L'=>'Laki-laki','P'=>'Perempuan');
                ?>

                <select name="gender" class="form-control">
                    <option></option>
                    <?php foreach ($arr_gender as $key_gender => $val_gender):
                        if($key_gender==$dt['gender']){
                            $selek="selected";
                        } else {
                            $selek="";
                        }
                    ?>
                <option value="<?=$key_gender?>" <?=$selek?>><?=$val_gender?>
                </option>
                    <?php endforeach ?>
                </select>
                    
                    Username :

                    <input type="text" name="username" value="<?=$dt['username']?>" class="form-control">

                    Password :

                    <input type="password" name="password" value="" class="form-control">

                    JABATAN :

                    <input type="text" name="lvl" value="<?=$dt['level']?>" class="form-control">
                    </br>

                    <input type="submit" name="edit" value="Ubah Pelanggan" class="btn btn-success mb-3" style="width: 100%">
                    <a href="tampil_petugas.php" class="btn btn-danger"style="width: 100%">Batal</a>

                </form>
                <?php

                if(isset($_POST['edit'])){

                $id_petugas=$_POST['id_petugas'];

                $nama_petugas=$_POST['nm_ptgs'];

                $username=$_POST['username'];

                $password=$_POST['password'];;

                $level = $_POST['lvl'];

                if(empty($nama_petugas)){

                    echo "<script>alert('nama siswa tidak boleh kosong');location.href='ubah_petugas.php';</script>";


                } elseif(empty($username)){

                    echo "<script>alert('username tidak boleh kosong');location.href='ubah_petugas.php';</script>";

                } elseif(empty($level)){

                    echo "<script>alert('jabtan tidak boleh kosong');location.href='ubah_petugas.php';</script>";
                    
                }else {

                    include "koneksi.php";

                    if(empty($password)){

                        $update=mysqli_query($konn,"update petugas set nama_petugas='".$nama_petugas."', username='".$username."',level='".$level."' where id_petugas = '".$id_petugas."' ") or die(mysqli_error($conn));

                        if($update){

                            echo "<script>alert('Sukses update petugas');location.href='tampil_petugas.php';</script>";

                        } else {

                            echo "<script>alert('Gagal update petugas');location.href='ubah_petugas.php?id_petugas=".$id_petugas."';</script>";

                        }

                    } else {

                        $update=mysqli_query($konn,"update petugas set nama_petugas='".$nama_petugas."',username='".$username."', password='".md5($password)."',level='".$level."' where id_petugas = '".$id_petugas."'") or die(mysqli_error($conn));

                        if($update){
                                    
                            echo "<script>alert('Sukses update petugas');location.href='tampil_petugas.php';</script>";

                        } else {

                            echo "<script>alert('Gagal update siswa');location.href='ubah_petugas.php?id_petugas=".$id_petugas."';</script>";

                        }

                    }



                }

                }

                ?>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
            </div>
        
    </div>
</body>
</html>