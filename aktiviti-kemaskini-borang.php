<?php
# memulakan fungsi session
session_start();

# memanggil fail header dan fail kawalan-admin.php
include('header.php');
include('kawalan-admin.php');
include('connection.php');

# menyemak kewujudan data GET. jika data GET empty, buka fail senarai-aktiviti.php 
if(empty($_GET)) { 
    die("<script>window.location.href='senarai-aktiviti.php';</script>");
}

# mendapatkan maklumat aktiviti dari pangkalan data
$arahan_sql_pilih = "select* from aktiviti where IDaktiviti='".$_GET['IDaktiviti']."' ";
$laksana_arahan = mysqli_query($condb,$arahan_sql_pilih);
$m = mysqli_fetch_array($laksana_arahan);

?>

<h3 p class="w3-serif">Kemaskini Aktiviti Baru</h3>

<form action='aktiviti-kemaskini-proses.php?IDaktiviti=<?= $m['IDaktiviti'] ?>'
method='POST'>

<h5 p class="w3-serif" >
Nama Aktiviti
<input type='text' name='Nama_aktiviti' value='<?= $m['Nama_aktiviti'] ?>' required><br>

Tarikh Aktiviti
<input type='date' name='Tarikh_aktiviti' min='<?= date("Y-m-d") ?>' value='<?=$m['Tarikh_aktiviti'] ?>' required><br>

Masa Aktiviti
<input type='time' name='masa_aktiviti' min='<?= date("H:i") ?>' value='<?= $m['masa_aktiviti'] ?>' required><br>

<input type='submit' value='Kemaskini'>


</form>
<?php include ('footer.php'); ?>