<?php
# memulakan fungsi session
session_start();

# memanggil fail luaran dan istihar pemboleh ubah.
include('header.php');
include('kawalan-admin.php');
include('connection.php');
$masa=date("H:i:s");
$status=""; # digunakan untuk memaparkan status kehadiran
$warna="";  # digunakan untuk warna latar belakang status

# menyemak kewujudan data POST
if(!empty($_POST['IDpeserta'])){ 

    # menyemak adakah IDpeserta yang dimasukkan telah wujud dalam pangkalan data
    $arahan_sql_semak           =  "select* from peserta where IDpeserta = '".$_POST['IDpeserta']."' ";
    $laksana_arahan_semak       =  mysqli_query($condb,$arahan_sql_semak);
    if(mysqli_num_rows($laksana_arahan_semak)!=1)
    { 
        # jika IDpserta yang dimasukkan telah wujud.
        $status = "IDpeserta yang dimasukkan/diimbas tiada dalam sistem";
        $warna="red";
    } else { 
        # Proses menyemak IDpeserta yang dimasukkan telah merekodkan kehadiran atau tidak 
        $arahan_semak     =  "select* from kehadiran where IDpeserta='".$_POST['IDpeserta']."'
                              and  IDaktiviti ='".$_GET['IDpeserta']."' limit 1";

        $laksana_arahan   =  mysqli_query($condb,$arahan_semak);
        if(mysqli_num_rows($laksana_arahan)==1)
        { 
            $status ="Anda telah mengesahkan kehadiran sebelum ini.";
            $warna="red";
        } else { 
            
            # Proses menyimpan data kehadiran
            $simpandata=mysqli_query($condb,"insert into kehadiran
            (IDpeserta,IDaktiviti,Masadatang) values
            ('".$_POST['IDpeserta']."','".$_GET['IDaktiviti']."','$masa') ");

            # menyemak adakah proses menyimpan data berjaya
            if($simpandata)
            { 
                $status ="Kehadiran telah disahkan";
                $warna="green";            
            }
            else
            { 
                $status="Kehadiran Gagal direkodkan";
                $warna="red";
            }
        }
    }
}

# menyemak kewujudan data GET['IDaktiviti']
if(!empty($_GET['IDaktiviti']))
{ 
    # proses mendapatkan data aktiviti
    $sql_aktiviti = "select* from aktiviti where IDaktiviti = '".$_GET['IDaktiviti']."'";
    $laksana_aktiviti = mysqli_query($condb,$sql_aktiviti);
    $ma=mysqli_fetch_array($laksana_aktiviti);
}
?>

<h1 class="w3-cursive" align='center'>Laman Rekod Kehadiran Kaunter Urusetia</h1>
<h3 class="w3-cursive" align='center'>
    <!-- Borang carian Aktiviti --> 
    <form action=''method='GET'>
        Aktiviti :<select name='IDaktiviti'>
        <option selected disabled value>Sila Pilih Aktiviti</option>

    <?php
        # Proses memaparkan senarai aktiviti dalam bentuk drop down list
        $arahan_sql_pilih     =  "select* from aktiviti";
        $laksana_arahan_pilih =  mysqli_query($condb,$arahan_sql_pilih);
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

<?php if(!empty($_GET['IDaktiviti'])) { ?>
<!-- Header bagi jadual untuk memaparkan senarai aktiviti -->
    <?= $ma['Nama_aktiviti'] ?><br>
    <?= $ma['Tarikh_aktiviti'] ?> | <?= $ma['masa_aktiviti'] ?><br>
</h3>

<div class="w3-cursive">
<form align='center' action='' method='POST'>
        
        <label>Masukkan / Imbas IDpeserta / KOD anda di sini</label><br>
        <input type='text' name='IDpeserta' autofocus autocomplete="off" required
        onblur="this.focus()"  ><br>

        <input type='submit'  value='Rekod Kehadiran'>
</form>
</div>

<div class="w3-cursive">
<table width='50%' border='1' align='center'>
    <caption style="background-color :<?= $warna ?>"><h3><?= $status; ?></h3></caption>
    <tr bgcolor='yellow'>
            <td>#</td>
            <td>Nama</td>
            <td>ID Peserta</td>
            <td>No jabatan</td>
            <td>Masa Hadir</td>
    </tr>
</div>
<?php
    $bil=0;

    # Proses untuk memaparkan data kehadiran dalam bentuk jadual
    $arahan_sql_kehadiran = "select* from peserta, aktiviti, kehadiran, jabatan
    where
        peserta.IDpeserta            =  kehadiran.IDpeserta
    and peserta.IDjabatan            =  jabatan.IDjabatan
    and aktiviti.IDaktiviti          =  kehadiran.IDaktiviti
    and kehadiran.IDaktiviti         =  '".$_GET['IDaktiviti']."'
    order by kehadiran.Masadatang DESC";

    $laksana_kehadiran = mysqli_query($condb,$arahan_sql_kehadiran);

    while($m  =  mysqli_fetch_array($laksana_kehadiran))
    { 
        echo "  <tr>
                    <td>".++$bil."</td>
                    <td>".$m['Nama']."</td>
                    <td>".$m['IDpeserta']."</td>
                    <td>".$m['IDjabatan']."</td>
                    <td>".$m['Masadatang']."</td>
                </tr>"  ;
    }
?>
</table>
<?php } ?>