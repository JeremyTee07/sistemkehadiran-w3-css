<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php 
include('kawalan-admin.php');

# menyemak kewujudan data POST
if(!empty($_POST))
{ 
    #memanggil fail connection.php
    include('connection.php');

    # pengesahan data (validation) IDpeserta peserta
    if(strlen($_POST['IDpeserta']) != 6 or !is_numeric($_POST['IDpeserta']))
    { 
        die("<script>alert('Ralat IDpeserta');
        window.history.back();</script>");
    }
    # arahan SQL (query) untuk kemaskini makmulat peserta
    $arahan         =   "update peserta set
    IDpeserta       =   '".$_POST['IDpeserta']."',
    Nama            =   '".$_POST['Nama']."',
    Katalaluan      =   '".$_POST['Katalaluan']."',
    Tahap           =   '".$_POST['Tahap']."',
    IDjabatan       =   '".$_POST['IDjabatan']."'
    where
    IDpeserta       =   '".$_GET['IDpeserta_lama']."' ";
    
    # melaksanakan dan menyemak proses kemaskini
    if(mysqli_query($condb,$arahan))
    { 
        # kemaskini berjaya
        echo  "<script>alert('Kemaskini Berjaya');
        window.location.href='senarai-peserta.php';</script>";
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
    # jika data GET tidak wujud. Kembali ke fail senarai-peserta.php 
    die("<script>alert('Sila lengkapkan data');
    window.location.href='senarai-peserta.php';</script>");
}
?>

