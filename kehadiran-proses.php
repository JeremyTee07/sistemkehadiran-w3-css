<?php
# memanggil fail connection.php
include('connection.php');

# Memadam data kehadiran lama agar dapat memasukkan data kehadiran baru
$sqlpadam=mysqli_query($condb,"delete from kehadiran where 
IDaktiviti='".$_GET['IDaktiviti']."'");

$masa=date("H:i:s");
foreach ($_POST['kehadiran'] as $IDpeserta)
{ 
    # Menyimpan semula data kehadiran yang baru
    $simpandata=mysqli_query($condb,"insert into kehadiran
    (IDpeserta,IDaktiviti,Masadatang) values
    ('$IDpeserta','".$_GET['IDaktiviti']."','$masa') ");
}

echo"<script>alert('Kemaskini Kehadiran Selesai');
window.location.href='kehadiran-borang.php?IDaktiviti=".$_GET['IDaktiviti']."';
</script>";

?>