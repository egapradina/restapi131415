<?php
# Script koneksi untuk ke database

$server = "localhost";
$username = "root";         # User MySQL
$password = "toor";         # password MySQL ! Alert XAMPP biasanya dikosongkan
$database = "perpustakaan"; # Database

# Script koneksi selesai

# Script untuk menampilkan jika server dan username password salah

mysql_connect($server, $username, $password)
or die ("<h1><center>Server tidak terhubung dengan baik ! </center></h1>
<p>Mohon periksa ulang dibagian Server, Username, dan Password.</p>" . mysql_error());

mysql_select_db($database) or die ("<h1><center>Database tidak terhubung dengan baik</center></h1>
<p>Apakah Database sudah dibuat ?</p>" . mysql_error());

# Script Switch case untuk Rest API
