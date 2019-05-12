<?php
	include_once("koneksi.php");
	
	$insert = "insert into tbl_mahasiswa(nama_mhs, jenis_kelamin, tgl_lahir, alamat)
	values('Deny Sarwono', 'Pria', '1986-12-09','Jawa Barat');";
	
	$insert_query = mysql_query($insert);
	
	if($insert_query)
		{echo "Berhasil di insert";}
	else
		{echo "Gagal insert record";}
?>