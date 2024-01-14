<?php
# memulakan fungsi session
session_start();

# memanggil fail header.php, connection.php dan guard-aktiviti.php 
include('header.php');
include('connection.php');
include('kawalan-admin.php');

?>
<h3 p class="w3-cursive">Laporan KehadiranAktiviti</h3>
<!-- Borang carian Aktiviti --> 
<h4 p class="w3-cursive">
<form action='' method='GET'>
    Aktiviti <select name='IDaktiviti'>
    <option selected disabled value>Sila Pilih Aktiviti</option>

    <?php
    # Proses memaparkan senarai aktiviti dalam bentuk drop down list
    $arahan_sql_pilih       =   "select* from aktiviti";
    $laksana_arahan_pilih   =   mysqli_query($condb,$arahan_sql_pilih);
    while($n=mysqli_fetch_array($laksana_arahan_pilih))
    { 
        echo "<option value='".$n['IDaktiviti']."'>
                ".$n['IDaktiviti']." | ".$n['Nama_aktiviti']."
                </option>";
    }
    ?>
    </select>
    <input type='submit' value='Cari'>
</form>

<?php
# syarat tambahan yang akan dimasukkan dalam arahan(query) senarai aktiviti
$tambahan="";
if(!empty($_GET['IDaktiviti']))
{ 
    # Mengambil nilai data GET di URL
    $IDaktiviti = $_GET['IDaktiviti'];

    # proses mendapatkan maklumat aktiviti
    $sql_aktiviti = "select* from aktiviti where IDaktiviti = '$IDaktiviti'";
    $laksana_aktiviti = mysqli_query($condb,$sql_aktiviti);
    $ma=mysqli_fetch_array($laksana_aktiviti);

    # Mendapatkan Analisis Kehadiran (bil hadir & bil ahli)
    $arahanSQL=" SELECT
    ( SELECT COUNT(*) FROM kehadiran
        where IDaktiviti = '".$ma['IDaktiviti']."' ) AS bil_hadir,
    ( SELECT COUNT(*) FROM peserta ) AS bil_peserta ";
    $laksanaSQL     =   mysqli_query($condb,$arahanSQL);
    $da             =   mysqli_fetch_array($laksanaSQL);
?>
<!-- Header bagi jadual untuk memaparkan senarai aktiviti --> 
<h4 p class="w3-cursive">
    <?= $ma['Nama_aktiviti'] ?><br>
    <?= $ma['Tarikh_aktiviti'] ?> | <?= $ma['masa_aktiviti'] ?><br>
    Kehadiran   :   <?= $da['bil_hadir']." / ".$da['bil_peserta'] ?> <br>
    Peratus     :   <?php echo number_format(($da['bil_hadir']/$da['bil_peserta']*100),2);
?> % 
</h4>

<table align='center' width='100%' border='1' id='saiz'>
<tr bgcolor='cyan'>
        <td colspan='3'>

<form action='kehadiran-laporan.php?IDaktiviti=<?= $IDaktiviti; ?>'
      method='POST' style="margin:0; padding:0;">

       <input type='text'      name='Nama'  placeholder='Carian Nama Peserta'>
       <button type="submit"><i class="fa fa-search"></i></button>
</form>

       </td>
       <td colspan='3' align='right'>
           <?php include('butang-saiz.php'); ?>
       </td>
    </tr>
    <tr class="w3-cursive" bgcolor='yellow'>
        <td>Bil</td>
        <td>Nama</td>
        <td>IDpeserta</td>
        <td>ID Jabatan</td>
        <td>Nama Jabatan</td>
        <td>Kehadiran</td>
    </tr>

<?PHP 

# syarat tambahan yang akan dimasukkan dalam arahan(query) senarai peserta
$tambahan="";
if(!empty($_POST['Nama']))
{ 
    $tambahan= " where peserta.Nama like '%".$_POST['Nama']."%'";
}

# sayarat query untuk mencari senarai Aktiviti
$arahan_papar="
SELECT *, peserta.IDpeserta
 FROM peserta
 LEFT JOIN jabatan
 ON peserta.IDjabatan = jabatan.IDjabatan
 LEFT JOIN kehadiran
 ON peserta.IDpeserta = kehadiran.IDpeserta
 and IDaktiviti like '%$IDaktiviti%'
 $tambahan
 ORDER BY peserta.Nama ";

# laksanakan arahan mencari data aktiviti
$laksana = mysqli_query($condb,$arahan_papar);
$hadir=$takhadir=$bil=0;
# Mengambil data yang ditemui
    while($m = mysqli_fetch_array($laksana))
    { 

        # memaparkan senarai nama dalam jadual
        echo"<tr>
        <td>".++$bil."</td>
        <td>".$m['Nama']."</td>
        <td>".$m['IDpeserta']."</td>
        <td>".$m['IDjabatan']."</td>
        <td>".$m['Nama_Jabatan']."</td>
        <td align='center'>";

        if(strlen($m['IDaktiviti'])>=1) { 
            echo "&#9989;";
        } else { 
            echo "&#10060;";
        }

        echo"</td>


        </tr>";
    }
echo"</table>";
}
?>

<?php include ('footer.php'); ?>