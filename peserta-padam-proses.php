<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php 
include('kawalan-admin.php');

# menyemak kewujudan data GET IDpeserta peserta
if(!empty($_GET))
{ 
    # memanggil fail connection
    include('connection.php');

    # arahan SQL untuk memadam data peserta berdasarkan IDpeserta yang dihantar
    $arahan    =    "delete from peserta where IDpeserta='".$_GET['IDpeserta']."'";

    # melaksanakan arahan SQL padam data dan menguji proses padam data
    if(mysqli_query($condb,$arahan))
    { 
        # jika data gagal dipadam
        echo "<script>alert('Padam data berjaya');
        window.location.href='senarai-peserta.php';</script>";
    }
}
else
{ 
    # jika data GET tidak wujud (empty)
    die("<script>alert('Ralat! akses secara terus');
    window.location.href='senarai-peserta.php';</script>");
}
?>