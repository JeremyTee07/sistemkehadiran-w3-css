<?php
# Menyemak nilai pembolehubah session['Tahap']
if(!empty($_SESSION['Tahap'])) { 
    if($_SESSION['Tahap'] != "ADMIN")
    { 
        #jika nilainya tidak sama dengan PESERTA BIASA. aturcara akan dihentikan
        die("<script>alert('Sila login');
        window.location.href='logout.php';</script>");
    }
}else{ 
    # jika nilai session empty.
    die("<script>alert('Sila login');
    window.location.href='logout.php';</script>");
}
?>