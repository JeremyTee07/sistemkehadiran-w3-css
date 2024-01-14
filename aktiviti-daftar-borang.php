<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header dan fail kawalan-admin.php 
include('header.php');
include('kawalan-admin.php');
?>

<h3>Daftar Aktiviti Baru</h3>
<!-- borang untuk menerima data dari pengguna --> 
<form action='aktiviti-daftar-proses.php' method='POST'>

Nama Aktiviti
<input type='text' name='Nama_aktiviti' placeholder='maximum 60 char'  required><br>

Tarikh Aktiviti
<input type='date' name='Tarikh_aktiviti' min='<?= date("Y-m-d") ?>'  required><br> 

Masa Aktiviti
<input type='time' name='masa_aktiviti' min='<?= date("H:i") ?>'  required><br>

<input type='submit' value='Daftar'>

</form>
<?php include ('footer.php'); ?>