<?php
session_start();
# memanggil fail connection dan kawalan-biasa
include('connection.php');

$masa=date("H:i:s");

# Menyemak kewujudan data GET IDaktiviti
if(!empty($_GET['IDaktiviti']) and !empty($_SESSION['IDpeserta']))
{ 

    # Arahan Simpan data kehadiran
    $sql = "insert into kehadiran (IDaktiviti,IDpeserta,Masadatang)
    values ('".$_GET['IDaktiviti']."', '".$_SESSION['IDpeserta']."','$masa') ";

    # Laksana arahan Simpan
    $simpandata=mysqli_query($condb,$sql);

    # menguji proses simpan
    if($simpandata){ 
        echo "<script>
            alert('Kehadiran anda telah disahkan');
            window.location.href='profil.php';
        </script>";
    }
    else { 
        echo "<script>
            alert('Kehadiran GAGAL disahkan. Sila Ke MEJA URUSETIA');
            window.location.href='profil.php';
        </script>";
    }
}
else 
{ 
    echo "<script>
        alert('Akses secara terus');
        window.location.href='logout.php';
    </script>";
}
?>