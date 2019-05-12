<?php 
		include_once "dbcon.php";
		include_once "fungsi/nomatbrg.php";
		include_once "class/class_barang.php";
		$var = new class_barang();
 ?>
 <!-- <div class="page-header">
 	<h3>Input Data Barang</h3>
 </div> -->
 
 <p><b>Input Data Barang</b></p>
 <form action="proses_barang.php?aksi=barangbaru" method="POST">
 <div class="well" style="padding: 30px 50px; box-shadow: 0px 3px 5px gray">
 	<div class="row">
	 	<div class="form-group col-sm-6">
	 		<label>Kode Barang</label>
	 		<input type="text" name="kodebarang" class="form-control" value="<?='BRG00'.$hasilkode?>" readonly/>
	 	</div>
	 	<div class="form-group col-sm-6">
	 		<label>Nama Barang</label>
	 		<input type="text" name="namabarang" class="form-control" required />
	 	</div>
 	</div>
 	<div class="row">	
	 	<div class="form-group col-sm-6">
	 		<label>Spesifikasi</label>
	 		<input type="text" name="spek" class="form-control" required />
	 	</div>
	 	<div class="form-group col-sm-6">
	 		<label>Lokasi Barang</label>
	 		<input type="text" name="lokasibarang" class="form-control" required />
	 	</div>
 	</div>
 	<div class="row">
	 	<div class="form-group col-sm-6">
	 		<label>Kategori</label>
	 		<select name="kategori" class="form-control">
				<option value="-">-- Pilih Kategori --</option>
				<option value="Furniture">Furniture</option>
				<option value="Electronics">Electronics</option>
				<option value="Buku">Buku</option>
				<option value="ATK">ATK</option>
			</select>
	 	</div>
	 	<div class="form-group col-sm-6">
	 		<label>Kondisi</label>
	 		<select name="kondisi" class="form-control">
				<option value="-">-- Pilih Kondisi --</option>
				<option value="Baru">Baru</option>
				<option value="Bekas">Bekas</option>
			</select>
	 	</div>
 	</div>
 	<div class="row">
	 	<div class="form-group col-sm-6">
	 		<label>Jenis Barang</label>
	 		<input type="text" name="jenisbarang" class="form-control" required />
	 	</div>
	 	<div class="form-group col-sm-6">
	 		<label>Sumber Dana</label>
	 		<input type="text" name="sumberdana" class="form-control" required />
	 	</div>
 	</div>
 	<div class="form-group">
 		<label>Keterangan</label>
 		<textarea class="form-control" style="resize: none;" name="keterangan"></textarea>
 	</div>
 	<button type="submit" name="submit" class="btn btn-default btn-md" style="width:100px; height: 40px; background-color: #286090; color: #fff; border-bottom: 2px solid #333">Submit</button>
 </div>
 </form>
 <a onclick="window.history.back()" class="btn btn-danger"><< Kembali</a>
 <p></p>
