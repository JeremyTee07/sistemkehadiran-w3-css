<?php
# Menyemak nilai pembolehubah session['tahap']
if(!empty($_SESSION['Tahap'])) { 
    if($_SESSION['Tahap'] != "PESERTA BIASA")
    { 
        # jika nilainya tidak sama dengan PESERTA BIASA. aturcar akan dihentikan
        die("<script>alert('Sila Login')
        window.location.href='logout.php';</script>");
    }
} else{ 
    # jika nilai session empty.
    die("<script>alert('Sila Login');
    window.location.href='logout.php';</script>");
}
?>