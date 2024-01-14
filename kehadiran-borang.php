<?php
# memulakan fungsi session
session_start();

# memanggil fail header.php, connection.php dan guard-admin.php 
include('header.php');
include('connection.php');
include('kawalan-admin.php');

# Mendapatkan maklumat aktiviti dari pangkalan data
$arahan_sql_aktiviti  =  "select* from aktiviti where IDaktiviti='".$_GET['IDaktiviti']."' ";
$laksana_aktiviti     =  mysqli_query($condb,$arahan_sql_aktiviti);
$n                    =  mysqli_fetch_array($laksana_aktiviti);

?>

<h3>Pengesahan Kehadiran Peserta</h3>

Nama Aktiviti : <?= $n['Nama_aktiviti'] ?> <br>
Tarikh | Masa : <?= $n['Tarikh_aktiviti']." | ".$n['masa_aktiviti'] ?><br>
<br><br>

<?php include('butang-saiz.php'); ?>
<form action='kehadiran-proses.php?IDaktiviti=<?= $_GET['IDaktiviti'] ?>'
method='POST'>
<table border='1' id='saiz' width='100%'>
    <tr>
        <td>Bil</td>
        <td>Nama</td>
        <td>IDpeserta</td>
        <td>ID Jabatan</td>
        <td>Kehadiran</td>
    </tr>

<?php

# Arahan untuk mendapatkan data kehadiran setiap ahli
$arahan_sql_kehadiran = "SELECT
peserta.IDpeserta, peserta.Nama,
jabatan.IDjabatan, 
kehadiran.IDaktiviti
FROM peserta
LEFT JOIN jabatan
ON peserta.IDjabatan  =  jabatan.IDjabatan
LEFT JOIN kehadiran
ON peserta.IDpeserta  =  kehadiran.IDpeserta
AND kehadiran.IDaktiviti='".$_GET['IDaktiviti']."'
ORDER BY peserta.Nama";

# Laksanakan arahan untuk memproses data
$laksana_kehadiran  =  mysqli_query($condb,$arahan_sql_kehadiran);
$bil=0;

# Mengambil dan memaparkan semua data kehadiran yang ditemui
while($m=mysqli_fetch_array($laksana_kehadiran)){  ?>
   <tr>
        <td><?= ++$bil; ?></td>
        <td><?= $m['Nama'] ?></td>
        <td><?= $m['IDpeserta'] ?></td>
        <td><?= $m['IDjabatan'] ?> </td>
        <td><?php
    
        if($m['IDaktiviti'] != null)    
        { 
            $tanda='checked';
        } else
        $tanda="";
        ?>

        <input <?= $tanda ?>  type='checkbox' name='kehadiran[]'
        value='<?= $m['IDpeserta'] ?> ' style='width;30px; height:30px;'>
        </td>
        <?PHP
}
?>
<tr>
    <td colspan='4'></td>
    <td><input type='submit' value='Simpan'></td>
</tr>
</table>
</form>
<?php include ('footer.php'); ?>