<?php
# memulakan fungsi session
session_start();

# memanggil fail header.php, connection.php dan guard-aktiviti.php 
include('header.php');
include('connection.php');
include('kawalan-admin.php');

?>
<h3 class="w3-cursive" align='center'>Senarai aktiviti</h3>

<!-- Header bagi jadual untuk memaparkan senarai aktiviti --> 
<table align='center' width='100%' border='1' id='saiz'>
    <tr bgcolor='cyan'>
        <td>
            <form action='' method='POST' style="margin:0; padding:0;">
                <input type='text'     name='Nama_aktiviti'  placeholder='Carian Aktiviti'>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </td>
        <td colspan='2' align='right'>
            | <a class='w3-button w3-round-medium w3-light-green' href='aktiviti-daftar-borang.php'><i class="fa fa-upload"></i></a> |
            <!-- Memanggil fail butang-saiz bagi membolehkan pengguna mengubah saiz tulisan --> 
            <?php include('butang-saiz.php'); ?>

        </td>
    </tr>      
    <tr bgcolor ='yellow' align='center'>
        <td>Nama Aktiviti</td>
        <td>Tarikh | Masa</td>
        <td>Tindakan</td>
    </tr>
    
<?php 

# syarat tambahan yang akan dimasukkan dalam arahan(query) senarai aktiviti
$tambahan="";
if(!empty($_POST['Nama_aktiviti']))
{ 
    $tambahan="where Nama_aktiviti like '%".$_POST['Nama_aktiviti']."%'";
}

# arahan query untuk mencari senarai aktiviti
$arahan_papar="select* from aktiviti $tambahan ";

# laksanakan arahan mencari data aktiviti
$laksana = mysqli_query($condb,$arahan_papar);

# menghambil data yang ditemui
    while($m = mysqli_fetch_array($laksana))
    { 

        # memaparkan senarai nama dalam jadual
        echo"<tr>
        <td>".$m['Nama_aktiviti']."</td>
        <td>".$m['Tarikh_aktiviti']." | ".$m['masa_aktiviti']." </td> ";

        # memaparkan navigasi untuk kemaskini dan hapus data aktiviti
        echo"<td align='right'>
        <a class='w3-button w3-round-medium w3-blue' href='aktiviti-kemaskini-borang.php?IDaktiviti=".$m['IDaktiviti']."'>
        <i class=\"fa fa-pencil w3-xlarge\"></i></a>

        <a class='w3-button w3-round-medium w3-red' href='aktiviti-padam-proses.php?IDaktiviti=".$m['IDaktiviti']."'>
        <i class=\"fa fa-trash w3-xlarge\"></i></a>

        <a class='w3-button w3-round-medium w3-yellow' href='kehadiran-borang.php?IDaktiviti=".$m['IDaktiviti']."'>
        <i class=\"fa fa-address-card w3-xlarge\"></i></a>

        </td>
        </tr>";
    }

?>     
</table>
<?php include ('footer.php'); ?>    