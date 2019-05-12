<html>
<head><title>Latihan 4 - Table Heading</title></head>
<body>
<table border='1' cellpadding='2' cellspacing='2' align='center' width='70%'>
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>Jenis Kelamin</th>
		<th>Tanggal Lahir</th>
		<th>Alamat</th>
	</tr>	
<!--
kita akan menampilkan isi databasenya di sini ...
dengan memanfaatkan pola contoh data yang telah kita buat sebelumnya
-->
<!-- bagian dinamis -->
<?php
include "koneksi.php";
	$tampilkan_isi = "select * from tbl_mahasiswa";
	$tampilkan_isi_sql = mysql_query($tampilkan_isi);
	while ($isi = mysql_fetch_array($tampilkan_isi_sql))
	{
		$no = $isi['id_mhs'];
		$nama = $isi['nama_mhs'];
		$jeniskelamin = $isi['jenis_kelamin'];
		$tanggallahir = $isi['tgl_lahir'];
		$alamat = $isi['alamat'];
		echo "<tr align='center'> "
		."<td>$no</td> <td>$nama</td> <td>$jeniskelamin</td> <td>$tanggallahir</td> <td>$alamat</td>"
		. "</tr>";
	}	
?>
<!-- bagian dinamis -->
</table>
</body>
</html>