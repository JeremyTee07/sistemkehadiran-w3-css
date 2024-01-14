<?php
# memulakan fungsi SESSION
session_start();

# menyemak kewujudan data post
if(!empty($_POST))
{ 
    # Memanggil fail Connection.php
    include ('connection.php');

    # Mengambil data yang dihantar dari fail signup-borang.php 
    $IDpeserta           =  $_POST['IDpeserta'];
    $Nama                =  $_POST['Nama'];
    $Katalaluan          =  $_POST['Katalaluan'];
    $IDjabatan           =  $_POST['IDjabatan'];
    
    # data validation : had atas has bawah
    #IDpeserta yang dimasukkan hendaklah 20 digit dan tidak mempunyai huruf atau simbol
    if(strlen($IDpeserta) != 6 or !is_numeric($IDpeserta))
    { 
        die ("<script>alert ('Ralat Pada ID Peserta ANDA');
        window.location.href='signup-borang.php'; </script>");
    }

    # menyemak adakah IDpeserta yang dimasukkan telah wujud dalam pangkalan data
    $arahan_sql_semak       =  "select* from peserta where IDpeserta='$IDpeserta' limit 1";
    $laksana_arahan_semak   =  mysqli_query($condb,$arahan_sql_semak);
    if(mysqli_num_rows($laksana_arahan_semak)==1)
    { 
        # jika IDpeserta yang dimasukkan telah wujud. aturcara akan dihentikan.
        die("<script>alert ('RALAT ID Peserta. ID PESERTA yang dimasukkan telah digunakan');
        window.location.href='signup-borang.php'; </script>");
    }
    
    #  arahan SQL (query) untuk menyimpankan data peserta baru
    $arahan_sql_simpan = "insert into peserta
    (IDpeserta, Nama, Katalaluan, Tahap, IDjabatan)
    values
    ('$IDpeserta', '$Nama', '$Katalaluan', 'PESERTA BIASA', '$IDjabatan') ";
    
    # Melaksanakan arahan SQL menyimpan data peserta baru
    $laksana_arahan_simpan = mysqli_query($condb,$arahan_sql_simpan);

    #menguji jika proses menyimpan data berjaya atau tidak
    if($laksana_arahan_simpan)
    { 
        # jiaka data berjaya disimpan. papar popup dan buka fail peserta-login-borang
        echo"<script>alert('Pendaftaran Berjaya. Sila Log Masuk');
        window.location.href='login-borang.php'; </script>";
    }
    else
        { 
            # jika data tidak berjaya disimpan. papar popup dan buka fail signup-borangh
            echo"<script>alert('Pendaftaran Gagal');
            window.location.href='signup-borang.php'; </script>";
        }
}
else
{ 
    # jika pengguna buka fail ini tanpa mengisi data.
    # papar popup dan buka fail signup-borang.php
    echo"<script>alert('Sila lengkapkan maklumat anda');
    window.location.href='signup-borang.php'; </script>";
}
?>