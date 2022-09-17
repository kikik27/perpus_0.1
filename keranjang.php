<?php 
    

    session_start();
    
    if ($_SESSION['status_login']!=true) {
        header("Location:login.php");
    
    }
    include "navbar.php";

?>

<div class="container col-8 py-5">
        <?php
        if(@$_SESSION['cart'] == 0){
            echo '<script>alert("Keranjang anda kosong");location.href="buku.php"</script>';
        }else{
            ?>
            <h2 class="mb-4">Daftar Buku di Keranjang</h2>
            <table class="table table-hover striped">
            <thead>

            <tr>
    
                <th>NO</th>
                <th>Nama Buku</th>
                <th>Jumlah</th>
                <th></th>
    
            </tr>
    
        </thead>
    
        <tbody>
            <?php
            foreach (@$_SESSION['cart'] as $key_produk => $val_produk): ?>

                <tr>    
    
                    <td><?=($key_produk+1)?></td>
                    <td><?=$val_produk['nama_buku']?></td>
                    <td><?=$val_produk['qty']?></td>
                    <td><a href="hapus_keranjang.php?id=<?=$key_produk?>" class="btn btn-danger"><strong>X</strong></a></td>
    
                </tr>
                <?php endforeach ?>
            <?php

        }
        
        ?>
                </tbody>

</table>
                <form action="" method="post">
                    <input type="submit" name="checkout" value="Check Out" class="btn btn-success col-3 mb-4 " style="float:right;" />
                </form>
<?php
if(isset($_POST['checkout'])){
    $id_siswa = $_SESSION['id_siswa'];

    include "koneksi.php";

    $cart=@$_SESSION['cart'];

    if(count($cart)>0){

        $lama_pinjam=5; //satuan hari

        $tgl_harus_kembali=date('Y-m-d',mktime(0,0,0,date('m'),(date('d')+$lama_pinjam),date('Y')));

        mysqli_query($konn,"insert into peminjaman_buku (id_siswa,tanggal_pinjam,tanggal_kembali) value('".$_SESSION['id_siswa']."','".date('Y-m-d')."','".$tgl_harus_kembali."')");

        $id=mysqli_insert_id($konn);


        foreach ($cart as $key_produk => $val_produk) {

            mysqli_query($konn,"insert into detail_peminjaman_buku (id_peminjaman_buku,id_buku,qty) value('".$id."','".$val_produk['id_buku']."','".$val_produk['qty']."')");

        }



        unset($_SESSION['cart']);

        echo '<script>alert("Anda berhasil meminjam buku");location.href="peminjaman.php"</script>';

    }
}

?>

<?php 

    include "footer.php";

?>
</div>