<?php
	include_once("koneksi.php");
	
	$tampilkan = "select * from tbl_mahasiswa";
	
	$query_tampilkan = mysql_query($tampilkan);
	
	while($hasil = mysql_fetch_array($query_tampilkan))
		{
			echo $hasil['nama_mhs']."<br>";
			echo $hasil['jenis_kelamin']."<br>";
		}
?>