<?php
if($_POST) {
    $nama=$_POST['nama_buku'];
    $deskripsi=$_POST['deskripsi'];
    $foto = basename($_FILES["foto"]["name"]);
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(empty($nama)){
        echo "<script>alert('nama buku tidak boleh kosong');location.href='tambah_buku.php';</script>";
    } elseif(empty($deskripsi)){
        echo "<script>alert('deskripsi produk tidak boleh kosong');location.href='tambah_buku.php';</script>";
    } elseif(empty($foto)){
        echo "<script>alert('foto produk tidak boleh kosong');location.href='tambah_buku.php';</script>"; 
    } else {
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check == false) {
            echo "<script>alert('File yang dipilih bukan foto.');location.href='tambah_buku.php';</script>";
            $uploadOk = 0;
        } else {
            $uploadOk = 1;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('File foto sudah ada.');location.href='tambah_buku.php';</script>";
        $uploadOk = 0;
        }
	}
}
?>

<td><a href="gambar/"></a></td>