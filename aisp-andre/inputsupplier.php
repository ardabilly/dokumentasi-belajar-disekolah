<?php include_once("fungsi/nosupplier.php"); ?>
<p><b>Input Supplier</b></p>
 <form action="proses_barang.php?aksi=supplier" method="POST">
	 <div class="well" style="padding: 30px 50px; box-shadow: 0px 3px 5px gray">
	 	<div class="form-group">
	 		<label>Nama Supplier</label>
	 		<input type="hidden" name="nosupp" value="<?=$hasilkode?>">
	 		<input type="text" name="nama_supp" class="form-control" required>
	 	</div>
	 	<div class="form-group">
	 		<label>No Telephone</label>
	 		<input type="text" name="notelp" class="form-control" required>
	 	</div>
	 	<div class="form-group">
	 		<label>Kota</label>
	 		<input type="text" name="kota" class="form-control" required>
	 	</div>
	 	<div class="form-group">
	 		<label>Alamat</label>
	 		<textarea name="alamat" class="form-control" required></textarea>
	 	</div>
	 	<button type="submit" name="submit" class="btn btn-default btn-sm" style="padding: 10px 20px; background-color: #286090; color: #fff; border-bottom: 2px solid #333	">Submit</button>
	 </div>
</form>
<a onclick="window.history.back()" class="btn btn-danger"><< Kembali</a>