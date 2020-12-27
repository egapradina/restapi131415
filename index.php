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

####################################
###                              ###
###        Bagian Admin          ###
###                              ###
####################################

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
				
####################################
###                              ###
###        Bagian Anggota        ###
###                              ###
####################################

	# Untuk menampilkan semua data "anggota" tanpa kecuali
	# Contoh Link [URL]?fiture=viewallang
	
	case "viewallang":
		$query_anggota = mysql_query("SELECT * FROM anggota") or die(mysql_error());
		$data_array = array();
		while ($data = mysql_fetch_assoc($query_anggota)) {
			$data_array[] = $data;
			}
			echo json_encode($data_array);
			break;
				
	# Untuk view data "anggota" dalam 1 id     
	# Contoh Link [URL]?fiture=viewang&id=[nomor id pada field anggota]
		  
	case "viewang":
		@$id = $_GET['id'];
		$query_anggota = mysql_query("SELECT * FROM anggota WHERE id='$id'") or die(mysql_error());
		$data_array = array();
		$data_array = mysql_fetch_assoc($query_anggota);
		echo "[" . json_encode($data_array) . "]";
		break;
		
	# Untuk menambah Data pada "anggota" 
    # Contoh Link [URL]?fiture=insang&nm_agt=[Isi Nama Angota]&pwd_agt=[Isi Password Anggota]&status=[Status diisi 1 / 0]&tgl=[Tanggal YYYY-MM-DD]
	# ! Warning ! Status 1 artinya aktif dan 0 artinya tidak aktif
        
    case "insang":
		@$nm_agt = $_GET['nm_agt'];
		@$pwd_agt = $_GET['pwd_agt'];
		@$status = $_GET['status'];
		@$tgl = $_GET['tgl'];
		$query_insert_anggota = mysql_query("INSERT INTO anggota (nm_agt, pwd_agt, status, tgl) VALUES('$nm_agt', '$pwd_agt', '$status', '$tgl')");
		if ($query_insert_anggota) {
			echo "<h1>Data Anggota Berhasil Disimpan ! </h1>";
			} else {
				echo "Error Inser" . mysql_error();
				}
				break;
				
	# Untuk mengubah / edit data "anggota"
	# Contoh Link [URL]?fiture=editang&nm_agt=[Nama Anggota]&pwd_agt=[Password Anggota]&status=[Status diisi 1 / 0]&tgl[Tanggal YYYY-MM-DD]&id=[id Anggota yang akan diubah]
	# ! Warning ! Status 1 artinya aktif dan 0 artinya tidak aktif
        
    case "editang":
        @$nm_agt = $_GET['nm_agt'];
		@$pwd_agt = $_GET['pwd_agt'];
		@$status = $_GET['status'];
		@$tgl = $_GET['tgl'];
        @$id = $_GET['id'];
        $query_update_anggota= mysql_query("UPDATE anggota SET nm_agt='$nm_agt', pwd_agt='$pwd_agt', status='$status', tgl='$tgl' WHERE id='$id'");
        if ($query_update_anggota) {
            echo "<h1>Data Anggota Berhasil Diubah ! </h1>";
        } else {
            echo mysql_error();
        }
        break;
		
	# Untuk menghapus Data pada "anggota" 
    # Contoh Link [URL]?fiture=dltang&id=[Nomor id]
	 
    case "dltang":
		@$id = $_GET['id'];
		$query_delete_anggota = mysql_query("DELETE FROM anggota WHERE id='$id'");
		if ($query_delete_anggota) {
			echo "<h1>Data Anggota Berhasil Dihapus!</h1>";
			} else {
				echo mysql_error();
				}
				break;
				
####################################
###                              ###
###         Bagian Buku          ###
###                              ###
####################################

	# Untuk menampilkan semua data "buku" tanpa kecuali
	# Contoh Link [URL]?fiture=viewallbk
	
	case "viewallbk":
		$query_buku = mysql_query("SELECT * FROM buku") or die(mysql_error());
		$data_array = array();
		while ($data = mysql_fetch_assoc($query_buku)) {
			$data_array[] = $data;
			}
			echo json_encode($data_array);
			break;
				
	# Untuk view data "buku" dalam 1 id     
	# Contoh Link [URL]?fiture=viewbk&id=[nomor id pada field buku]
		  
	case "viewbk":
		@$id = $_GET['id'];
		$query_buku = mysql_query("SELECT * FROM buku WHERE id='$id'") or die(mysql_error());
		$data_array = array();
		$data_array = mysql_fetch_assoc($query_buku);
		echo "[" . json_encode($data_array) . "]";
		break;
		
	# Untuk menambah Data pada "buku" 
    # Contoh Link [URL]?fiture=insbk&judul=[Isi Judul Buku]&kategori=[Isi Kategori Buku]&status=[Status diisi 1 / 0]&stok=[Isi Stok Buku]&isbn=[Isi Nomor ISBN Buku]
	# ! Warning ! Status 1 artinya aktif dan 0 artinya tidak aktif
        
    case "insbk":
		@$judul = $_GET['judul'];
		@$kategori = $_GET['kategori'];
		@$status = $_GET['status'];
		@$stok  = $_GET['stok'];
		@$isbn  = $_GET['isbn'];
		$query_insert_anggota = mysql_query("INSERT INTO buku (judul, kategori, status, stok, isbn) VALUES('$judul', '$kategori', '$status', '$stok', '$isbn')");
		if ($query_insert_anggota) {
			echo "<h1>Data Buku Berhasil Disimpan ! </h1>";
			} else {
				echo "Error Inser" . mysql_error();
				}
				break;
				
	# Untuk mengubah / edit data "buku"
	# Contoh Link [URL]?fiture=editbk&judul=[Isi Judul Buku]&kategori=[Isi Kategori Buku]&status=[Status diisi 1 / 0]&stok=[Isi Stok Buku]&isbn=[Isi Nomor ISBN Buku]&id=[id Buku yang akan diubah]
	# ! Warning ! Status 1 artinya aktif dan 0 artinya tidak aktif
        
    case "editbk":
        @$judul = $_GET['judul'];
		@$kategori = $_GET['kategori'];
		@$status = $_GET['status'];
		@$stok  = $_GET['stok'];
		@$isbn  = $_GET['isbn'];
		@$id = $_GET['id'];
        $query_update_buku= mysql_query("UPDATE buku SET judul='$judul', kategori='$kategori', status='$status', stok='$stok', isbn='$isbn' WHERE id='$id'");
        if ($query_update_buku) {
            echo "<h1>Data Buku Berhasil Diubah ! </h1>";
        } else {
            echo mysql_error();
        }
        break;
		
	# Untuk menghapus Data pada "buku" 
    # Contoh Link [URL]?fiture=dltbk&id=[Nomor id]
	 
    case "dltbk":
		@$id = $_GET['id'];
		$query_delete_buku= mysql_query("DELETE FROM buku WHERE id='$id'");
		if ($query_delete_buku) {
			echo "<h1>Data Buku Berhasil Dihapus!</h1>";
			} else {
				echo mysql_error();
				}
				break;
				
####################################
###                              ###
###              END             ###
###                              ###
####################################				
	default:
	echo "<center><h1>Oh No...</h1></center>"."<p>Link Not Found!</p>"."<ul>
	<il><i>* Please Check Link or URL !</i></il></ul>";
	break;
}

?>
