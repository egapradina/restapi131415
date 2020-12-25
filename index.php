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

# untuk membuat pilihan contoh [URL]?fiture=.....

@$fiture = $_GET['fiture'];

# Bagian Admin

switch ($fiture) {
	
	# Untuk menampilkan semua data "admin" tanpa kecuali
	# Contoh Link [URL]?fiture=viewalladm
	
	case "viewalladm":
		$query_admin = mysql_query("SELECT * FROM admin") or die(mysql_error());
		$data_array = array();
		while ($data = mysql_fetch_assoc($query_admin)) {
			$data_array[] = $data;
			}
			echo json_encode($data_array);
			break;
		  
		  # Untuk view data "admin" dalam 1 id     
		  # Contoh Link [URL]?fiture=viewadm&id=[nomor id pada field admin]
		  
	case "viewadm":
		@$id = $_GET['id'];
		$query_admin = mysql_query("SELECT * FROM admin WHERE id='$id'") or die(mysql_error());
		$data_array = array();
		$data_array = mysql_fetch_assoc($query_admin);
		echo "[" . json_encode($data_array) . "]";
		break;
				
	default:
	echo "<center><h1>Oh No...</h1></center>"."<p>Link Not Found!</p>";
	break;
}

?>
