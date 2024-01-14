<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');

# Menyemak kewujudan nilai pembolehubah session['IDpeserta']
if(empty($_SESSION['IDpeserta'])){ 

    # jika nilai session IDpeserta tidak wujud/kosong. aturcara akan dihentikan 
    die("<script>alert('Sila Login');
    window.location.href='logout.php';</script>");
}
?>

<table width='100%' bgcolor='afeeee' border='1'>
    <tr>
        <td width='70%'  align='center' valign='top' >
            <h3> Rekod Kehadiran</h3>

            <!-- Header bagi jadual untuk memaparkan senarai aktiviti --> 
            <table align='center' width='100%' border='1' id=-'saiz' bgcolor='white'>
                <caption>
                    Pengesahan Kendiri hanya boleh dilakukan pada tarikh aktiviti
                    dilaksana sahaja
                </caption>
                <tr align='center' bgcolor='yellow' >
                    <td>Nama Aktiviti</td>
                    <td>Tarikh | Masa</td>
                    <td>Kehadiran</td>
                </tr>
                <?php

                # arahan query untuk mencari senarai Aktiviti
                $arahan_papar="select* from aktiviti";

                # laksanakan arahan mencari data aktiviti
                $laksana = mysqli_query($condb,$arahan_papar);

                # Mengambil data yang ditemui
                     while($m = mysqli_fetch_array($laksana)){ 
                        # memaparkan senarai nama dalam jadual
                        echo"<tr >
                        <td>".$m['Nama_aktiviti']."</td>
                        <td>".$m['Tarikh_aktiviti']." | ".$m['masa_aktiviti']." </td>
                        <td align='center'>";

                        # Arahan mendapatkan data kehadiran ahli bagi setiap aktiviti
                        $arahan_sql_hadir = "select* from kehadiran where
                        IDpeserta ='".$_SESSION ['IDpeserta']."' and IDaktiviti ='".$m['IDaktiviti']."' ";
                        
                        # melaksanakan arahan sql mendapatkan data
                        $laksana_hadir=mysqli_query($condb, $arahan_sql_hadir);
                        
                        if(mysqli_num_rows($laksana_hadir)==1) {
                            echo "&#9989;";
                        } else { 
                            echo "&#10060;  <br>";

                            if(date("Y-m-d") == $m['Tarikh_aktiviti']) { 
                            # Pengesahan Kehadiran Kendiri
                            echo "<a href='profil-sahkendiri.php?IDaktiviti=".$m['IDaktiviti']."'>
                            [ PENGESAHAN KENDIRI ] </a>";
                            }
                    }
                    echo"</td></tr>";
                    }  ?>
                    </table>

                            </td>
                            <td align='center'  vaign='top'>
                                <h3>IMBAS CODE UNTUK SAH KEHADIRAN</h3>
                                <p>
                                    NAMA : <?= $_SESSION['Nama'] ?><br>
                                    IDpeserta : <?= $_SESSION['IDpeserta'] ?><br>
                                </p>
                                <?PHP

                                # mengambil data untuk di jadikan QR code atau bar code
                                $data = $_SESSION['IDpeserta'];
                                $saiz = "200x200";

                                # set umpukkan data API untuk memaparkan QR kod
                                $qr_api = "https://chart.googleapis.com/chart?chs=$saiz&cht=qr&chl=".$data;
                                echo "<div align='center'><img width='50%' src='".$qr_api."'></div>";
                                ?>
                                <br>
                </td>
            </tr>
        </table>
        <?php include ('footer.php'); ?>