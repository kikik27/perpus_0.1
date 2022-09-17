
<?php 

session_start();

if ($_SESSION['status_login']!=true) {
    header("Location:login.php");

}
?>
<?php 
include "navbar.php"; 
?>

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
  <a href="tambah_buku.php" class="btn btn-success py-3 col-sm-3 mb-3">Tambah Buku</a>
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
					$query = "SELECT * FROM buku WHERE id_buku like '%".$kata_cari."%' OR nama_buku like '%".$kata_cari."%' OR deskripsi like '%".$kata_cari."%' ORDER BY id_buku ASC";
				} else {
					//jika tidak ada pencarian, default yang dijalankan query ini
					$query = "SELECT * FROM buku ORDER BY id_buku ASC";
				}
				

				$result = mysqli_query($konn, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($konn)." - ".mysqli_error($konn));
				}
				//kalau ini melakukan foreach atau perulangan
				while ($row = mysqli_fetch_assoc($result)) {
          $id = $row["id_buku"];
          $foto = $row["foto"];
          $deskripsi = $row["deskripsi"];
          $judul = $row["nama_buku"];
			?>
		<div class="col-sm-3 mb-5">
          <div class="card">
            <img src="gambar/<?php echo $foto; ?>" class="card-img-top" alt="gambar">
            <div class="card-body">
              <h5 class="card-title"><?php echo $judul; ?></h5>
              <p class="card-text"><?php echo $deskripsi; ?></p>
            </div>
            <div class="card-footer" style="align-content: center;">
            <a href="pinjam_buku.php?id_buku=<?php echo $id?>"class="btn btn-success">pinjam</a>
                <a href="ubah_buku.php?id_buku=<?php echo $id?>" class="btn btn-warning">Ubah</a>
                <a href="hapus_buku.php?id_buku=<?php echo $id?>?foto=<?php echo $foto?>"onclick="return confirm('Are you sure you want to delete this item?')"class="btn btn-danger">Hapus</a>
              </div>
          </div>
        </div>
			<?php
			}
			?>

    </div>
</div>

<style type="text/css">
  .card-body{
    text-align: center;
  }
  .card-footer{
    text-align: center;
  }
</style>
<?php include "footer.php"; ?>

