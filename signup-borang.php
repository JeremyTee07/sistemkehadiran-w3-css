<?php
# memulakan fungsi SESSION
session_start();

# Memanggil fail header.php & fail connection.php
include('header.php');
include('connection.php');
?>

<!-- Tajuk antaramuka--> 
<h3> Pendaftaran Peserta Baru </h3>

<!-- Borang Pendaftaran Peserta Baru-->
<form action = 'signup-proses.php' method = 'POST'>
    
  ID Peserta       <input type ='text'     name ='IDpeserta'      required> <br>
  Nama   Peserta   <input type ='text'     name ='Nama' required> <br>
  Nama Jabatan     <select name='IDjabatan'><br>
                   <option selected disabled value>Sila Pilih Jabatan</option>  
                   <?php
                   # Proses memaparkan senarai kelas dalam bentuk drop down list 
                   $arahan_sql_pilih   =  "select* from jabatan";
                   $laksana_arahan_pilih  =  mysqli_query($condb,$arahan_sql_pilih);
                   while($m=mysqli_fetch_array($laksana_arahan_pilih))
                   { 
                    echo "<option value='".$m['IDjabatan']."'>
                    ".$m['Nama_Jabatan']."
                    </option>";
                   }
                   ?>
                   </select> <br>
Katalaluan       <input type ='password' name ='Katalaluan' required> <br>
                   <input type ='submit'   value='Daftar'>
</form>
<?php include ('footer.php');?>                     

