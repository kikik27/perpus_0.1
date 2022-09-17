<?php 

session_start();

if ($_SESSION['status_login']!=true) {
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
<a href="kelas.php" class="btn btn-success py-3 col-md-3 mb-3">Data Kelas</a>
<a href="tambah_siswa.php" class="btn btn-success py-3 col-md-3 mb-3">Tambah Siswa</a>


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
					$query = "SELECT * FROM siswa WHERE id_siswa like '%".$kata_cari."%' OR nama_siswa like '%".$kata_cari."%' OR alamat like '%".$kata_cari."%' OR gender like '%".$kata_cari."%' ORDER BY id_siswa ASC";
				} else {
					//jika tidak ada pencarian, default yang dijalankan query ini
					$query = "SELECT * FROM siswa ORDER BY id_siswa ASC";
				}
				

				$result = mysqli_query($konn, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($konn)." - ".mysqli_error($konn));
				}
				//kalau ini melakukan foreach atau perulangan
				while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["id_siswa"];
                    $nama = $row["nama_siswa"];
                    $alamat = $row["alamat"];
                    $tgl_lhr = $row["tanggal_lahir"];
                    $gndr = $row["gender"];
                    $username = $row["username"];
                    $id_kelas = $row["id_kelas"];

                    $kls = mysqli_query($konn, "SELECT * FROM kelas where id_kelas = '$id_kelas' order by id_kelas asc");
                    $dt = mysqli_fetch_array($kls);
                    $kelas = $dt['nama_kelas'];
			?>
		<div class="col-sm-3 mb-5">
        <div class="card" style="text-align: center" >
        <?php
        if ($gndr == "L"){
            ?>
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" class="card-img-top" alt="gambar">
            <?php
        }else{
            ?>
            <img src="gambar/p.png" class="card-img-top" alt="gambar">
        <?php
        }
        ?>

            <div class="card-footer">
                <h5><?php echo $nama; ?></h5>
            </div>
            <div class="card-footer">
            <p class="card-text">TL : <?php echo $tgl_lhr ?></p>
            </div>
            <div class="card-footer">
            <p class="card-text">Gender : <?php echo $gndr ?></p>
            </div>
            <div class="card-footer">
            <p class="card-text">Alamat : <?php echo $alamat?></p>
            </div>
            <div class="card-footer">
            <p class="card-text">Username : <?php echo $username; ?></p>
            </div>
            <div class="card-footer">
            <p class="card-text">Kelas :<?php echo $kelas; ?></p>
            </div>

            
            <div class="card-footer" style="align-content: center;">
                <a href="ubah_siswa.php?id_kelas=<?php echo $id?>" class="btn btn-warning">Ubah</a>
                <a href="hapus_siswa.php?id_siswa=<?php echo $id?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger">Hapus</a>
            </div>

        </div>
        </div>
			<?php
			}
			?>

    </div>
</div>
</body>
<?php include "footer.php"; ?>
</html>