<?php
# memulakan fungsi session 
session_start();

# memanggil fail header.php, connection.php dan kawalan-admin.php 
include('header.php');
include('connection.php');
include('kawalan-admin.php');

?>
<!-- Header bagi jadual untuk memaparkan senarai ahli --> 
<h3 class="w3-cursive" align='center'>Senarai Peserta</h3>

<table align='center' width='100%' border='1' id='saiz'>
    <tr bgcolor='cyan'>
        <td colspan='3'>
            <form action='' method='POST' style="margin:0; padding:0;">
                <input type='text'     name='Nama'   placeholder='Carian Nama Peserta'>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </td>
            <td colspan='4' align='right'>
            <a class='w3-button w3-round-medium w3-yellow' href='upload.php'><i class="fa fa-upload w3-large"></i></a>
            <?php include('butang-saiz.php'); ?>
        </td>
</tr>
<div class="w3-cursive">
<tr bgcolor='yellow'>
    <td width='15%'>ID Peserta</td>
    <td width='15%'>Nama</td>
    <td width='10%'>Katalaluan</td>
    <td width='10%'>Tahap</td>
    <td width='10%'>ID Jabatan</td>
    <td width='20%'>Nama Jabatan</td>
    <td width='10%'>Tindakan</td>
</tr>
</div>
<?php

# syarat tambahan yang akan dimasukkan dalam arahan(query) senarai peserta
$tambahan="";
if(!empty($_POST['Nama']))
{ 
    $tambahan= " and peserta.Nama like '%".$_POST['Nama']."%'";
}

# arahan query untuk mencari senarai nama peserta
$arahan_papar="select* from peserta, jabatan
where peserta.IDjabatan = jabatan.IDjabatan
$tambahan ";

# laksanakan arahan mencari data peserta
$laksana = mysqli_query($condb,$arahan_papar);

# Mengambil data yang ditemui
    while($m = mysqli_fetch_array($laksana))
    { 
        # umpukkan data kepada tatasusunan bagi tujuan kemaskini peserta
        $data_get=array( 
            'IDpeserta'        =>  $m['IDpeserta'],
            'Nama'             =>  $m['Nama'],
            'Katalaluan'       =>  $m['Katalaluan'],
            'Tahap'            =>  $m['Tahap'],
            'IDjabatan'        =>  $m['IDjabatan'],
            'Nama_Jabatan'     =>  $m['Nama_Jabatan']

        );
        
        # memaparkan senarai nama dalam jadual
        echo"<tr>
        <td>".$m['IDpeserta']."</td>
        <td>".$m['Nama']."</td>
        <td>".$m['Katalaluan']."</td>
        <td>".$m['Tahap']."</td>  
        <td>".$m['IDjabatan']."</td>
        <td>".$m['Nama_Jabatan']."</td>";

        # memaparkan navigasi untuk kemaskini dan hapus data peserta
        echo"<td>
        <a class='w3-button w3-round-medium w3-blue' href='peserta-kemaskini-borang.php?".http_build_query($data_get)."'>
        <i class=\"fa fa-pencil w3-xlarge\"></i></a>

        <a class='w3-button w3-round-medium w3-red' href='peserta-padam-proses.php?IDpeserta=".$m['IDpeserta']."'
        onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">
        <i class=\"fa fa-trash w3-xlarge\"></i></a>

        </td>
        </tr>";
    }

?>
</table>
<?php include ('footer.php'); ?>