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
    if($_GET['id_siswa']){
        include "koneksi.php";
        $qry=mysqli_query($konn,"select * from siswa where
        id_siswa='".$_GET['id_siswa']."'");
        $dt_siswa= mysqli_fetch_array($qry);
        
    }
?>
<body>
<div class="container col-10">
<div class="col-md py-5">

<h3> Ubah Pelanggan</h3>
<form action="" method="post">
            <input type="hidden" name="id_siswa" value="<?=$dt_siswa['id_siswa']?>">

                Nama Sisswa :
                <input type="text" name="nama_siswa" value="<?=$dt_siswa['nama_siswa']?>" class="form-control">

                Tanggal Lahir :
                <input type="date" name="tanggal_lahir" value="<?=$dt_siswa['tanggal_lahir']?>" class="form-control">

                Gender :
                <?php 
                $arr_gender=array('L'=>'Laki-laki','P'=>'Perempuan');
                ?>

                <select name="gender" class="form-control">
                    <option></option>
                    <?php foreach ($arr_gender as $key_gender => $val_gender):
                        if($key_gender==$dt_siswa['gender']){
                            $selek="selected";
                        } else {
                            $selek="";
                        }
                    ?>
                <option value="<?=$key_gender?>" <?=$selek?>><?=$val_gender?>
                </option>
                    <?php endforeach ?>
                </select>

                Alamat :
                <textarea name="alamat"class="form-control" rows="4"><?=$dt_siswa['alamat']?></textarea>

                Kelas :

                <select name="id_kelas" class="form-control">
                    <option></option>

                    <?php 

                    include "koneksi.php";
                    $qry_kelas=mysqli_query($konn,"select * from kelas");
                    while($data_kelas=mysqli_fetch_array($qry_kelas)){
                        if($data_kelas['id_kelas']==$dt_siswa['id_kelas']){
                            $selek="selected";
                        } else {
                            $selek="";
                        }
                    echo '<option value="'.$data_kelas['id_kelas'].'" '.$selek.'>'.$data_kelas['nama_kelas'].'</option>';   
                    }

                    ?>

                    </select>
                    Username :
                    <input type="text" name="username" value="<?=$dt_siswa['username']?>" class="form-control">

                    Password :
                    <input type="password" name="password" value="" class="form-control">
                    <br>
                    <input type="submit" name="edit" value="Edit Siswa" class="btn btn-primary" style="float: right; width: 100%;">
                    
                </form>
    <?php

                if(isset($_POST['edit'])){

                    $id_siswa=$_POST['id_siswa'];
                    $nama_siswa=$_POST['nama_siswa'];
                    $tanggal_lahir=$_POST['tanggal_lahir'];
                    $alamat=$_POST['alamat'];
                    $gender=$_POST['gender'];
                    $username=$_POST['username'];
                    $password=$_POST['password'];
                    $id_kelas=$_POST['id_kelas'];

                    if(empty($nama_siswa)){
                        echo "<script>alert('nama siswa tidak boleh kosong');location.href='tambah_siswa.php';</script>";
                    } elseif(empty($username)){
                        echo "<script>alert('username tidak boleh kosong');location.href='tambah_siswa.php';</script>";
                    } else {
                        include "koneksi.php";

                        if(empty($password)){
                            $update=mysqli_query($konn,"update siswa set nama_siswa='".$nama_siswa."',tanggal_lahir='".$tanggal_lahir."', gender='".$gender."', alamat='".$alamat."', username='".$username."', id_kelas='".$id_kelas."' where id_siswa = '".$id_siswa."' ") or die(mysqli_error($conn));
                            if($update){
                                echo "<script>alert('Sukses update siswa');location.href='siswa.php';</script>";
                            } else {
                                echo "<script>alert('Gagal update siswa');location.href='ubah_siswa.php?id_siswa=".$id_siswa."';</script>";
                            }
                        } else {
                            $update=mysqli_query($konn,"update siswa set nama_siswa='".$nama_siswa."',tanggal_lahir='".$tanggal_lahir."', gender='".$gender."', alamat='".$alamat."', username='".$username."', password='".md5($password)."', id_kelas='".$id_kelas."' where id_siswa = '".$id_siswa."'") or die(mysqli_error($conn));
                            if($update){
                                echo "<script>alert('Sukses update siswa');location.href='siswa.php';</script>";
                            } else {
                                echo "<script>alert('Gagal update siswa');location.href='ubah_siswa.php?id_siswa=".$id_siswa."';</script>";
                            }
                        }
                    }
                }
            

                ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    </div
    </div>

    </body>
    </html>
<?php include "footer.php" ?>