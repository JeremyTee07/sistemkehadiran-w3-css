<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php
include('header.php');
?>

<table width='100%' >
    <tr>
        <td width=70% bgcolor='#7CB9E8' >
            <!-- ubah nama fail banner.jpg mengikut nama gambar anda --> 
            <img src='https://www.metalforce.com.my/assets/f789697fad979a3ecdcddee3177757e7.jpg' 
            class="w3-round" alt="Norway" width='100%'>
        </td>
        <td align='center' bgcolor='#afeeee'>
        <h3 class="w3-cursive">Daftar Sebagai Peserta</h3>
        <h3 class="w3-cursive">Klik Pautan di bawah untuk Mendaftar</h3>
        <a class="w3-cursive w3-button w3-round-medium w3-blue-grey" href='signup-borang.php'>Daftar Sini</a>
        </td>
    </tr>
</table>
<?php include ('footer.php'); ?>
