<?php 

session_start();

if ($_SESSION['status_login']!=true) {
    header("Location:login.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha
    +0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="col-md py-5">
        <h3>Tambah Siswa</h3>
    <form action="" method="post">

        Nama Siswa :
        <input type="text" name="nama_siswa" value="" class="form-control">

        Tanggal Lahir :
        <input type="date" name="tanggal_lahir" value="" class="form-control">

        Gender :
        <select name="gender" class="form-control">
        <option></option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
        </select>

        Alamat :
        <textarea name="alamat" class="form-control" rows=""></textarea>

        Kelas :
        <select name="id_kelas" class="form-control">
        <option></option>
        <?php
            include "koneksi.php";
            $qry_kelas=mysqli_query($konn,"select * from kelas");
            while($data_kelas=mysqli_fetch_array($qry_kelas)){
            echo '<option
            value="'.$data_kelas['id_kelas'].'">'.$data_kelas['nama_kelas'].'</option>';
            }
        ?>
        </select>
        Username :
        <input type="text" name="username" value="" class="form-control">

        Password :
        <input type="password" name="password" value="" class="form-control">
        <br>
        <input type="submit" name="simpan" value="Tambah Siswa" class="btn btn-primary" style="float: right; width: 100%;">
        
    </form>
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

<?php

if(isset($_POST['simpan'])){

    $nama_siswa=$_POST['nama_siswa'];

    $tanggal_lahir=$_POST['tanggal_lahir'];

    $alamat=$_POST['alamat'];

    $gender=$_POST['gender'];

    $username=$_POST['username'];

    $password= $_POST['password'];

    $id_kelas=$_POST['id_kelas'];

    if(empty($nama_siswa)){

        echo "<script>alert('nama siswa tidak boleh kosong');location.href='siswa.php';</script>";


    } elseif(empty($username)){

        echo "<script>alert('username tidak boleh kosong');location.href='siswa.php';</script>";

    } elseif(empty($password)){

        echo "<script>alert('password tidak boleh kosong');location.href='siswa.php';</script>";

    } else {

        include "koneksi.php";

        $insert=mysqli_query($konn,"insert into siswa (nama_siswa,tanggal_lahir, gender, alamat, username, password, id_kelas) value ('".$nama_siswa."','".$tanggal_lahir."','".$gender."','".$alamat."','".$username."','".md5($password)."','".$id_kelas."')") or die(mysqli_error($conn));

        if($insert){

            echo "<script>alert('Sukses menambahkan siswa');location.href='siswa.php';</script>";

        } else {

            echo "<script>alert('Gagal menambahkan siswa');location.href='siswa.php';</script>";

        }

    }

}

?>

?>