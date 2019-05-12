<?php 
include_once("class/class_supplier.php");
$var = new class_supplier();

?>
<a href="?page=inputsupplier" class="btn btn-success">Tambah Supplier</a>
<div class="page-header">
	<h3><b>Supplier</b></h3>
</div>
	<div class="table-responsive">
			<table class="table table-hovered table-bordered table-striped">
				<thead>
					<tr class="th">
						<th>NO</th>	
						<th>NAMA</th>
						<th>ALAMAT</th>
						<th>NO.TELP</th>
						<th>KOTA</th>
						<th colspan="2">AKSI</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$no =1;
					foreach($var->lihat() as $x){
					?>
						<tr class="td">
							<td><?php echo $no++; ?></td>
							<td><?php echo $x['nama_supplier']; ?></td>
							<td><?php echo $x['alamat_supplier']; ?></td>
							<td><?php echo $x['telp_supplier']; ?></td>
							<td><?php echo $x['kota_supplier']; ?></td>
							<td><a href="index.php?page=edit_supplier&amp;kode_supplier=<?=$x['kode_supplier'];?>">Edit</a></td>
							<td><a href="proses_barang.php?aksi=hapus_supplier&amp;kode_supplier=<?=$x['kode_supplier'];?>" onclick="return confirm('Apakah Anda Yakin Hapus barang?')">Hapus</a></td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
	</div>
