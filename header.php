<!-- Tajuk sistem. Akan dipaparkan disebelah atas -->
<div class="w3-container w3-khaki ">
<h1 p class="w3-serif w3-pale-blue" align='center'   >METALFORCE DAILY</h1>
<h4 p class="w3-serif w3-pale-blue" align='center'       >Sistem Kehadiran Peserta Aktiviti</h4>
</div>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<hr>

<?PHP if(!empty($_SESSION['Tahap']) and $_SESSION['Tahap'] == "ADMIN") { ?>
<!-- Menu admin : dipaparkan sekiranya admin telah login-->
<div class="w3-bar w3-black">
<h6  p class="w3-serif">
<a class='w3-button w3-round-medium w3-brown'   href='index.php'  ><i class="fa fa-home w3-xlarge"></i></a>
| <a class='w3-button w3-round-medium w3-light-blue' href='kehadiran-rekod.php'  >Kaunter Kehadiran</a>
| <a class='w3-button w3-round-medium w3-light-blue' href='senarai-peserta.php'  >Senarai Peserta</a>
| <a class='w3-button w3-round-medium w3-light-blue' href='senarai-aktiviti.php'  >Senarai Aktiviti</a>
| <a class='w3-button w3-round-medium w3-light-blue' href='kehadiran-laporan.php'  >Laporan Kehadiran</a>
| <a class='w3-button w3-round-medium w3-red' href='logout.php'  ><i class="fa fa-sign-out w3-xlarge"></i></a>
</div>
<?php } else if(!empty($_SESSION['Tahap']) and $_SESSION['Tahap'] == "PESERTA BIASA"){ ?>
<!-- Menu peserta biasa : dipaparkan sekiranya peserta telah login--> 
<div class="w3-bar w3-black">
<a class='w3-button w3-round-medium w3-brown' href='index.php'  ><i class="fa fa-home w3-xlarge"></i></a>
|<a class='w3-button w3-round-medium w3-white' href='profil.php'  ><i class="fa fa-user w3-xlarge"></i></a>
|<a class='w3-button w3-round-medium w3-red' href='logout.php'  ><i class="fa fa-sign-out w3-xlarge"></i></a>
</div>
<?php } else { ?>
    <!-- menu Laman Utama : dipaparkan sekiranya admin atau ahli tidak login -->
    <div class="w3-bar w3-black">
    <a class='w3-button w3-round-medium w3-brown'   href='index.php'  ><i class="fa fa-home w3-xlarge"></i></a>
    | <a class='w3-button w3-round-medium w3-green' href='login-borang.php'  ><i class="fa fa-sign-in w3-xlarge"></i></a>
    </div>
<?php } ?>