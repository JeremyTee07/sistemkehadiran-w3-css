<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php 
include('kawalan-admin.php');

# menyemak kewujudan data POST
if(!empty($_POST))
{ 
    # memanggil fail connection.php
    include('connection.php');

    # arahan SQL (query) untuk kemaskini maklumat aktiviti
    $arahan            =    "update aktiviti set
    Nama_aktiviti      =    '".$_POST['Nama_aktiviti']."',
    Tarikh_aktiviti    =    '".$_POST['Tarikh_aktiviti']."',
    masa_aktiviti      =    '".$_POST['masa_aktiviti']."'
    where
    IDaktiviti         =    '".$_GET['IDaktiviti']."' ";

    # melaksanakan dan menyemak proses kemaskini
    if(mysqli_query($condb,$arahan))
    { 
        # kemaskini gagal
        echo "<script>alert('Kemaskini Berjaya');
        window.location.href='senarai-aktiviti.php';</script>";
    }
    else
    { 
        # kemaskini gagal
        echo "<script>alert('Kemaskini Gagal');
        window.history.back();</script>";
    }
}
else
{ 
    # jika data GET tidak wujud. kembali ke fail senarai-aktiviti.php 
    die("<script>alert('Sila lengkapkan data');
    window.location.href='senarai-aktiviti.php';</script>");
}
?>