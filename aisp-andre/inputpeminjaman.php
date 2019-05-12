<?php include_once("fungsi/nomatpinjam.php"); ?>
<p><b>Input Barang yang Dipinjam</b></p>
<form action="proses_barang.php?aksi=barangpinjam" method="POST">
	 <div class="well" style="padding: 30px 50px; box-shadow: 0px 3px 5px gray">
	 	<div class="form-group">
	 		<label>No Pinjam</label>
	 		<input type="text" name="tnopinjam" value="<?php echo PMJN00.$hasilkode?>" class="form-control" readonly/>
	 	</div>
	 	<div class="row">
	 		<div class="form-group col-sm-6">
	 			<label>Nama Barang</label>
	 			<select name="tnamabarang" class="form-control">
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
	 		<div class="form-group col-sm-6">
	 			<label>Tanggal Pinjam</label>
	 			<input type="date" name="ttglpinjam" class="form-control" required />
	 		</div>
	 	</div>
	 		<div class="row">
	 			<div class="form-group col-sm-6">
		 			<label>Nama Peminjam</label>
		 			<input type="text" name="tnamapinjam" class="form-control" required />
	 			</div>
	 			<div class="form-group col-sm-6">
		 			<label>Jumlah Pinjam</label>
		 			<input type="text" name="tjmlpinjam" class="form-control" required pattern="[0-9]+"/>
	 			</div>
	 		</div>
	 		<div class="row">
	 			<div class="form-group col-sm-6">
		 			<label>Tanggal Pengembalian</label>
		 			<input type="date" name="ttglbalik" class="form-control">
	 			</div>
	 			<div class="form-group col-sm-6">
		 			<label>Setatus Pinjam</label>
		 			<select name="tket" class="form-control">
						<option>-- Pilih --</option>
						<option>sedang dipinjam</option>
					</select>
	 			</div>
	 		</div>
	 		 <button type="submit" name="submit" class="btn btn-default btn-md" style="width:100px; height: 40px; background-color: #286090; color: #fff; border-bottom: 2px solid #333	">Submit</button>
	 </div>
</form>
<a onclick="window.history.back()" class="btn btn-danger"><< Kembali</a>