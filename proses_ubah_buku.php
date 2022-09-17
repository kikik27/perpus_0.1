<?php
                    if($_POST) {
                        $id_buku = $_POST['id_buku'];
                        $nama=$_POST['nama_buku'];
                        $deskripsi=$_POST['deskripsi'];
                        $foto = basename($_FILES["foto"]["name"]);
                        $target_dir = "gambar/";
                        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    
                        if(empty($nama)){
                            echo "<script>alert('nama buku tidak boleh kosong');location.href='ubah_buku.php?id_buku=<?php echo $id?>';</script>";
                        } elseif(empty($deskripsi)){
                            echo "<script>alert('deskripsi produk tidak boleh kosong');location.href='ubah_buku.php?id_buku=<?php echo $id?>';</script>";
                        } elseif(empty($foto)){
                            include "koneksi.php";
                                    
                                    
                                    $update=mysqli_query($konn,"update buku set nama_buku='".$nama."', deskripsi='".$deskripsi."' where id_buku = '".$id_buku."' ") or die(mysqli_error($conn));
                                    
                    
                                    if($update) {
                                        echo "<script>alert('Sukses menguubah buku');location.href='buku.php';</script>";
                                    } else {
                                        echo "<script>alert('Gagal mengubah buku');location.href='ubah_buku.php';</script>";
                                    }
                        } else {
                            // Check if image file is a actual image or fake image
                            $check = getimagesize($_FILES["foto"]["tmp_name"]);
                            if($check == false) {
                                echo "<script>alert('File yang dipilih bukan foto.');location.href='ubah_buku.php?id_buku=<?php echo $id?>';</script>";
                                $uploadOk = 0;
                            } else {
                                $uploadOk = 1;
                            }
                    
                            // Check if file already exists
                            if (file_exists($target_file)) {
                                echo "<script>alert('File foto sudah ada.');location.href='ubah_buku.php?id_buku=<?php echo $id?>';</script>";
                            $uploadOk = 0;
                            }
                    
                            // Check file size
                            if ($_FILES["foto"]["size"] > 999999999999) {
                                echo "<script>alert('File foto terlalu besar');location.href='ubah_buku.php?id_buku=<?php echo $id?>';</script>";
                            $uploadOk = 0;
                            }
                    
                            // Allow certain file formats
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                                echo "<script>alert('Hanya menerima file foto JPG, JPEG, PNG & GIF');location.href='ubah_buku.php?id_buku=<?php echo $id?>';</script>";
                            $uploadOk = 0;
                            }
                    
                            // Check if $uploadOk is set to 0 by an error
                            if ($uploadOk == 0) {
                                echo "<script>alert('File foto tidak terupload');location.href='ubah_buku.php?id_buku=<?php echo $id?>p';</script>";  
                            // if everything is ok, try to upload file
                            } else {
                                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                                    
                                    include "koneksi.php";
                                    
                                    $sql = "update petugas set nama_buku='".$nama."'deskripsi='".$des."' where id_buku = '".$id_buku."'" or die(mysqli_error($conn));
                                    
                                    $insert=mysqli_query($konn, $sql);
                    
                                    if($insert) {
                                        echo "<script>alert('Sukses menambahkan buku');location.href='buku.php';</script>";
                                    } else {
                                        echo "<script>alert('Gagal menambahkan buku');location.href='tambah_buku.php';</script>";
                                    }
                                } else {
                                    echo "<script>alert('Error saat upload file foto');location.href='tambah_buku.php';</script>";
                                }
                            }
                    
                        }
                    }

                ?>