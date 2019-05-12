<?php
	include "koneksi.php";
	$delete = "delete from tbl_mhsiswa where tgl_lahir = '1986-12-09';";
	$delete_query = mysql_query($delete);
	if($delete_query)
		echo "Record Telah berhasil di hapuss...";
	else
		echo "Record Gagal untuk dihapus..";
?>