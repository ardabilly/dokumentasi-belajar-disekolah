<?php 
include_once("class/class_stok.php");
$var = new class_stok();

?>

<div class="page-header">
	<h3><b>Stok Barang</b></h3>
</div>
	<div class="table-responsive">
		<table class="table table-hovered table-bordered">
			<thead>
				<tr class="th">
					<th>NO</th>
					<th>KODE BARANG</th>
					<th>NAMA BARANG</th>
					<th>JML BARANG MASUK</th>
					<th>JML BARANG KELUAR</th>
					<th>TOTAL BARANG</th>
					<th>TOTAL BARANG BARANG SAAT INI</th>
					<th>KETERANGAN</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
					$no =1;
					foreach($var->lihat() as $baris){
					?>
						<tr class="td">
							<td><?php echo $no++; ?></td>
							<td><?php echo $baris['kode_barang']; ?></td>
							<td><?php echo $baris['nama_barang']; ?></td>
							<td><?php echo $baris['jml_barangmasuk']; ?></td>
							<td><?php echo $baris['jml_barangkeluar']; ?></td>
							<td><?php echo $baris['total_barang']; ?></td>
							<td><?php echo $baris['jumlah_brg']; ?></td>
							<td><?php echo $baris['keterangan']; ?></td>
							

						</tr>
					<?php
				}
				?>
			</tbody>
					
		</table>
	</div>	