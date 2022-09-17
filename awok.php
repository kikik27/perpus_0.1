<!DOCTYPE html>  
 <html>  
 <head>  
      <title>Belajar</title>  
 </head>  
 <body>  
      <center><h3</h3>  
           <form>  
                <tr>  
                <table border="1">  
                     <td>Id Mobil </td>  
                     <?php
                     include "koneksi.php"; 
                      ?>  
                     <td><select name="id_mobil" id="id_mobil" class="form-control" onchange='changeValue(this.value)' required >
                     <option name="id_produk" value="0">Pilih Nama Barang</option></option>
                          <?php   
                          $query = mysqli_query($konn, "select * from produk order by id_produk esc");  
                          $result = mysqli_query($konn, "select * from produk");  
                          $harga         = "var harga = new Array();\n;";  
                          while ($row = mysqli_fetch_array($result)) {
                               echo '<option name="id_produk" value="'.$row['id_produk'] . '">' . $row['nam_produk'] . '</option>';   
                          $harga .= "harga['" . $row['id_produk'] . "'] = {harga:'" . addslashes($row['harga'])."'};\n";  
                          }  
                          ?>  
                     </select></td>  
                </tr>  
                <tr>  
                     <td>Harga </td>  
                     <td><input type="text" name="harga" id="harga" onkeyup="sum();" readonly></td>  
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" id="qty" onkeyup="sum();" ></td>
                </tr>
                <tr>
                    <td>Sub Total</td>
                    <td><input type="number" name="sub_total" id="sub_total"></td>
                </tr>
                <script>
                    function sum(){
                        var txtFirstNumberValue = document.getElementById('harga').value;
                        var txtSecondNumberValue = document.getElementById('qty').value;
                        var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
                        if (!isNaN(result)) {
                        document.getElementById('sub_total').value = result;
                        }
                    }
                </script>
                <script type="text/javascript">   
                          <?php   
                          echo $harga;   ?>  
                          function changeValue(id){  
                            document.getElementById('harga').value = harga[id].harga; 
                          };  
                          </script>  
                </table>  
           </form>  
 </body>  
 </html>  