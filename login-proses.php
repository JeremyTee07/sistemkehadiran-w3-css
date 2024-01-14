<?php
# memulakan fungsi session
session_start();

# menyemak kewujudan data post yang dihantar dari login-borang.php 
if(!empty($_POST['IDpeserta']) and !empty($_POST['Katalaluan']))
{
    # memanggil fail connection.php
    include ('connection.php');

    # Mengambil data yang di POST dari fail Borang 
    $IDpeserta       =    $_POST['IDpeserta'];
    $Katalaluan      =    $_POST['Katalaluan'];

    # Arahan SQL (query) untuk membandingkan data yang dimasukkan
    # wujud di pangkalan data atau tidak
    $query_login = "select * from peserta
    where
           IDpeserta         = '$IDpeserta'
    and    Katalaluan        = '$Katalaluan' LIMIT 1";
    
    # melaksanakan arahan membandingkan data
    $laksana_query = mysqli_query($condb,$query_login);

    # jika terdapat 1 data yang sepadan, login berjaya
    if(mysqli_num_rows($laksana_query)==1)
    { 
        # mengambil data yang ditemui
        $m  =  mysqli_fetch_array($laksana_query);

        # mengumpulkkan kepada pembolehubah session
        $_SESSION['IDpeserta']  =  $m['IDpeserta'];
        $_SESSION['Tahap']      =  $m['Tahap'];
        $_SESSION['Nama']       =  $m['Nama'];
         # membukan laman index.php
         echo "<script>window.location.href='index.php';</script>";
    }
    else
    { 
        # login gagal. kembali ke laman login-borang.php 
        die("<script>alert('Login Gagal');
        window.location.href='login-borang.php';</script>");
    }
}    
else
{ 
    # data yang dihantar dari laman login-borang.php kosong
    die("<script>alert('Sila masukkan IDpeserta dan Katalaluan');
    window.location.href='login-borang.php';</script>");
}
?>