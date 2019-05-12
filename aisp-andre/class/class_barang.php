<?php 

 class class_barang
 {
 	
 	function lihat()
 	{
 		include_once('dbcon.php');
 		$sql = "SELECT * FROM tbl_barang";

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

 	function barang_baru($kd,$nm,$spek,$lok,$kateg,$kondisi,$jb,$sb,$ket,$jml,$jml_keluar)
 	{
 		include_once('dbcon.php');
 		$query =mysqli_query($db,"insert into tbl_barang values('$kd','$nm','$spek','$lok','$kateg','$jml','$kondisi','$jb','$sb')");

 		$query2 =mysqli_query($db,"insert into tbl_stok values('$kd','$nm','$jml','$jml_keluar','$jml-$jml_keluar','$ket')");
 	}

 	function hapus_barang($kd)
 	{
 		include_once('dbcon.php');
 		$query =mysqli_query($db,"DELETE FROM tbl_barang WHERE kode_barang='$kd'");
 		$query2 =mysqli_query($db,"DELETE FROM tbl_stok WHERE kode_barang='$kd'");
 	}

 	function barangmasuk($nmsup,$kdbm,$nmbrg,$tgl,$jml,$kd,$kdbr,$jmlbrgmasuk,$totalbarang,$jmlbarang)
 	{
 		
 		include('dbcon.php');


		$simpan = mysqli_query($db,"insert into tbl_masukbarang values('$kdbm','$kdbr','$nmbrg','$tgl','$jml','$kd')");
		$update = mysqli_query($db,"update tbl_stok set jml_barangmasuk='$jmlbrgmasuk', total_barang='$totalbarang' where kode_barang='$kdbr'");
		$updatebarang = mysqli_query($db,"update tbl_barang set jumlah_brg='$jmlbarang' where kode_barang='$kdbr'");
		
 	}

 	function lihat_barangmasuk()
 	{
 		include("dbcon.php");
 		$x = mysqli_query($db,"select * from tbl_barang a inner join tbl_masukbarang b inner join tbl_stok c on a.kode_barang=b.kode_barang and a.kode_barang=c.kode_barang
inner join tbl_supplier d on b.kode_supplier=d.kode_supplier ORDER BY b.tgl_masuk DESC");

 		$total = mysqli_num_rows($x);

 		if($total == 0)
 		{
 			echo "<tr><td colspan='13'><div class='alert alert-danger text-center'><b>Tidak ada data saat ini!</b></div></td></tr>";
 		}
 		else
 		{
	 		while ($q = mysqli_fetch_array($x)) 
	 		{
	 			$hasil[] = $q;
	 		}
	 		return $hasil;
 		}

 	}

 	function lihat_barangpinjaman()
 	{
 		include("dbcon.php");
 		$x = mysqli_query($db,"SELECT * FROM tbl_pinjam order by tgl_pinjam DESC");
 		$total = mysqli_num_rows($x);

 		if($total == 0)
 		{
 			echo "<tr><td colspan='11'><div class='alert alert-danger text-center'><b>Tidak ada data saat ini!</b></div></td></tr>";
 		}
 		else
 		{
	 		while ($q = mysqli_fetch_array($x)) 
	 		{
	 			$hasil[] = $q;
	 		}
	 		return $hasil;
 		}

 	}

 	function barangpinjam($nop,$tglp,$nmbrg,$tglk,$jml,$nm,$ket,$jmlbrg,$kdbr,$totalbarang,$jml_bk,$tot)
 	{
 		include("dbcon.php");
 		if ($jml > $jmlbrg)
 		{
			echo "<pre>
			Jumlah barang yang di pinjam terlalu banyak !!!
			jumlah barang tersedia hanya = $jmlbrg
			mohon kembali untuk input ulang !
			</pre>";
		}
		else
		{
			$proses =
			$simpan = mysqli_query($db,"insert into tbl_pinjam values('$nop','$tglp','$kdbr','$nmbrg','$jml','$nm','$tglk','$ket')");
			$brgkeluar = mysqli_query($db,"insert into tbl_keluarbarang values('$nop','$kdbr','$nmbrg','$tglp','$nm','$jml')");
			$updatebarang = mysqli_query($db,"update tbl_barang set jumlah_brg='$totalbarang' where kode_barang='$kdbr'");
			$updatebrgkeluar = mysqli_query($db,"update tbl_stok set jml_barangkeluar='$jml_bk' where kode_barang='$kdbr'");
			;

			 if($proses)
			 {
						
				   echo "<script>alert('DATA PEMINJAMAN TERSIMPAN'); window.location.href='index.php?page=datapeminjaman'</script>";					

	        }

		}
	}
	function editbarang($kode_barang)
 	{
 		include_once('dbcon.php');
 		$sql = "select * from tbl_barang a inner join tbl_stok b on a.kode_barang=b.kode_barang where a.kode_barang='$kode_barang'";

 		$data = mysqli_query($db, $sql);

 		while ($q = mysqli_fetch_array($data)) 
 		{
 			$hasil[] = $q;
 		}
 		return $hasil;
 	}

 	function doeditbarang($kd,$nm,$spek,$lok,$kateg,$kondisi,$jb,$sb,$ket)
 	{
 		include_once('dbcon.php');
 		$query =mysqli_query($db,"update tbl_barang set nama_barang='$nm',spesifikasi='$spek',lokasi_barang='$lok',kategori='$kateg',kondisi='$kondisi',jenis_brg='$jb',sumber_dana='$sb' where kode_barang='$kd'");

 		$query2 =mysqli_query($db,"update tbl_stok set nama_barang='$nm',keterangan='$ket' where kode_barang='$kd'");
 	}

 	function dokembalibarang($kdbrg,$jmlbarang,$status,$nop,$stok)
 	{
 		include("dbcon.php");
 		$proses=
	 	$updatebarang = mysqli_query($db,"update tbl_barang set jumlah_brg='$jmlbarang' where kode_barang='$kdbrg'");
		$updatepinjam = mysqli_query($db,"update tbl_pinjam set keterangan='$status' where nomor_pinjam='$nop'");
		$updatestok = mysqli_query($db,"update tbl_stok set jml_barangkeluar='$stok' where kode_barang='$kdbrg'");
		;
			
		if($proses)
		{
				
	              echo "<script>alert('DATA BARANG DIKEMBALIKAN KE STOK'); document.location.href='index.php?page=datapeminjaman';</script>";
	              
		}

	 }
}

?>