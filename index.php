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
	 
	 # Untuk menambah Data pada "admin" 
     # Contoh Link [URL]?fiture=insadm&nm_adm=[Isi Nama Admin]&pwd_adm=[Isi Password Admin]&tgl=[Tanggal YYYY-MM-DD]
        
    case "insadm":
		@$nm_adm = $_GET['nm_adm'];
		@$pwd_adm = $_GET['pwd_adm'];
		@$tgl = $_GET['tgl'];
		$query_insert_admin = mysql_query("INSERT INTO admin (nm_adm, pwd_adm, tgl) VALUES('$nm_adm', '$pwd_adm', '$tgl')");
		if ($query_insert_admin) {
			echo "<h1>Data Admin Berhasil Disimpan ! </h1>";
			} else {
				echo "Error Inser" . mysql_error();
				}
				break;
				
	 # Untuk mengubah / edit data "admin"
	 # Contoh Link [URL]?fiture=editadm&nm_adm=[Nama Admin]&pwd_adm=[Password Admin]&tgl[Tanggal YYYY-MM-DD]&id=[id Admin yang akan diubah]
        
    case "editadm":
        @$nm_adm = $_GET['nm_adm'];
		@$pwd_adm = $_GET['pwd_adm'];
		@$tgl = $_GET['tgl'];
        @$id = $_GET['id'];
        $query_update_admin= mysql_query("UPDATE admin SET nm_adm='$nm_adm', pwd_adm='$pwd_adm', tgl='$tgl' WHERE id='$id'");
        if ($query_update_admin) {
            echo "<h1>Data Admin Berhasil Diubah ! </h1>";
        } else {
            echo mysql_error();
        }
        break;
		
     # Untuk menghapus Data pada "admin" 
     # Contoh Link [URL]?fiture=dltadm&id=[Nomor id]
	 
    case "dltadm":
		@$id = $_GET['id'];
		$query_delete_admin = mysql_query("DELETE FROM admin WHERE id='$id'");
		if ($query_delete_admin) {
			echo "<h1>Data Admin Berhasil Dihapus!</h1>";
			} else {
				echo mysql_error();
				}
				break;
				
# Bagian Anggota
				
	default:
	echo "<center><h1>Oh No...</h1></center>"."<p>Link Not Found!</p>";
	break;
}

?>
