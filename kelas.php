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

<title></title>
</head>
<body>
<div class="container col-11 py-5">
        <div class="mb-3">
        <form action="" method="post" class="form-inline py-3" style="float: right">
<input name="search" class="form-control mr-sm-2" placeholder="Search" aria-label="Search" value="
<?php
if(isset($_POST['cari'])) {
  echo $_POST['search'];
}
?>">
    <button name="cari" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
        <a href="tambah_kelas.php" class="btn btn-success py-3 col-md-3 mb-3">Tambah Kelas</a>
        </div>
    <table class="table table-hover table-striped">
    <thead>
    <tr>

        <th>NO</th>
        <th>NAMA KELAS</th>
        <th>KELOMPOK</th>
        <th></th>

</tr>
    </thead>
    <tbody>
    <?php 
			//untuk meinclude kan koneksi
			include('koneksi.php');

				//jika kita klik cari, maka yang tampil query cari ini
				if(isset($_POST['cari'])) {
					//menampung variabel kata_cari dari form pencarian
					$kata_cari = $_POST['search'];

					//jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
					//jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
					$query = "SELECT * FROM kelas WHERE nama_kelas like '%".$kata_cari."%' OR kelompok like '%".$kata_cari."%' ORDER BY id_kelas ASC";
				} else {
					//jika tidak ada pencarian, default yang dijalankan query ini
					$query = "SELECT * FROM kelas ORDER BY id_kelas ASC";
				}
				

				$result = mysqli_query($konn, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($konn)." - ".mysqli_error($konn));
				}
				//kalau ini melakukan foreach atau perulangan
                $no=0;
                $row = mysqli_num_rows($result);
				while ($data_siswa = mysqli_fetch_assoc($result)) {
                    $no++;
                    if ($row <= 0){
                        echo '<script>alert("Daata Yang Dicari Tidak Ada");location.href="kelas.php"</script>';
                    }else{
                        ?>
                        <tr>
                        <td><?=$no?> </td>
                        <td> <?=$data_siswa['nama_kelas']?> </td>
                        <td> <?=$data_siswa['kelompok']?> </td>
                        
                        <td style="width: 180px">
                        <a href="ubah_kelas.php?id_kelas=<?=$data_siswa['id_kelas'] ?>"class="btn btn-success">Ubah </a> |
                        <a href="hapus_kelas.php?id_kelas=<?=$data_siswa['id_kelas'] ?>" onclick="return confirm('Are you sure you want to delete this item?') "class="btn btn-danger">Hapus</a>
                        </td>
                        <?php
                        $kata_cari = "";
                    }
                    ?>
                    

                    </tr>
			<?php
			}
			?>
    </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">

    </script>
        </div>
</body>
<?php
    include "footer.php";
    ?>
</html> 
<td><a href="gambar/<?php echo $_POST['cari']?></a></td>
