<?php 

session_start();

if ($_SESSION['status_login']!=true) {
    header("Location:login.php");

}
?>
<?php include "navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title></title>
</head>
<body>
<div class="container col-11 py-5">
<div class="mb-3">
<form action="" method="post" class="form-inline py-3" style="float: right">
<input name="search" class="form-control mr-sm-2" type="search" value="
<?php
if(isset($_POST['cari'])) {
  echo $_POST['search'];
}
?>" placeholder="Search" aria-label="Search">
    <button name="cari" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
<a href="tambah_petugas.php" class="btn btn-success py-3 col-md-3 mb-3">Tambah Petugas</a>
</div>
<div class="row" id="load_data">
    <?php 
			//untuk meinclude kan koneksi
			include('koneksi.php');

				//jika kita klik cari, maka yang tampil query cari ini
				if(isset($_POST['cari'])) {
					//menampung variabel kata_cari dari form pencarian
					$kata_cari = $_POST['search'];

					//jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
					//jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
					$query = "SELECT * FROM petugas WHERE id_petugas like '%".$kata_cari."%' OR nama_petugas like '%".$kata_cari."%' OR username like '%".$kata_cari."%' OR gender like '%".$kata_cari."%' ORDER BY id_petugas ASC";
				} else {
					//jika tidak ada pencarian, default yang dijalankan query ini
					$query = "SELECT * FROM petugas ORDER BY id_petugas ASC";
				}
				

				$result = mysqli_query($konn, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($konn)." - ".mysqli_error($konn));
				}
				//kalau ini melakukan foreach atau perulangan
				while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["id_petugas"];
                    $nama = $row["nama_petugas"];
                    $gender = $row["gender"];
                    $username = $row["username"];
			?>
		<div class="col-sm-3 mb-5">
        <div class="card">
            <?php 
            if ($gender == "L"){
                ?>
            <img src="https://cdn-icons-png.flaticon.com/512/3671/3671187.png" class="card-img-top" alt="gambar">
                <?php
            }else{
                ?>
            <img src="https://cdn-icons-png.flaticon.com/512/3678/3678864.png" class="card-img-top" alt="gambar">
                <?php
            }
            ?>

            <div class="card-body">
            <h5 class="card-title"><?php echo $nama; ?></h5>
            </div>
            <div class="card-footer" style="align-content: center;">
                <a href="ubah_petugas.php?id_petugas=<?php echo $id?>" class="btn btn-warning">Ubah</a>
                <a href="hapus_petugas.php?id_petugas=<?php echo $id?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger">Hapus</a>
            </div>
        </div>
        </div>
			<?php
			}
			?>

    </div>
</div>
</body>
<?php include 'footer.php'; ?>
</html>
<style type="text/css">
.card-body{
    text-align: center;
}
.card-footer{
    text-align: center;
}
</style>