<?php 

 class class_stok
 {
 	
 	function lihat()
 	{
 		include_once('dbcon.php');
 		$sql = "select * from tbl_barang a inner join tbl_stok c on a.kode_barang=c.kode_barang
 ORDER BY a.nama_barang ASC";

 		$data = mysqli_query($db, $sql);

 		$total = mysqli_num_rows($data);

 		if($total == 0)
 		{
 			echo "<tr><td colspan='11'><div class='alert alert-danger text-center'><b>Tidak ada data saat ini!</b></div></td></tr>";
 		}
 		else
 		{
	 		while ($q = mysqli_fetch_array($data)) 
	 		{
	 			$hasil[] = $q;
	 		}
	 		return $hasil;
 		}

 	
 	}
 }