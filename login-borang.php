<?php
# Memulakan fungsi session
session_start();

# memanggil fail header.php
include('header.php');
?>

<!-- Tajuk antaramuka log masuk  -->
<h3>Login Peserta</h3>

<!-- borang daftar masuk log in/sign in)  --> 
<form action='login-proses.php' method='POST'>

    ID Peserta        <input type='text'      name='IDpeserta' ><br>
    Katalaluan        <input type='Password'  name='Katalaluan' ><br>
                      <input type='submit'    value='Login'>
</form>
<?php include ('footer.php'); ?>