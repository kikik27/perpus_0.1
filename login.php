

<?php 

session_start();

if ($_SESSION['status_login']=false) {
    header("Location: login.php");

}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        body{
            background-color: #0e1c36;
        }
        .btn-color{
        background-color: #0e1c36;
        color: #fff;
        
        }

        .profile-image-pic{
        height: 200px;
        width: 200px;
        object-fit: cover;
        }



        .cardbody-color{
        background-color: #ebf2fa;
        }

        a{
        text-decoration: none;
        }
    </style>
    
</head>
<body>
<div class="container">
<div class="container">
<div class="row">
    <div class="col-md-6 offset-md-3">
    <h1 class="text-center text-light mt-5">Login Perpustakaan Telkom</h1>
    <div class="text-center mb-5 text-light">namakokkikik</div>
    <div class="card my-5">

        <form action="" method="post" class="card-body cardbody-color p-lg-5">

        <div class="text-center">
            <img src="gambar/bebek.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
        </div>

        <div class="mb-3">
            <input type="text" name="username" class="form-control" id="Username" aria-describedby="emailHelp" placeholder="Username">
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="text-center">
            <input type="submit" name="submit" class="btn btn-color px-5 mb-5 w-100">
        </div>
        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
            Registered? <a href="admin.php" class="text-dark fw-bold"> Create an
            Account</a>
        </div>
        </form>
        <?php
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            if(empty($username)){
                echo "<script>alert('Username Tidak Boleh Kosong');location.href='login.php';</script>";

            }elseif(empty($password)){
                echo "<script>alert('Password Tidak Boleh Kosong');location.href='login.php';</script>";

            }else{
                include "koneksi.php";
                $qry = mysqli_query($konn, "select * from siswa where username='$username' and password='".md5($password)."'");

                if(mysqli_num_rows($qry)>0){
                    $dt_login= mysqli_fetch_array($qry);
                    session_start();
                    $_SESSION['id_siswa']=$dt_login['id_siswa'];
                    $_SESSION['nama']=$dt_login['nama_siswa'];
                    $_SESSION['status_login']=true;
                    echo "<script>location.href='index.php';</script>";
                }else {
                
                    echo "<script>alert('Username dan Password Salah');location.href='login.php';</script>";
                }
            }
        }
        ?>
    </div>

    </div>
</div>
</div>
</div>
</body>
</html>

<div class="fixed-bottom">
        <footer class="p-3 bg-light text-dark d-flex justify-content-center"><p>Copyright &copy; <b><a href="https://www.instagram.com/namakokkikik">PERPUSTAKAAN TELKOM</a></b> All right reserved.</p></footer>
    </div>
