<?php
# memulakan fungsi session
session_start();

# memanggil fail header dan fail kawanlan-admin.php 
include('header.php');
include('kawalan-admin.php');
include('connection.php');

# menyemak kewujudan data GET. Jika data GET empty, buka fail senarai-ahli
if(empty($_GET)) { 
    die("<script>window.location.href='senarai-peserta.php';</script>");
}
?> 

<h3>Kemaskini Peserta Baru</h3>
<form action='peserta-kemaskini-proses.php?IDpeserta_lama=<?= $_GET['IDpeserta'] ?>' method='POST'>
IDpeserta
<input type='text' name='IDpeserta' value='<?= $_GET['IDpeserta'] ?>' required><br>

Nama
<input type='text' name='Nama' value='<?= $_GET['Nama'] ?>' required><br>

Katalaluan
<input type='text' name='Katalaluan' value='<?= $_GET['Katalaluan'] ?>' required><br>

Tahap
<select name='Tahap'><br>
<option value='<?= $_GET['Tahap'] ?>'> <?= $_GET['Tahap'] ?> </option>
<?php
     # Proses memaparkan senarai tahap dalam bentuk drop down list
    $arahan_sql_tahap       =   "select Tahap from peserta group by Tahap order by Tahap";
    $laksana_arahan_tahap   =   mysqli_query($condb,$arahan_sql_tahap);
    while($n=mysqli_fetch_array($laksana_arahan_tahap))
    { 
        if($n['Tahap'] != $_GET['Tahap']){ 
            echo "<option value='".$n['Tahap']."'>
                ".$n['Tahap']."
                </option>";
        }
    }
?>
</select>  <br>

Jabatan 
<input type='text' name='IDjabatan' value='<?= $_GET['IDjabatan'] ?>' required><br>

<input type='submit' value='Kemaskini'>

</form>
<?php include ('footer.php'); ?>