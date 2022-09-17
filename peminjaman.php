<?php 
    session_start();
    
    if ($_SESSION['status_login']!=true) {
        header("Location:login.php");
    
    }
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
<h2>Histori Peminjaman Buku</h2>

</div>
<table class="table table-hover table-striped">
    <thead>
        <th>NO</th>
        <th>Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal harus Kembali</th>
        <th>Nama Buku</th>
        <th>Status</th>
        <th>Aksi</th>
    </thead>
    <tbody>

        <?php 
        include "koneksi.php";
        $qry_histori=mysqli_query($konn,"select * from peminjaman_buku order by id_peminjaman_buku desc");
        $no=0;
        while($data_histori=mysqli_fetch_array($qry_histori)){
            $no++;
            $siswa = mysqli_query($konn,"select * from siswa where id_siswa=$data_histori[id_siswa] order by id_siswa asc ");
            $dt_siswa = mysqli_fetch_array($siswa);
            //menampilkan buku yang dipinjam
            $buku_dipinjam="<ol>";
            $qry_buku=mysqli_query($konn,"select * from  detail_peminjaman_buku join buku on buku.id_buku=detail_peminjaman_buku.id_buku where id_peminjaman_buku = '".$data_histori['id_peminjaman_buku']."'");
            while($dt_buku=mysqli_fetch_array($qry_buku)){
                $buku_dipinjam.="<li>".$dt_buku['nama_buku']."</li>";
            }
            $buku_dipinjam.="</ol>";
            //untuk menampilkan status sudah kembali atau belum
            $qry_cek_kembali=mysqli_query($konn,"select * from pengembalian_buku where id_peminjaman_buku = '".$data_histori['id_peminjaman_buku']."'");
            if(mysqli_num_rows($qry_cek_kembali)>0){
                $data_kembali=mysqli_fetch_array($qry_cek_kembali);
                $denda="denda Rp. ".$data_kembali['denda'];
                $status_kembali="<label class='alert alert-success'>Sudah kembali <br>".$denda."</label>";
                $button_kembali="";
            } else {
                $status_kembali="<label class='alert alert-danger'>Belum kembali</label>";
                $button_kembali="<a href='kembali.php?id=".$data_histori['id_peminjaman_buku']."' class='btn btn-warning' onclick='return confirm(\"Yakin untuk kembalikan buku?\")'>Kembalikan</a>";
            }
        ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$dt_siswa['nama_siswa']?></td>
                <td><?=$data_histori['tanggal_pinjam']?></td>
                <td><?=$data_histori['tanggal_kembali']?></td>
                <td><?=$buku_dipinjam?></td>
                <td><?=$status_kembali?></td>
                <td><?=$button_kembali?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php 
    include "footer.php";
?>
</div>
