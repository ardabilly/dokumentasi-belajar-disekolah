<?php 
	include_once("class/class_barang.php");
	include_once("class/class_supplier.php");

	$var =  new class_barang();
	$var2 = new class_supplier();

	if($_GET["aksi"] == "barangbaru")
	{
		$kb = $_POST["kodebarang"];
		$nb = $_POST["namabarang"];
		$spek = $_POST["spek"];
		$lok = $_POST["lokasibarang"];
		$kateg = $_POST["kategori"];
		$kondisi = $_POST["kondisi"];
		$jb = $_POST["jenisbarang"];
		$sb = $_POST["sumberdana"];
		$ket = $_POST["keterangan"];
		$jml= '0';
		$jmlkeluar='0';

		$x = $var->barang_baru($kb,$nb,$spek,$lok,$kateg,$kondisi,$jb,$sb,$ket,$jml,$jmlkeluar);
		echo "<script>window.location.href='index.php?page=barang'; alert('Data Berhasil di Tambahkan');</script>";
	}
	elseif($_GET["aksi"] == "hapusbarang")
	{
		$kd = $_GET["kode_barang"];
		$var->hapus_barang($kd);
		echo "<script>window.location.href='index.php?page=barang'; alert('Data Berhasil di Hapus');</script>";
	}
	elseif($_GET["aksi"] == "barangmasuk")
	{
		include_once("dbcon.php");
		
		$nmsup= $_POST['supplier'];
		$kdbm= $_POST['kode_brgmasuk'];
		$nmbrg= $_POST['barang'];
		$tgl= $_POST['tgl_masuk'];
		$jml= $_POST['jml_barang'];

		$kdsup = mysqli_query($db,"select kode_supplier from tbl_supplier where nama_supplier ='$nmsup'");
		$skode = mysqli_fetch_array($kdsup);
		$kd = $skode['kode_supplier'];

		$kdbrg = mysqli_query($db,"select kode_barang from tbl_barang where nama_barang ='$nmbrg'");
		$bkode = mysqli_fetch_array($kdbrg);
		$kdbr = $bkode['kode_barang'];

		$stok = mysqli_query($db,"select * from tbl_stok where kode_barang ='$kdbr'");
		$tmpstok = mysqli_fetch_array($stok);

		$jmlbrg = $tmpstok['jml_barangmasuk'];
		$jmlkeluar = $tmpstok['jml_barangkeluar'];
		$tot = $tmpstok['total_barang'];

		$jmlbrgmasuk = $jml + $jmlbrg;
		$totalbarang = $jml+$jmlbrg;
		$jmlbarang = $totalbarang - $jmlkeluar;

		$var->barangmasuk($nmsup,$kdbm,$nmbrg,$tgl,$jml,$kd,$kdbr,$jmlbrgmasuk,$totalbarang,$jmlbarang);
		echo "<script>window.location.href='index.php?page=barang'; alert('Data Berhasil di Tambahkan');</script>";
	}
	elseif($_GET["aksi"] == "barangpinjam")
	{
		include_once("dbcon.php");

		$nop= $_POST['tnopinjam'];
		$tglp= $_POST['ttglpinjam'];
		$nmbrg= $_POST['tnamabarang'];
		$tglk= $_POST['ttglbalik'];
		$jml= $_POST['tjmlpinjam'];
		$nm= $_POST['tnamapinjam'];
		$ket= $_POST['tket'];

		$kdbrg = mysqli_query($db,"select kode_barang, jumlah_brg from tbl_barang where nama_barang ='$nmbrg'");
		$bkode = mysqli_fetch_array($kdbrg);
		$kdbr = $bkode['kode_barang'];
		$jmlbrg = $bkode['jumlah_brg'];
		$totalbarang= $jmlbrg - $jml;

		$cekstok = mysqli_query($db,"select jml_barangkeluar from tbl_stok where kode_barang ='$kdbr'");
		$cek_bk = mysqli_fetch_array($cekstok);
		$jml_bk = $cek_bk['jml_barangkeluar'];

		$tot = $jml_bk + $jml;

		$var->barangpinjam($nop,$tglp,$nmbrg,$tglk,$jml,$nm,$ket,$jmlbrg,$kdbr,$totalbarang,$jml,$tot);
	}
	elseif($_GET["aksi"] == "doeditbarang")
	{
		$kb = $_POST["kodebarang"];
		$nb = $_POST["namabarang"];
		$spek = $_POST["spek"];
		$lok = $_POST["lokasibarang"];
		$kateg = $_POST["kategori"];
		$kondisi = $_POST["kondisi"];
		$jb = $_POST["jenisbarang"];
		$sb = $_POST["sumberdana"];
		$ket = $_POST["keterangan"];
		

		$x = $var->doeditbarang($kb,$nb,$spek,$lok,$kateg,$kondisi,$jb,$sb,$ket);
		echo "<script>window.location.href='index.php?page=barang'; alert('Data Berhasil di Edit');</script>";
	}
	elseif($_GET["aksi"] == "kembalibarang")
	{

		include_once("dbcon.php");
		$nop = $_POST["tnopinjam"];
		$status = $_POST["tstatus"];

		$qry = mysqli_query($db,"select * from tbl_pinjam a inner join tbl_barang b on a.kode_barang=b.kode_barang where a.nomor_pinjam='$nop'");
		$data=mysqli_fetch_array($qry);
		$jml = $data['jumlah_pinjam'];
		$kdbrg = $data['kode_barang'];
		$stat = $data['keterangan'];
		$jmlbrg =$data['jumlah_brg'];

		$qry2 = mysqli_query($db,"select * from tbl_stok where kode_barang='$kdbrg'");
		$data2=mysqli_fetch_array($qry2);
		$brgkeluar =$data2['jml_barangkeluar'];

		$jmlbarang = $jmlbrg + $jml;
		$stok = $brgkeluar - $jml;
	

		if ($stat == 'telah dikembalikan')
		{
	 		echo "<script>alert('GAGAL MENYIMPAN, BARANG INI SUDAH DIKEMBALIKAN SEBELUM NYA !!!!'); document.location.href='index.php?page=datapeminjaman';</script>";

		}
		else
		{
			$var->dokembalibarang($kdbrg,$jmlbarang,$status,$nop,$stok);
		}
		
	}
	elseif($_GET["aksi"] == "hapus_pinjambarang")
	{
		include_once"dbcon.php";
	$id = $_GET["nopinjam"];
	
	$x = mysqli_query($db,"DELETE  FROM tbl_pinjam WHERE nomor_pinjam='$id'");
	echo "<script>alert('Satu data Pinjam telah di Hapus!'); window.location.href='index.php?page=datapeminjaman'</script>";
	}
	elseif($_GET["aksi"] == "supplier")
	{
		$nosupp = $_POST["nosupp"];
		$nama = $_POST["nama_supp"];
		$notelp = $_POST["notelp"];
		$kota = $_POST["kota"];
		$alamat = $_POST["alamat"];

		$var2->tambahsupplier($nosupp,$nama,$notelp,$kota,$alamat);
		echo "<script>window.location.href='index.php?page=supplier'; alert('Satu Supplier Berhasil di Tambahkan');</script>";
	}
	elseif($_GET["aksi"] == "hapus_supplier")
	{
		$kd = $_GET["kode_supplier"];
		$var2->hapus_supplier($kd);
		echo "<script>window.location.href='index.php?page=supplier'; alert('Data Berhasil di Hapus');</script>";
	}
	elseif($_GET["aksi"] == "edit_supplier")
	{
		$nosupp = $_POST["nosupp"];
		$nama = $_POST["nama_supp"];
		$notelp = $_POST["notelp"];
		$kota = $_POST["kota"];
		$alamat = $_POST["alamat"];

		$var2->edit_supplier($nosupp,$nama,$alamat,$notelp,$kota);
		echo "<script>window.location.href='index.php?page=supplier'; alert('Satu Supplier Berhasil di Edit');</script>";
	}
 ?>