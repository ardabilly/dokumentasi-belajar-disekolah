<?php 

/**
 * 
 */
 class class_supplier
 {
 	
 	function lihat()
 	{
 		include_once("dbcon.php");
 		$sql = "SELECT * FROM tbl_supplier ";

 		$data = mysqli_query($db, $sql);

 		while ($q = mysqli_fetch_array($data)) 
 		{
 			$hasil[] = $q;
 		}
 		return $hasil;
 	}

 	// function tambah($kode_supplier,$nama_supplier,$alamat_supplier,$telp_supplier,$kota_supplier)
 	// {
 	// 	$kode_supplier = addslashes($kode_supplier);
 	// 	$nama_supplier = addslashes($nama_supplier);
 	// 	$alamat_supplier = addslashes($alamat_supplier);
 	// 	$telp_supplier = addslashes($telp_supplier);
 	// 	$kota_supplier = addslashes($kota_supplier);

 	// 	include_once('dbcon.php');

 	// 	$sql = "INSERT INTO supplier VALUES('$kode_supplier','$nama_supplier','$alamat_supplier','$telp_supplier','$kota_supplier')";

 	// 	$data = mysqli_query($db, $sql);
 	// }

 	function hapus_supplier($kode_supplier)
 	{
 		$kode_supplier = addslashes($kode_supplier);

 		include('dbcon.php');

 		$sql = "DELETE FROM tbl_supplier where kode_supplier = '$kode_supplier'";

 		$data = mysqli_query($db, $sql);

 	}

 	function editsupplier($kode_supplier)
 	{
 		include('dbcon.php');

 		$sql = "SELECT * FROM tbl_supplier WHERE kode_supplier ='".$kode_supplier."'";
 		$data = mysqli_query($db, $sql);

 		while ($p = mysqli_query($data)) 
 		{
 			$hasil[] = $p;
 		}
 		return $hasil;
 	}

 	function edit_supplier($kode_supplier, $nama_supplier, $alamat_supplier,$telp_supplier,$kota_supplier)
 	{
 		include_once('dbcon.php');
 		$kode_supplier = addslashes($kode_supplier);
 		$nama_supplier = addslashes($nama_supplier);
 		$alamat_supplier = addslashes($alamat_supplier);
 		$telp_supplier = addslashes($telp_supplier);
 		$kota_supplier = addslashes($kota_supplier);

 		$sql = "UPDATE tbl_supplier SET nama_supplier = '$nama_supplier', alamat_supplier = '$alamat_supplier', telp_supplier = '$telp_supplier', kota_supplier = '$kota_supplier' WHERE kode_supplier = '$kode_supplier'";

 		$data = mysqli_query($db, $sql);
 	}

 	function tambahsupplier($nosupp,$nama,$notelp,$kota,$alamat)
 	{
 		include_once("dbcon.php");
 		$data = mysqli_query($db,"INSERT INTO tbl_supplier VALUES('$nosupp','$nama','$alamat','$notelp','$kota')");
 	}
 } 
 ?>