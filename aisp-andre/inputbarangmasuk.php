<?php include_once("fungsi/nomatbrgmasuk.php"); ?>
<p><b>Input Data Barang Masuk</b></p>
 <form action="proses_barang.php?aksi=barangmasuk" method="POST">
	 <div class="well" style="padding: 30px 50px; box-shadow: 0px 3px 5px gray">
	 	<div class="form-group">
		 	<label>Nama Supplier</label>
		 	<select name="supplier" class="form-control">
		 		<option>-- Pilih Supplier --</option>
				<?php
					include_once("dbcon.php");
					$supplier = mysqli_query($db,"select * from tbl_supplier");
					while ($datasup=mysqli_fetch_array($supplier))
					{
						echo '<option value="' . $datasup['nama_supplier'] . '">'. $datasup['nama_supplier'] . '</option>';
					}
				?>
		 	</select>
		 </div>
		 <div class="form-group">
		 	<label>Kode Barang Masuk</label>
		 	<input type="text" name="kode_brgmasuk" class="form-control" value="<?='BMSK00'.$hasilkode?>" required />
		 </div>
		 <div class="form-group">
		 	<label>Nama Barang</label>
		 	<select name="barang" class="form-control">
		 		<option>-- Pilih Barang --</option>
				<?php
					include_once("dbcon.php");
					$brg = mysqli_query($db,"select * from tbl_barang");
					while ($datasup=mysqli_fetch_array($brg))
					{
						echo '<option value="' . $datasup['nama_barang'] . '">'. $datasup['nama_barang'] . '</option>';
					}
				?>
		 	</select>
		 </div>
		 <div class="form-group">
		 	<label>Jumlah Masuk</label>
		 	<input type="text" name="jml_barang" class="form-control"  required pattern="[0-9]+" />
		 </div>
		 <div class="form-group">
		 	<label>Tanggal Masuk</label>
		 	<input type="date" name="tgl_masuk" class="form-control" required />
		 </div>
		 <button type="submit" name="submit" class="btn btn-default btn-md" style="width:100px; height: 40px; background-color: #286090; color: #fff; border-bottom: 2px solid #333	">Submit</button>
	 </div>
 </form>
 <a onclick="window.history.back()" class="btn btn-danger"><< Kembali</a>
 <p></	