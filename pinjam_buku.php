<?php 

session_start();

if ($_SESSION['status_login']!=true) {
    header("Location:login.php");

}
?>
<?php 

    include "navbar.php";

    include "koneksi.php";

    $qry_detail_buku=mysqli_query($konn,"select * from buku where id_buku = '".$_GET['id_buku']."'");

    $dt_buku=mysqli_fetch_array($qry_detail_buku);


?>
<div class="container coll-11 py-5">


<h2 class="mb-3" >Pinjam Buku</h2>

<div class="row">
    <div class="container col-md-4">
        <img src="gambar/<?=$dt_buku['foto']?>" class="card-img-top">
    </div>
    <div class="col-md-8">

        <form action="" method="post">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <input type="hidden" name="id_buku" value="<?=$dt_buku['id_buku']?>" class="form-control">
                        <td>Nama Buku</td><td><?=$dt_buku['nama_buku']?></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td><td><?=$dt_buku['deskripsi']?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Pinjam</td><td><input type="number" name="jumlah_pinjam" value="1"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn btn-success" name="tmbh" type="submit" value="Tambah Ke Keranjang" style="float:right"></td></tr>
                    </tr>
                </thead>
            </table>
        </form>

    </div>

</div>
</div>

<?php 

    include "footer.php";

?>

<?php

if(isset($_POST['tmbh'])){
    $id_buku = $_POST['id_buku']; 
    include "koneksi.php";

    $qry_get_buku=mysqli_query($konn,"select * from buku where id_buku = '".$_POST['id_buku']."'");

    $dt_buku=mysqli_fetch_array($qry_get_buku);

    $keranjang=$_SESSION['cart'][]=array(

        'id_buku'=>$dt_buku['id_buku'],

        'nama_buku'=>$dt_buku['nama_buku'],

        'qty'=>$_POST['jumlah_pinjam']

    );
    if($keranjang){
        echo "<script>location.href='keranjang.php';</script>";
    }
}

?>